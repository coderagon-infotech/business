<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ADMIN_Controller extends CI_Controller {

    public $folder_name;

    public function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        /* Load Language */
        $lang_folder = 'english';
        $files = scandir(APPPATH . "language/" . $lang_folder . "/");
        $dot = array_search('.', $files);
        $doubledot = array_search('..', $files);
        $index = array_search('index.html', $files);
        if (isset($dot)) {
            unset($files[$dot]);
        }
        if (isset($doubledot)) {
            unset($files[$doubledot]);
        }
        if (isset($index)) {
            unset($files[$index]);
        }
        foreach ($files as $value) {
            $name = str_replace('_lang.php', '', $value);
            $all_files[] = $name;
        }
        load_lang($all_files);
        $this->folder_name = 'Admin/';
    }

}

class FRONT_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        /* Load Language */
        $this->lang->load('front', 'english');
    }

}
