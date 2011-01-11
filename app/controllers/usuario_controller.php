<?php

/**
 * Description of usuario_controller.php
 * 18/02/2010 03:40:52 PM
 *
 * @author
 * @copyright 2010
 * @license Put project's license
 */
Load::models('seguridad/usuario');

class UsuarioController extends AppController {

    public function before_filter() {
        /* /$this->submenu = array('admin/usuario/index/activo/1/'=>'Lista activos',
          'admin/usuario/index/inactivo/1/'=>'Lista inactivos',
          'admin/usuario/create/'=>'Nuevo'); */
        //View::template('usuario');
    }

    public function index() {
        View::select('mail_reset');
    }

    public function mail_reset() {
        $this->title = 'Resetear la contraseña';

        if (Input::hasPost('email_or_username')) {
            try {
                $email_or_username = Input::post('email_or_username');
                $usuario = new Usuario();
                if ($usuario->resetClaveByEmailOrUsername($email_or_username)) {
                    Flash::success('Se ha enviado un correo para confirmar el cambio de clave.');
                    Input::delete();
                } else {
                    Flash::error('Oops ha ocurrido un error.');
                    Input::delete();
                }
            } catch (KumbiaException $kex) {
                Input::delete();
                Flash::warning("Lo sentimos ha ocurrido un error:");
                Flash::error($kex->getMessage());
            }
        }
    }

    public function cambiar_clave($email, $reset_clave) {
        $this->title = 'Cambiar clave del usuario';

        $usuario = new Usuario();
        $usuario = $usuario->getUsuarioByEmail($email);
        $this->id = $usuario->id;

        if ($usuario->reset == $reset_clave) {
            if (Input::hasPost('usuario')) {
                try {
                    $data = Input::post('usuario');

                    if (Load::model('usuario')->cambiar_clave($data['id'], $data['clave'], $data['clave2'])) {
                        Flash::success('Cambio de clave realizado exitosamente.');
                        return Router::redirect('/');
                    } else {
                        Input::delete();
                        //$this->usuario = new Usuario(Input::post('usuario'));
                    }
                } catch (KumbiaException $kex) {
                    Input::delete();
                    Flash::warning("Lo sentimos ha ocurrido un error:");
                    Flash::error($kex->getMessage());
                }
            }
        } else {
            Flash::error('La clave para reseteo es incorrecta o ya fue usado.');
            return Router::redirect('usuario/mail_reset/');
        }
    }

}

?>