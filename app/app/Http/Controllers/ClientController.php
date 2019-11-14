<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Client;
use App\Tariff;

class ClientController extends Controller
{
	/**
	 * Показ формы заказа
	 */
	public function index()
	{
		$users = Client::with(['tariffs'])->get();
	    
	    return view('clients', [
	    	'clients' => $users,
	    ]);
	}
}
