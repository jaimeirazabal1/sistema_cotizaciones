<?php

class ProductoController extends AppController{

	public function index(){
		if (Auth::is_valid()) {
			$this->productos = Load::model('producto')->find("conditions: user_id='".Auth::get('id')."'");
		}else{
			$this->productos = Load::model('producto')->find();
		}
	}

	public function create(){
		if (Input::hasPost('producto')) {
			$producto = Load::model('producto',Input::post('producto'));
			$producto->user_id = Auth::get('id');
			if ($producto->save()) {
				Flash::valid('Producto Guardado');
				Input::delete();
			}else{
				Flash::error("El producto no se pudo guardar!");
			}
		}
	}

	public function edit($producto_id){
		if (Input::hasPost('producto')) {
			$producto = Load::model("producto",Input::post('producto'));
			if ($producto->update()) {
				Flash::valid('Producto Actualizado!');
			}else{
				Flash::error('El producto no se ha podido actualizar!');
			}
		}

		$this->producto = Load::model('producto')->find($producto_id);
	}

	public function delete($producto_id){
		$producto = Load::model('producto')->find($producto_id);
		if ($producto->delete()) {
			Flash::valid('Producto Eliminado!');
		}else{
			Flash::error('No se pudo eliminar el producto!');
		}

		Redirect::to('producto/');
	}
}