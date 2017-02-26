<?php

class HomeController extends Controller {
	
	public function home() {
		return view('/home', ['title' => 'movico']);
	}
	
	public function notFound() {
		return view('404');
	}
	
	public function maintenance() {
		if (under_maintenance())
			return view('maintenance');
		
		return view('404');
	}
	
}
