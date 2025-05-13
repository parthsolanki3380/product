<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DataTables;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportUser;
use App\Exports\ExportUser;

class UserController extends Controller
{
 public function __construct(User $s){

    $this->view="user";
    $this->route="user";
    $this->viewname="User";


}

public function importView(Request $request){
    return view('importFile');
}

public function import(Request $request){
    Excel::import(new ImportUser, $request->file('file')->store('files'));
    return redirect()->back();
}

public function exportUsers(Request $request){
    return Excel::download(new ExportUser, 'users.xlsx');
}



public function index(Request $request)
{
    
    if ($request->ajax()) {
        $query = User::latest();
        return Datatables::of($query)
        ->addColumn('action', function ($row) {
                // $btn = '<a href="'.route('user.edit', $row->id).'">Edit</a>&nbsp&nbsp&nbsp<a href="'.route('user.delete', $row->id).'">Delete</a>'; 
            if($row->id == 1)
            { 
               $btn = 'Cannot Change'; 

           }
           else
           {

               $btn = view('layouts.actionbtnpermission')->with(['id'=>$row->id,'route'=>'user'])->render();      

           }
           return $btn;
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
        ->addColumn('image', function($row) {
            $btn = ' ';
            if ($row->image) {
                $btn = '<img src="' . asset("img/" . $row->image) . '" width="50px" height="50px">';
            }
            return $btn;
        })
        ->addColumn('status', function ($row) {
            if ($row->id == 1) {
                return 'Cannot Change';
            } else {
                $status = route('user.status', $row->id); 
                return view('layouts.singlechecked', ['id' => $row->id, 'status' => $row->status, 'route' => 'user'])->render();
            }
        })
       
        





        ->rawColumns(['action','gender','image','status'])
        ->make(true);
    } 

    return view('user.index');

}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'mobileno' => 'required|digits:10',
            'gender' => 'required|in:1,2',
            'password' => 'required|min:6',
            
        ]);
    
        // Get all request parameters
        $param = $request->all();
    
        // Store the plain password for display purposes (optional)
        $param['show_password'] = $param['password'];
    
        // Hash the password for secure storage
        $param['password'] = bcrypt($param['password']);
    
        // Handle image upload if present
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('img/'), $imageName);
            $param['image'] = $imageName;
        }
    
        // Create the user record in the database
        $user = User::create($param);
    
        // Check if the user was created successfully
        if ($user) {
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'error']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data['title'] = 'Edit ' . $this->viewname;
        $data['data'] = User::where('id', $id)->first();
        $data['module'] = $this->viewname;
        $data['resourcePath'] = $this->view;
        return view('general.edit_form')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

       $data = $request->all();unset($data['_token'],$data['_method']);
       if($request->password)
       {
        $data['show_password'] = $request->password;
        $data['password'] = bcrypt($request->password);
    }else
    {
        unset($data['password']);
    }

    $data = User::where('id', $id)->update($data);

    if($data)
    {
        return response()->json(['status' => 'success']);
    }else
    {
        return response()->json(['status' => 'error']);

    }



}


public function status(Request $request)
{

    $param['status'] = $request->status;
    $use = User::where('id',$request->id)->first();

    $use->update($param);
    // dd($param);


    if($use)
    {
        return response()->json(['status' => 'success']);
    }
    else
    {
        return response()->json(['status' => 'error']);
    }
}





}
