<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventory;
use App\Product;
use DataTables;

class InventoryController extends Controller
{
    public function __construct(Inventory $inventory)
    {
        $this->view = "inventory";
        $this->route = "inventory";
        $this->viewname = "Inventory";
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Inventory::latest();
            return Datatables::of($query)
                ->addColumn('action', function ($row) {
                    $btn = view('layouts.actionbtnpermission')
                        ->with(['id' => $row->id, 'route' => 'inventory'])
                        ->render();
                    return $btn;
                })
                ->addColumn('product_id', function ($row) {
                    // Fetch the product name based on product_id
                    $product = Product::find($row->product_id);
                    return $product ? $product->name : 'Unknown Product';
                })
                ->rawColumns(['action','product_id'])
                ->make(true);
        }
        return view('inventory.index');
    }
    
    public function create()
    {
        $data['title'] = 'Add ' . $this->viewname;
        $data['module'] = $this->viewname;
        $data['resourcePath'] = $this->view;
        return view('general.add_form')->with($data);
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'stock' => 'required|integer|min:1',
            'defective' => 'nullable|integer|min:0',
        ]);

        // Check if the product already exists in the inventory
        $productInInventory = Inventory::where('product_id', $validatedData['product_id'])->exists();

        if ($productInInventory) {
            return response()->json(['status' => 'error', 'message' => 'Product is already in the inventory.'], 422);
        }

        // Create a new inventory record
        $inventory = new Inventory();
        $inventory->product_id = $validatedData['product_id'];
        $inventory->stock = $validatedData['stock'];
        $inventory->defective = $validatedData['defective'] ?? 0; // Default to 0 if defective is not provided
        $inventory->save();

        // Return a JSON response based on the success of the operation
        return response()->json(['status' => 'success', 'message' => 'Inventory added successfully']);
    }

    public function show($id)
    {
        $data['title'] = 'Show ' . $this->viewname;
        $data['data'] = Inventory::findOrFail($id);
        $data['module'] = $this->viewname;
        $data['resourcePath'] = $this->view;

        return view('inventory.show')->with($data);
    }

    public function edit($id)
    {
        $data['title'] = 'Edit ' . $this->viewname;
        $data['data'] = Inventory::findOrFail($id);
        $data['module'] = $this->viewname;
        $data['resourcePath'] = $this->view;
        return view('general.edit_form')->with($data);
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'stock' => 'required|integer|min:1',
            'defective' => 'nullable|integer|min:0',
        ]);

        // Find the inventory record by ID
        $inventory = Inventory::findOrFail($id);

        // Update inventory data
        $inventory->product_id = $validatedData['product_id'];
        $inventory->stock = $validatedData['stock'];
        $inventory->defective = $validatedData['defective'] ?? 0; // Default to 0 if defective is not provided
        $inventory->save();

        // Return a JSON response based on the success of the operation
        return response()->json(['status' => 'success', 'message' => 'Inventory updated successfully']);
    }
}
