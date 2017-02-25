<?php

class HomeController extends Controller {
	
	public function home() {
		return View::get('home', ['title' => 'EasyMVC']);
	}
	
	public function notFound() {
		return View::get('404');
	}
	
	public function maintenance() {
		echo 'site under maintenance';
	}
	
}
