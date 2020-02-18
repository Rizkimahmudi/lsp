<?php 
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    require_once  APPPATH.'/libraries/PHPWord_/Autoloader.php';
    use PhpOffice\PHPWord\PHPWord_Autoloader as Autoloader;
    Autoloader::register();

    class Word extends Autoloader {

    }

    ?>
	