<?php

/**
 * 
 * 
 */
Load::model('seguridad/recurso');
Load::model('seguridad/menu');

class RecursoController extends ScaffoldController {
    
    public $modulo = 'Recursos';
    public $scaffold = 'kuportal';
    public $model = 'recurso';

}