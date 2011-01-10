<?php

/**
 * 
 * 
 */
Load::model('seguridad/rol_recurso');
Load::model('seguridad/rol');
Load::model('seguridad/recurso');
Load::model('seguridad/menu');

class AccesoController extends AppController {
    
    public $modulo = 'Accesos';

    public function index() {
        $rol = new Rol();
        $this->roles = $rol->find();
    }

    /**
     * Crea un Registro
     */
    public function crear() {
        if (Input::hasPost('rol_recurso')) {

            $obj = Load::model('rol_recurso');
            //En caso que falle la operación de guardar
            if (!$obj->save(Input::post('rol_recurso'))) {
                Flash::error('Falló operación');
                //se hacen persistente los datos en el formulario
                $this->rol_recurso = $obj;
                return;
            }
            return Router::redirect();
        }
        // Solo es necesario para el autoForm
        $this->rol_recurso = Load::model('rol_recurso');
    }

    /**
     * Edita un Registro
     */
    public function editar($id) {

        //se verifica si se ha enviado via POST los datos
        if (Input::hasPost('rol_recurso')) {
            $obj = Load::model('rol_recurso');
            if (!$obj->update(Input::post('rol_recurso'))) {
                Flash::error('Falló operación');
                //se hacen persistente los datos en el formulario
                $this->rol_recurso = Input::post('rol_recurso');
            } else {
                return Router::redirect();
            }
        }

        //Aplicando la autocarga de objeto, para comenzar la edición
        $this->rol_recurso = Load::model('rol_recurso')->find((int) $id);
    }

    /**
     * Borra un Registro
     */
    public function borrar($id) {
        if (!Load::model('rol_recurso')->delete((int) $id)) {
            Flash::error('Falló Operación');
        }        
        Router::redirect();
    }

}