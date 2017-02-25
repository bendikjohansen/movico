<?php

class HomeController extends Controller {
	
	public function home() {
		echo 'hi';
	}
	
	public function notFound() {
		echo '404: not found';
	}
	
	public function maintenance() {
		echo 'site under maintenance';
	}
	
}
