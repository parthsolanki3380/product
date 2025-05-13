<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use DataTables;

class CustomerController extends Controller
{
    public function __construct(Customer $s)
    {
        $this->view = "customer";
        $this->route = "customer";
        $this->viewname = "Customer";
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Customer::latest();
            return Datatables::of($query)
                ->addColumn('action', function ($row) {
                    $btn = view('layouts.actionbtnpermission')
                        ->with(['id' => $row->id, 'route' => 'customer'])
                        ->render();
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('customer.index');
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
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'postal_code' => 'required|digits:6', // Exactly 6 digits for postal code
         
        ]);

        // Create a new customer
        $customer = new Customer();
        $customer->address = $validatedData['address'];
        $customer->city = $validatedData['city'];
        $customer->state = $validatedData['state'];
        $customer->country = $validatedData['country'];
        $customer->postal_code = $validatedData['postal_code'];
      
        // Save the data
        $customer->save();

        // Return a JSON response based on the success of the operation
        return response()->json(['status' => $customer ? 'success' : 'error']);
    }

    public function show($id)
    {
        $data['title'] = 'Show ' . $this->viewname;
        $data['data'] = Customer::findOrFail($id);
        $data['module'] = $this->viewname;
        $data['resourcePath'] = $this->view;

        return view('customer.show')->with($data);
    }

    public function edit($id)
    {
        $data['title'] = 'Edit ' . $this->viewname;
        $data['data'] = Customer::findOrFail($id);
        $data['module'] = $this->viewname;
        $data['resourcePath'] = $this->view;
        return view('general.edit_form')->with($data);
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'address' => 'required|string|max:255',
            'state' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'postal_code' => 'required|digits:6', // Exactly 6 digits for postal code
           
        ]);

        // Find the customer by ID
        $customer = Customer::findOrFail($id);

        // Update customer data
        $customer->address = $validatedData['address'];
        $customer->state = $validatedData['state'];
        $customer->country = $validatedData['country'];
        $customer->city = $validatedData['city'];
        $customer->postal_code = $validatedData['postal_code'];
       
        // Save the updated data
        $customer->save();

        // Return a JSON response based on the success of the operation
        return response()->json(['status' => 'success', 'message' => 'Customer updated successfully']);
    }
}
