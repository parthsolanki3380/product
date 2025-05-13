<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) { 
    $api->group(['namespace' => 'App\Http\Controllers\Api\V1', 'prefix' => 'v1'], function ($api) {
      

        $api->post('login', 'CompanyController@login');
      
        $api->get('list/{$id}','CompanyController@list');



        $api->group(['middleware' => 'jwt.verify'], function ($api_child) {

           
            $api_child->get('get-user','CompanyController@getuser');
            $api_child->post('store','CompanyController@store');
            $api_child->post('update','CompanyController@update');
            $api_child->post('delete','CompanyController@delete');
          
        });
    });
});
