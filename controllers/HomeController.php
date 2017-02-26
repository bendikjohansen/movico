<?php

class HomeController extends Controller {
	
	public function home() {
		return view('/home', ['title' => 'movico']);
	}
	
	public function notFound() {
		return view('404', ['title' => '404: Site not found']);
	}
	
	public function maintenance() {
		return view('maintenance', ['title' => 'Site under maintenance...']);
	}
	
}
