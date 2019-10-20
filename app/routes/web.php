<?php

use Illuminate\Http\Request;

use App\User;
use App\Tariff;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	$users = User::all();
	dump($users);

	$tariffs = Tariff::all();
	$tariffs->each(function($item){
		echo "{$item->name} ({$item->days})<br>";
	});

    
    return view('form', [
    	'tariffs' => $tariffs->toArray(),
    ]);
});

Route::post('/get-tariffs', function(){
	return response()->json(Tariff::all()->toArray());
});

Route::post('order', function(Request $request){
	$validator = Validator::make($request->all(), [
        'name' => 'required|string|min:3',
        'phone' => 'required|string|min:7',
        'tariff' => 'required|int|min:1',
        'firstDay' => 'required|int|between:1,7',
    ]);

	if ($validator->fails()) {
        return response()->json([
        	'status' => false,
        	'errors' => $validator->errors(),
        ]);
    }


	return response()->json([
    	'status' => true,
    	'data' => $request->all(),
    ]);
});
