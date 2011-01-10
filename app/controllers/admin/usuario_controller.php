<?php

/**
 * 
 * 
 */
Load::model('seguridad/usuario');

class UsuarioController extends AppController {

    public $modulo = 'Usuarios';

    public function index($page=1) {
        $this->results = Load::model('usuario')->paginate("page: $page", 'order: id desc');
    }

    /**
     * Crea un Registro
     */
    public function crear() {
        if (Input::hasPost('usuario')) {

            $obj = Load::model('usuario');
            //En caso que falle la operación de guardar
            if (!$obj->save(Input::post('usuario'))) {
                Flash::error('Falló operación');
                //se hacen persistente los datos en el formulario
                $this->usuario = $obj;
                return;
            }
            return Router::redirect();
        }
        // Solo es necesario para el autoForm
        $this->usuario = Load::model('usuario');
    }

    /**
     * Edita un Registro
     */
    public function editar($id) {

        //se verifica si se ha enviado via POST los datos
        if (Input::hasPost('usuario')) {
            $obj = Load::model('usuario');
            if (!$obj->update(Input::post('usuario'))) {
                Flash::error('Falló operación');
                //se hacen persistente los datos en el formulario
                $this->usuario = Input::post('usuario');
            } else {                
                return Router::redirect();
            }
        }

        //Aplicando la autocarga de objeto, para comenzar la edición
        $this->usuario = Load::model('usuario')->find((int) $id);
    }

    /**
     * Ver un Registro
     */
    public function ver($id) {
        $this->result = Load::model('usuario')->find_first((int) $id);
    }

    /**
     * Cambia la clave de un usuario.
     * 
     * @param long $id
     * @return View
     */
    public function cambiar_clave($id = null) {
        if ($id) {
            if (Input::hasPost('usuario')) {
                try {
                    $data = Input::post('usuario');

                    if (Load::model('usuario')->cambiar_clave($id, $data['clave'], $data['clave2'])) {
                        Flash::success('Cambio de clave realizado exitosamente.');
                        return Router::route_to('action: index');
                    } else {
                        Input::delete();
                    }
                } catch (KumbiaException $kex) {
                    Input::delete();
                    Flash::warning("Lo sentimos ha ocurrido un error:");
                    Flash::error($kex->getMessage());
                }
            }
        } else {
            Flash::warning('No es un usuario válido.');
            return Router::redirect();
        }
    }

}