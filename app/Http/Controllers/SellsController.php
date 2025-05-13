<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sells;
use App\Product;
use App\Addsells;
use App\Inventory;
use DataTables;

class SellsController extends Controller
{
    public function __construct(Sells $s){

        $this->view="sells";
        $this->route="sells";
        $this->viewname="Sells";
    
    
    }   
    
    
    
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Addsells::latest();
            return Datatables::of($query)
            
    
    
            
            
            
            ->addColumn('action', function ($row) {
                //  $btn = '<a href="'.route('user.edit', $row->id).'">Edit</a>&nbsp&nbsp&nbsp<a href="'.route('user.delete', $row->id).'">Delete</a>'; 
            

             $btn = view('layouts.actionbtnpermission')->with(['id'=>$row->id,'route'=>'sells'])->render();      

           
           return $btn;
       })
    
        
    
    
    
            ->rawColumns(['action'])
            ->make(true);
        } 
    
        return view('sells.index');
    
    }
    
        
        public function create()
        {
    
            $data['title'] = 'AddSells' . $this->viewname;
            $data['module'] = $this->viewname;
            $data['resourcePath'] = $this->view;
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
    $ad = new Addsells();
    $ad->add = $request->add;
    $ad->total_price = $request->total_price;
    $ad->quantity_total_price = $request->quantity_total_price;
    $ad->gst_item_total = $request->gst_item_total ?? 0;
    $ad->final_item_total = $request->final_item_total ?? 0;

    $ad->save();

    // Create Order records and manage inventory
    if (is_array($request->item_name) && is_array($request->price) && is_array($request->quantity) && is_array($request->itempricetotal)) {
        foreach ($request->item_name as $key => $itemName) {
            if ($itemName != '') {
                // Create new Order
                $order = new Sells();
                $order->sellid = $ad->id; // Foreign key linking to parent
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
                    // Increment stock by quantity ordered
                    $product->used += $order->quantity;  // Update used stock
                    $product->actul_stock -= $order->quantity; // Update actual stock
                    $product->save();
                } else {
                    // If the product does not exist, create a new Inventory entry
                    $inv = new Inventory();
                    $inv->product_id = $itemName; // Assuming item_name corresponds to product_id
 // Set stock to the quantity ordered
                     $product->used += $order->quantity; // Initially no stock has been used
                    $inv->actul_stock -= $order->quantity; // Set actual stock to quantity ordered
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
            $data['data'] = Sells::where('id', $id)->first();
            $data['module'] = $this->viewname;
            $data['resourcePath'] = $this->view;
            
            return view('order.show')->with($data);
           }
       
        
        public function edit($id)
        {
    
            $data['title'] = 'Edit ' . $this->viewname;
            $data['data'] = Sells::where('id', $id)->first();
            $data['module'] = $this->viewname;
            $data['resourcePath'] = $this->view;
            return view('general.edit_form')->with($data);
        }
    
        
        public function update(Request $request, $id)
        {
    
    // Update the parent record
    $ad = Addsells::findOrFail($id);
    $ad->add = $request->add;
    $ad->total_price = $request->total_price;
    $ad->quantity_total_price = $request->quantity_total_price;
    $ad->save();

    // Update existing child records
    if ($request->edititemname) {
        foreach ($request->edititemname as $key => $value) {
            if ($value != '') {
                // Ensure hidden_id exists for updating
                if (isset($request->hidden_id[$key])) {
                    $edititemchild = [
                        'item_name' => $value,
                        'price' => $request->editprice[$key] ?? null,
                        'quantity' => $request->editquantity[$key] ?? null,
                        'itempricetotal' => $request->edititempricetotal[$key] ?? null,
                    ];
                    Order::where('id', $request->hidden_id[$key])->update($edititemchild);
                }
            }
        }
    }

    // Insert new child records
    if (is_array($request->item_name) && is_array($request->price) && is_array($request->quantity) && is_array($request->itempricetotal)) {
        foreach ($request->item_name as $key => $value) {
            if ($value != '') {
                $order = new Sells();
                $order->sellid = $ad->id; // Foreign key linking to parent
                $order->item_name = $value;
                $order->price = $request->price[$key];
                $order->quantity = $request->quantity[$key];
                $order->itempricetotal = $request->itempricetotal[$key];
                $order->save();
            }
        }
    }

    // Return success response
return response()->json(['status' => 'success']);
    
    
    }
    public function deleteOrder($id)
 {
     // Find the Order record by its ID
     $add = Sells::findOrFail($id)->delete();

 // Assuming the 'addid' field is a foreign key in the Order table pointing to the Add table
    //  $add = Add::where('id', $order->addid)->first();

     // Delete both the Order and Add records
    //  if ($add) {
    //              $add->delete();  // Delete the related Add record
    //  }

    
    return redirect()->route('order.index')->with('status', 'Order and associated Add record deleted successfully');
}
public function getStock($id)
{
    $inventory = Inventory::where('product_id', $id)->first();
    if ($inventory) {
        return response()->json(['stock' => $inventory->actul_stock]);
    } else {
        return response()->json(['stock' => 0]); // Return 0 if no inventory is found
    }
}
}
   
