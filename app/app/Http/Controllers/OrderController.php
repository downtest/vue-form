<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Client;
use App\Tariff;

class OrderController extends Controller
{
	/**
	 * Показ формы заказа
	 */
	public function index()
	{
		$users = Client::with(['tariffs'])->get();
		dump($users);
	    
	    return view('form', [
	    	'tariffs' => Tariff::all(),
	    ]);
	}

	/**
	 * Получение всез тарифов
	 */
	public function getTariffs()
	{
		return response()->json(Tariff::all()->toArray());
	}

	/**
	 * Отправка формы заказа
	 */
	public function order(Request $request)
	{
		$validator = Validator::make($request->all(), [
	        'name' => 'required|string|min:3',
	        'phone' => 'required|string|min:7',
	        'tariff' => 'required|int|min:1|exists:tariffs,id',
	        'firstDay' => 'required|int|between:1,7',
	        'address' => 'required|string|min:1',
	    ]);

		if ($validator->fails()) {
	        return response()->json([
	        	'status' => false,
	        	'errors' => $validator->errors(),
	        ]);
	    }

	    $tariff = Tariff::find($request->tariff);
	    $client = Client::firstOrCreate([
	    	'phone' => $request->phone,
	    ]);

	    if ($client->name !== $request->name) {
	    	// Клиент изменил имя
	    	$client->update([
	    		'name' => $request->name,
	    	]);
	    }

	    // Привязываем новый заказ к клиенту
	    $client->tariffs()->attach($tariff->id, [
	    	'first_day' => $request->firstDay,
	    	'address' => $request->address,
	    	'created_at' => date('Y-m-d H:i:s'),
	    ]);

		return response()->json([
	    	'status' => true,
	    	'data' => $request->all(),
	    ]);
	}
}
