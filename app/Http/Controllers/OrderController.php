<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Add;
use App\Order;
use App\product;
use App\Inventory;
use App\User;
use PDF;

class OrderController extends Controller
{
    public function __construct(Order $s){

        $this->view="order";
        $this->route="order";
        $this->viewname="Order";
    
    
    }
    
    public function generatePdf($id)
    {
        // Fetch the parent record (Add)
        $order = Add::find($id);
    
        // Check if the record exists
        if (!$order) {
            return redirect()->back()->with('error', 'Order not found.');
        }
    
        // Fetch related child records (Order)
        $orderDetails = Order::where('addid', $id)->get();
    
        // Prepare data to be passed to the view
        $data = [
            'title' => 'Order Details',
            'add' => $order,           // Pass the Add model
            'datamain' => $orderDetails // Pass related Order records
        ];
    
        // Load the view and pass the data to it
        $pdf = PDF::loadView('pdf.orderpdf', $data);
    
        // Return the generated PDF for download
        return $pdf->download('order_' . $id . '.pdf');
    }
    
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Add::latest();
            return Datatables::of($query)

            ->addColumn('add', function($row) {
                // Find the user based on the ID stored in the 'add' field
                $user = User::find($row->add); // Use the correct property to find the user by ID
            
                if ($user) {
                    // If a match is found, return the user name
                    return $user->name; // Display the user name
                } else {
                    // If no match is found, return "null"
                    return "null"; // Or you can return a more user-friendly message
                }
            })
            
            ->addColumn('gender',function($row){

                if($row->gender == 1)
                {
                    $btn="male";
                }else if($row->gender == 2)
                {
    
                    $btn="female";
                }else
                {
                    $btn="null";
                }
                return $btn;
    
            })
            
            ->addColumn('action', function ($row) {
                //  $btn = '<a href="'.route('user.edit', $row->id).'">Edit</a>&nbsp&nbsp&nbsp<a href="'.route('user.delete', $row->id).'">Delete</a>'; 
            

             $btn = view('layouts.actionbtnpermission')->with(['id'=>$row->id,'route'=>'order'])->render();      

           
           return $btn;
       })
    
        
    
    
    
            ->rawColumns(['add','gender','action'])
            ->make(true);
        } 
    
        return view('order.index');
    
    }
    
        
        public function create()
        {
    
            $data['title'] = 'Add ' . $this->viewname;
    $data['module'] = $this->viewname;
    $data['resourcePath'] = $this->view;

    // Fetch all existing orders to count them
    $orders = Add::all(); // Get all orders
    $orderCount = $orders->count() + 1; // Increment by 1 for the next order

    // Pass the order count to the view
    $data['orderCount'] = $orderCount;

    return view('general.add_form')->with($data);
    
        }
    
        
        public function store(Request $request)
        {
            // Validate request data
            $validatedData = $request->validate([
                'add' => 'required|string|max:255',
                'total_price' => 'required|numeric|min:0',
                'quantity_total_price' => 'required|numeric|min:0',
                'item_name.*' => 'required|string|max:255', 
                'price.*' => 'required|numeric|min:0',      
                'quantity.*' => 'required|integer|min:1',   
                'itempricetotal.*' => 'required|numeric|min:0',
                'gst.*' => 'nullable|numeric|min:0',          // Validate GST
                'gst_total.*' => 'nullable|numeric|min:0',    // Validate GST total
                'discount.*' => 'nullable|numeric|min:0',     // Validate discount percentage
                'discount_amount.*' => 'nullable|numeric|min:0', // Validate discount amount
                'final_total.*' => 'nullable|numeric|min:0',  // Validate final total
          
            ]);
        
        // Create a new Add record
        $ad = new Add();
        $ad->add = $request->add;
        $ad->mobileno = $request->mobileno;
        $ad->gender = $request->gender;
        $ad->total_price = $request->total_price;
        $ad->quantity_total_price = $request->quantity_total_price;
        $ad->orderno = $request->orderno;
        $ad->gst_item_total = $request->gst_item_total ?? 0;
        $ad->final_item_total = $request->final_item_total ?? 0;
    
    $ad->save();

    // Create Order records and manage inventory
    if (is_array($request->item_name) && is_array($request->price) && is_array($request->quantity) && is_array($request->itempricetotal)) {
        foreach ($request->item_name as $key => $itemName) {
            if ($itemName != '') {
                // Create new Order
                $order = new Order();
                $order->addid = $ad->id; // Foreign key linking to parent
                $order->item_name = $itemName;
                $order->price = $request->price[$key];
                $order->quantity = $request->quantity[$key];
                $order->itempricetotal = $request->itempricetotal[$key];
                $order->gst = $request->gst[$key] ?? 0; // Default to 0 if not provided
                $order->gst_total = $request->gst_total[$key] ?? 0;
                $order->discount = $request->discount[$key] ?? 0;
                $order->discount_amount = $request->discount_amount[$key] ?? 0;
                $order->final_total = $request->final_total[$key] ?? 0;
                $order->save();

                // Update inventory
                $product = Inventory::where('product_id', $itemName)->first(); // Assuming item_name corresponds to product_id

                if ($product) {
                    // If the product exists, update the stock
                    $product->stock += $order->quantity; // Increment stock by quantity ordered
                    // $product->used = 0;  // Update used stock
                    $product->actul_stock += $order->quantity; // Update actual stock
                    $product->save();
                } else {
                    // If the product does not exist, create a new Inventory entry
                    $inv = new Inventory();
                    $inv->product_id = $itemName; // Assuming item_name corresponds to product_id
                    $inv->stock = $order->quantity; // Set stock to the quantity ordered
                     $inv->used = 0; // Initially no stock has been used
                    $inv->actul_stock = $order->quantity; // Set actual stock to quantity ordered
                    $inv->save();
                }
                // $product->stock = $product->stock + $order->quantity;
                // $prodcut->used = $product->used;
                // $product->actul_stock = $product->actual_stock + $order->quantity;
                // $product->save();
            }
        }
    }

    return response()->json(['status' => 'success']);
}
              
        public function show($id)
           {
            $data['title'] = 'show ' . $this->viewname;
            $data['data'] = Order::where('id', $id)->first();
            $data['module'] = $this->viewname;
            $data['resourcePath'] = $this->view;
            
            return view('order.show')->with($data);
           }
       
        
        public function edit($id)
        {
    
            $data['title'] = 'Edit ' . $this->viewname;
            $data['data'] = Add::where('id', $id)->first();
            $data['module'] = $this->viewname;
            $data['resourcePath'] = $this->view;
            
            return view('general.edit_form')->with($data);
        }
    
        public function update(Request $request, $id)
        {
            // Validate request data for both parent and child records
            $validatedData = $request->validate([
                'add' => 'required|string|max:255',
                'total_price' => 'required|numeric|min:0',
                'quantity_total_price' => 'required|numeric|min:0',
                'edititemname.*' => 'required|string|max:255',
                'editprice.*' => 'required|numeric|min:0',
                'editquantity.*' => 'required|integer|min:1',
                'edititempricetotal.*' => 'required|numeric|min:0',
            ]);
        
        
    // Update the parent Add record
    $ad = Add::findOrFail($id);
    $ad->add = $request->add;
    $ad->mobileno = $request->mobileno;
    $ad->gender = $request->gender;
    $ad->total_price = $request->total_price;
    $ad->quantity_total_price = $request->quantity_total_price;
    $ad->gst_item_total = $request->gst_item_total ?? 0;
    $ad->final_item_total = $request->final_item_total ?? 0;
    $ad->orderno = $request->orderno;
    $ad->save();
// Update existing orders if available
if (is_array($request->edititemname) && is_array($request->hidden_id)) {
    foreach ($request->edititemname as $key => $itemName) {
       
        if ($itemName != '') {
            // Ensure hidden_id exists for updating existing orders
            if (isset($request->hidden_id[$key])) {
                $existingOrder = Order::find($request->hidden_id[$key]);

                if ($existingOrder) {
                    // Fetch the previous quantity
                    $oldQuantity = $existingOrder->quantity;

                    // Add the new quantity entered by the user
                    $newQuantity = $request->editquantity[$key];
                    
                    // Update inventory for the product
                    $product = Inventory::where('product_id', $itemName)->first();

                    if ($product) {
                       
                        // Subtract the old quantity from stock and actual_stock
                        $product->stock -= $oldQuantity; // Previous stock removal
                        $product->actual_stock -= $oldQuantity; // Previous stock removal

                        // Add the new quantity entered by the user
                        $product->stock += $newQuantity; // New stock addition
                        $product->actual_stock += $newQuantity; // New stock addition

                        // Debugging statement
                       
                        // Save the updated inventory
                        $product->save();
                    }

                    // Update the existing order
                    $existingOrder->item_name = $itemName;
                    $existingOrder->price = $request->editprice[$key];
                    $existingOrder->quantity = $newQuantity; // Use the new quantity here
                    $existingOrder->itempricetotal = $request->edititempricetotal[$key];
                    $existingOrder->gst = $request->editgst[$key] ?? 0;
                    $existingOrder->gst_total = $request->editgst_total[$key] ?? 0;
                    $existingOrder->discount = $request->editdiscount[$key] ?? 0;
                    $existingOrder->discount_amount = $request->editdiscount_amount[$key] ?? 0;
                    $existingOrder->final_total = $request->editfinal_total[$key] ?? 0;

                    // Debugging statement
                    // Check existing order before saving

                    // Save the updated order
                    $existingOrder->save();
                }
            }
        }
    }
}

            // Create new orders
            if (is_array($request->item_name) && is_array($request->price) && is_array($request->quantity)) {
                foreach ($request->item_name as $key => $itemName) {
                    if ($itemName != '') {
                        $order = new Order();
                        $order->addid = $ad->id;
                        $order->item_name = $itemName;
                        $order->price = $request->price[$key];
                        $order->quantity = $request->quantity[$key];
                        $order->itempricetotal = $request->itempricetotal[$key];
                        $order->gst = $request->gst[$key] ?? 0;
                        $order->gst_total = $request->gst_total[$key] ?? 0;
                        $order->discount = $request->discount[$key] ?? 0;
                        $order->discount_amount = $request->discount_amount[$key] ?? 0;
                        $order->final_total = $request->final_total[$key] ?? 0;
                        $order->save();
        
                        // Update inventory
                        $product = Inventory::where('product_id', $itemName)->first();
                        if ($product) {
                            $product->stock += $order->quantity;
                            $product->actul_stock += $order->quantity;
                            $product->save();
                        } else {
                            $inv = new Inventory();
                            $inv->product_id = $itemName;
                            $inv->stock = $order->quantity;
                            $inv->actul_stock = $order->quantity;
                            // $inv->used = 0;
                            $inv->save();
                        }
                    }
                }
            }
        
            return response()->json(['status' => 'success']);
        }
        
        public function deleteOrder(Request $request)
        {
            $orderId = $request->id;
            $order = Order::findOrFail($orderId);
            
            // Find the product in inventory to update stock
            $product = Inventory::where('product_id', $order->item_name)->first();
            
            if ($product) {
                // Update stock
                $product->stock -= $order->quantity;
                $product->actul_stock -= $order->quantity; // Update actual stock
                $product->save();
            }
        
            // Delete the order
            $order->delete();
        
            return response()->json(['status' => 'success']);
        }

        public function getorderDetails($id)
        {
            $user = User::find($id);
        
            if ($user) {
                return response()->json([
                    'mobileno' => $user->mobileno,
                    'gender' => $user->gender
                ]);
            }
        
            return response()->json(null);
        }
}
