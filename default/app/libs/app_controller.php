<?php
/**
 * @see Controller nuevo controller
 */
require_once CORE_PATH . 'kumbia/controller.php';

/**
 * Controlador principal que heredan los controladores
 *
 * Todas las controladores heredan de esta clase en un nivel superior
 * por lo tanto los metodos aqui definidos estan disponibles para
 * cualquier controlador.
 *
 * @category Kumbia
 * @package Controller
 */
class AppController extends Controller
{

    final protected function initialize()
    {
    	$ruta = Router::get('controller').'/'.Router::get('action');
    	$rutas_publicas = array('user/login','user/logout','user/create');
    	if (!Auth::is_valid() and !in_array($ruta, $rutas_publicas)) {
    		Flash::info('Acceso Denegado');
    		Redirect::to('user/login');
    	}
    }

    final protected function finalize()
    {
        
    }

}
