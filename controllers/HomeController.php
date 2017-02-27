<?php

class HomeController extends Controller {
	
	public function home() {
		return view('home', ['title' => 'movico']);
	}
	
}
