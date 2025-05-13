<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Product;
use App\Add;
use App\Order;
use App\Customer;
use App\contact;
use App\Image;
use App\Addsells;
use App\Sells;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }



     public function deleteMultiple(Request $request)
    {

        $table_name = $request->get('table_name');
        $id_array = explode(',', $request->get('id'));
  
        try {
           
            if($table_name === 'products')
          {
           DB::table('products')->where('id', $id_array)->delete();
          
          }
          if($table_name === 'add')
          {
           DB::table('orders')->where('addid', $id_array)->delete();
           DB::table($table_name)->whereIn('id', $id_array)->delete();
          }
          if($table_name === 'contact')
          {
           DB::table('contacts')->where('imageid', $id_array)->delete();
           DB::table($table_name)->whereIn('id', $id_array)->delete();
          }
          if($table_name === 'addsells')
          {
           DB::table('sells')->where('sellid', $id_array)->delete();
           DB::table($table_name)->whereIn('id', $id_array)->delete();
          }
        
         
       
          $res['status'] = 'Success';
          $res['message'] = 'Deleted successfully';
  
      } catch (\Exception $ex) {
        $res['status'] = 'Error';
        $res['message'] = $ex->getMessage();
      }
        return response()->json($res); //return response()->json(['status' => 'success', 'message' => 'Deleted']);
      }

      public function changeMultipleStatus(Request $request)
      {
      //  $table_name = $request->get('table_name');
      //  $param = $request->get('param');
      //  $id_array = explode(',', $request->get('id'));
  
  
               $fsdfsd = 'App\Models\\';
          $table_name = $fsdfsd.$request->get('table_name');
          $param = $request->get('param');
          $id_array = explode(',', $request->get('id'));
          
          try {
              if ($param == 0) {
                  foreach ($id_array as $id) {
                      $table_name::where('id', $id)
                      ->update([
                          'status' => 0,
                      ]);
                  }
              } elseif ($param == 1) {
                  foreach ($id_array as $id) {
                      $table_name::where('id', $id)
                      ->update([
                          'status' => 1,
                      ]);
                  }
              }
              
              $res['status'] = 'Success';
              $res['message'] = 'Status Change successfully';
          } catch (\Exception $ex) {
              $res['status'] = 'Error';
              $res['message'] = 'Something went wrong.';
          }
          return response()->json($res);
      }
}
