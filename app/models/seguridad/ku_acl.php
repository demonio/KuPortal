<?php

Load::models('seguridad/usuario','seguridad/rol','seguridad/rol_recurso','seguridad/recurso');

Load::coreLib('acl2');

class KuAcl{
    
    protected $adapter;

    public function cargarPermisos() {
                
        $this->adapter = Acl2::factory();        
        
        //Consulta de roles
        $rol = new Rol();
        $roles = $rol->find();
        
        foreach ($roles as $value) {
            $rol_recurso = new RolRecurso();
            $roles_recursos = $rol_recurso->find("conditions: rol_id=$value->id");
            $resources = array();
            
            foreach ($roles_recursos as $value2) {                
                $resources[] = $value2->getRecurso()->url;
            }
            $this->adapter->allow($value->nombre, $resources);
        }
        
        //Consulta los usuarios
        $usuario = new Usuario();
        $usuarios = $usuario->find();
        
        foreach ($usuarios as $value) {            
            $this->adapter->user($value->id, array($value->getRol()->nombre));            
        }      
        
    }
    
    public function check($resource, $user) {        
        return $this->adapter->check($resource, $user);        
    }

}

?>
