<?php

/**
 * KuPortal - KumbiaPHP Portal
 * PHP version 5
 * LICENSE
 *
 * This source file is subject to the GNU/GPL that is bundled
 * with this package in the file docs/LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to deivinsontejeda@gmail.com so we can send you a copy immediately.
 *
 * @author Henry Stivens Adarme (http://twitter.com/henrystivens)
 */
class RolRecurso extends ActiveRecord {

    public function initialize() {
        //Relaciones
        $this->belongs_to('rol');
        $this->belongs_to('recurso');
        $this->belongs_to('menu');
    }

    /**
     * Obtiene el menu de acuerdo al perfil
     *
     * @param int $rol_id
     * @param int $menu     
     * @return resulset
     */
    public function getSubMenu($rol_id=null, $menu=null, $estado='A', $visible=null) {
        if ($visible) {
            return $this->find("rol_id = $rol_id AND estado = '$estado' AND menu_id = $menu AND visible= $visible");
        } else {
            return $this->find("rol_id = $rol_id AND estado = '$estado' AND menu_id = $menu");
        }
    }

    /**
     * Obtiene el Menu
     *
     * @param int $rol_ides
     * @return resulset
     */
    public function getMenuX($rol_id=1) {
        return $this->find("rol_id=$rol_id", 'group: menu_id', 'columns: menu_id');
    }

}

?>
