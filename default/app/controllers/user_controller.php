<?php

class UserController extends AppController{


	public function index(){
		$this->users=Load::model("user")->find();
	}
	public function create(){
		if (Input::hasPost('user')) {
			$input = Input::post("user");
			if ($input['password'] != $input['password2']) {
				Flash::error("Passwords no coinciden");
				return;
			}
			$user = Load::model("user",Input::post("user"));
			$user->password = Password::encriptar($user->password);
			if ($user->save()) {
				Flash::valid("Usuario Creado");
				Input::delete();
			}else{
				Flash::error("No se creo el Usuario");
			}
		}
	}
	public function changePassword($user_id){
		if (Input::hasPost('user')) {
			$input = Input::post("user");
			if ($input['password'] != $input['password2']) {
				Flash::error("Passwords no coinciden");
				return;
			}
			$user = Load::model('user')->find($user_id);
			$user->password = Password::encriptar($user->password);
			if ($user->update()) {
				Flash::valid("Password Actualizado");
				Input::delete();
			}else{
				Flash::error("No se creo actualizo el password");
			}		
		}
		$this->user = Load::model('user')->find($user_id);
		//para que no salga la password
		$this->user->password = '';
	}
	public function delete($user_id){
		$user = Load::model('user')->find($user_id);
		if ($user->delete()) {
			Flash::valid('Usuario Eliminado');
		}else{
			Flash::error('No se elimino el usuario');
		}
		Redirect::to('user/');
	}
	public function login(){
		if (Input::post('username') and Input::post('username')) {
            $pwd = Password::encriptar(Input::post("password"));
            $usuario=Input::post("username");
 
            $auth = new Auth("model", "class: user", "username: $usuario", "password: $pwd");
            if ($auth->authenticate()) {
                Redirect::to("cliente/");
            } else {
                Flash::error("Nombre de usuario o password incorrectos");
            }
		}
	}
	public function logout(){
		Auth::destroy_identity();
		Redirect::to('user/login');
	}
}