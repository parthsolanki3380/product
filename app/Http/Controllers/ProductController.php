<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Categories;
use DataTables;

class ProductController extends Controller
{
    public function __construct(Product $s){

        $this->view="product";
        $this->route="product";
        $this->viewname="Product";
    
    
    }
    
    
    
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Product::latest();
            return Datatables::of($query)
            
    
            
            
            
            ->addColumn('category_id', function ($row) {
                if ($row->category_id == 1) {
                    return 'iPhones';
                } else if ($row->category_id == 2) {
                    return 'Android Phones';
                } else if ($row->category_id == 3) {
                    return 'Laptop';
                } else {
                    return '-';
                }
            })
            ->addColumn('action', function ($row) {
                //  $btn = '<a href="'.route('user.edit', $row->id).'">Edit</a>&nbsp&nbsp&nbsp<a href="'.route('user.delete', $row->id).'">Delete</a>'; 
            

             $btn = view('layouts.actionbtnpermission')->with(['id'=>$row->id,'route'=>'product'])->render();      

           
           return $btn;
       })
    
        
    
    
    
        ->rawColumns(['category_id','action'])
            ->make(true);
        } 
    
        return view('product.index');
    
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
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string|max:500',
                'price' => 'required|numeric|min:0',
                'categories' => 'required|integer|exists:categories,id',
               
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4000',
            ]);
        
            $product = new Product();
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->category_id = $request->categories;
          
            if ($request->hasFile('image')) {
                $imageName = time().'.'.$request->image->getClientOriginalExtension();
                $request->image->move(public_path('product'), $imageName);
                $product->image = $imageName;
            }
        
            $product->save();
        
            return response()->json(['status' => 'success']);
        }
        
        public function show($id)
           {
            $data['title'] = 'show ' . $this->viewname;
            $data['data'] = Product::where('id', $id)->first();
            $data['module'] = $this->viewname;
            $data['resourcePath'] = $this->view;
            
            return view('product.show')->with($data);
           }
       
        
        public function edit($id)
        {
    
            $data['title'] = 'Edit ' . $this->viewname;
            $data['data'] = Product::where('id', $id)->first();
            $data['module'] = $this->viewname;
            $data['resourcePath'] = $this->view;
            return view('general.edit_form')->with($data);
        }
    
        
        public function update(Request $request, $id)
        {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string|max:500',
                'price' => 'required|numeric|min:0',
                'categories' => 'required|integer|exists:categories,id',
               
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4000',
            ]);
        
            $product = Product::findOrFail($id);
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->category_id = $request->categories;
         
            if ($request->hasFile('image')) {
                $imageName = time().'.'.$request->image->getClientOriginalExtension();
                $request->image->move(public_path('product/'), $imageName);
                $product->image = $imageName;
            }
        
            $product->save();
        
            return response()->json(['status' => 'success']);
        
    
    
    }
    public function getProductDetails($id)
{
    $product = Product::find($id);

    if ($product) {
        return response()->json([
            'name' => $product->name,
            'description' => $product->description,
            'price' => $product->price,
            'category_id' => $product->category_id,
        ]);
    }

    return response()->json(null, 404);
}
}
