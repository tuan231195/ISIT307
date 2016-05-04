<?php if ( ! defined('PATH_SYSTEM')) die ('Bad request');

class FT_Controller
{

    protected $view     = NULL;


    protected $model    = NULL;


    protected $library  = NULL;


    protected $helper   = NULL;


    protected $config   = NULL;

    protected $dao = NULL;

    public function __construct()
    {
        // config loader
        require_once PATH_SYSTEM . '/core/loader/FT_Config_Loader.php';
        $this->config   = new FT_Config_Loader();
        $this->config->load('config');


        // Loader Library
        require_once PATH_SYSTEM . '/core/loader/FT_Library_Loader.php';
        $this->library = new FT_Library_Loader();


        // Loader Library
        require_once PATH_SYSTEM . '/core/loader/FT_Helper_Loader.php';
        $this->helper = new FT_Helper_Loader();

        // Load View
        require_once PATH_SYSTEM . '/core/loader/FT_View_Loader.php';
        $this->view = new FT_View_Loader();

        //load Daos
        require_once PATH_SYSTEM . '/core/loader/FT_DAO_Loader.php';
        $this->dao = new FT_DAO_Loader();
    }

}