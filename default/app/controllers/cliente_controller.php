<?php 	
class ClienteController extends AppController{

	public function index(){
		if (Auth::is_valid()) {
			# code...
			$this->clientes = Load::model('cliente')->find("conditions: user_id='".Auth::get('id')."'");
			
		}else{

			$this->clientes = Load::model('cliente')->find();
		}
	}

	public function create(){
		if (Input::hasPost('cliente')) {
			$cliente = Load::model('cliente',Input::post('cliente'));
			if (Auth::is_valid()) {
				$cliente->user_id = Auth::get('id');
			}else{
				$user=Load::model('user')->find();
				$cliente->user_id = $user[0]->id;
			}
			if ($cliente->save()) {
				Flash::valid('Cliente guardado');
				Input::delete();
			}else{
				Flash::error('El cliente no se pudo crear');
			}
		}
	}
	public function edit($cliente_id){
		if (Input::hasPost('cliente')) {
			$cliente = Load::model('cliente',Input::post('cliente'));
			if (Auth::is_valid()) {
				$cliente->user_id = Auth::get('id');
			}else{
				$user=Load::model('user')->find();
				$cliente->user_id = $user[0]->id;
			}
			if ($cliente->update()) {
				Flash::valid('Cliente Actualizado');
			}else{
				Flash::error("El Cliente no se pudo actualizar");
			}
		}
		$this->cliente = Load::model('cliente')->find($cliente_id);
	}
	public function delete($cliente_id){
		$cliente = Load::model("cliente")->find($cliente_id);
		if ($cliente->delete()) {
			Flash::valid('Cliente Eliminado');
		}else{
			Flash::error('El cliente no pudo ser eliminado');

		}
		Redirect::to('cliente/');
	}

}

 ?>