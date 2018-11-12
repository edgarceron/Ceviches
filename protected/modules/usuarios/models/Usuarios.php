<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuarios
 *
 * @author sistemas2
 */
class Usuarios extends SofintUsers
{        
    public function getUsuarios()
    {
        $usuarios = SofintUsers::model()->findAll();
        return $usuarios;
    }
    
    public function getUsuario($id) 
    {
        $usuario = SofintUsers::model()->findByPk($id);
        return $usuario;
    }
    
    public function deleteUsuario($id)
    {
        $usuario = SofintUsers::model()->deleteByPk($id);
        return true;
    }
}
