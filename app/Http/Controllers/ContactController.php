<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use App\Image;
use DataTables;



class ContactController extends Controller
{
    public function __construct(Contact $s){

        $this->view="contact";
        $this->route="contact";
        $this->viewname="Contact";
    
    
    }
    
    
    
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Contact::latest();
            return Datatables::of($query)
            
    
    
            
            
            ->addColumn('action', function ($row) {
                //  $btn = '<a href="'.route('user.edit', $row->id).'">Edit</a>&nbsp&nbsp&nbsp<a href="'.route('user.delete', $row->id).'">Delete</a>'; 
            

             $btn = view('layouts.actionbtnpermission')->with(['id'=>$row->id,'route'=>'contact'])->render();      

           
           return $btn;
       })
    
        
    
    
    
            ->rawColumns(['action'])
            ->make(true);
        } 
    
        return view('contact.index');
    
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
    
            $customerData = $request->only(['Company_Name', 'Company_Email', 'Company_Address', 'Company_number']);
           
            $user = Contact::create($customerData);
             
                if ($request->has('imagename')) {
                    foreach ($request->imagename as $key => $value) {
                        if (!empty($value)) {
                            $imageModel = new Image();
                            $imageModel->imageid = $user->id;
                            $imageModel->imagename = $value;
        
                            if ($request->hasFile("image.$key")) {
                                $file = $request->file("image.$key");
                                $filename = time() . '_' . $file->getClientOriginalName();
                                $file->move(public_path('images'), $filename);
                                $imageModel->image = $filename;
                            }
        
                            $imageModel->save();
                        }
                    }
                }
        
                if ($user) {
                return response()->json(['status' => 'success']);
            } else {
                return response()->json(['status' => 'error']);
            }
        }
    
        
        public function show($id)
           {
            $data['title'] = 'show ' . $this->viewname;
            $data['data'] = Contact::where('id', $id)->first();
            $data['module'] = $this->viewname;
            $data['resourcePath'] = $this->view;
            
            return view('product.show')->with($data);
           }
       
        
        public function edit($id)
        {
    
            $data['title'] = 'Edit ' . $this->viewname;
            $data['data'] = Contact::where('id', $id)->first();
            $data['module'] = $this->viewname;
            $data['resourcePath'] = $this->view;
            return view('general.edit_form')->with($data);
        }
    
        
        public function update(Request $request, $id)
        {
    
            $items = Contact::findOrFail($id);
            $items->phone_number = $request->phone_number;
           
            $items->save();
    
        
        if($items)
        {
            return response()->json(['status' => 'success']);
        }else
        {
            return response()->json(['status' => 'error']);
    
        }
    
    
    
    }
}
