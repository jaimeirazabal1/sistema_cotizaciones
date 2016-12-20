<?php

class CotizacionController extends AppController{

	public function index(){
		$this->cotizaciones = array();
	}

	public function create(){
		$this->productos = Load::model('producto')->find("conditions: user_id='".Auth::get('id')."'");
	}

	public function edit(){

	}

	public function delete(){
		
	}
	
}