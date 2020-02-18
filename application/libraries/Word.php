<?php 
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*     require_once  APPPATH.'/libraries/PhpOffice/PhpWord/Autoloader.php';
    use PhpOffice\PhpWord\Autoloader as Autoloader;
    Autoloader::register();
 */
		require_once APPPATH.'vendor/autoload.php';
		use PhpOffice\PhpWord\PhpWord;

		class Word extends PHPWord {
			public function __construct() {
				parent::__construct();
			}
		}
		
    /* class Word extends Autoloader {

    } */

    ?>