<?php

/************************************
 * clase controlador principal
 * se encarga de cargar los modelos 
 * y las vistas
 **********************************/
class Controller
{
    /**********************
     * cargar modelo
     *************************/
    public function modelo($modelo)
    {
        require_once '../app/models/' . $modelo . '.php';
        /****************************
         * intanciar el modelo
         ****************************/
        return new $modelo();
    }

    /**********************
     * cargar vista
     *************************/
    public function view($view, $datos = [])
    {

        /****************************
         *ver si el archivo
         * vista existe
         ****************************/
        if (file_exists('../app/views/' . $view . '.php')) {
            require_once '../app/views/' . $view . '.php';
        } else {
            /***********************
             * si el archivo no existe 
             * die()
             ************************/
            die('la vista no existe');
        }
    }
}
