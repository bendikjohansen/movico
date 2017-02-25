<?php

class HomeController extends Controller {
	
	public function home() {
		return View::get('/home', ['title' => 'movico']);
	}
	
	public function notFound() {
		return View::get('404', ['title' => '404: Site not found']);
	}
	
	public function maintenance() {
		return View::get('maintenance', ['title' => 'Site under maintenance...']);
	}
	
}
