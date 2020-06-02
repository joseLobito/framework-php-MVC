<?php

/**************************************
 * Cargando las librerias desde
 * libs
 ***************************************/
include_once 'config/Config.php';

/********************************
 * autoload php
 ********************************/
spl_autoload_register(function ($nameClass) {
    require_once 'libs/' . $nameClass . '.php';
});
