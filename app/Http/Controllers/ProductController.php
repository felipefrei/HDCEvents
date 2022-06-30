<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function contact(){

		return view('contact');
	}

	public function product(){

		$busca = request('search');
		return view('products', ['busca' => $busca]);
	}

	public function product_test($id=null){

		return view('product', ['id' => $id ]);
	}
}
