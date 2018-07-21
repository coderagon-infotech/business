<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        Authenticate();
//        ModelLoad('dashboard_model');
    }

    public function index() {
//        $page_data['total_emp'] = $this->dashboard_model->user_count('E');
        backend_page_view('index', 'Dashboard', $this->folder_name, 'dashboard', $page_data);
    }

}
