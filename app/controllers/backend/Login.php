<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

    public function __construct() {
        parent::__construct();
        ModelLoad('model_login');
    }

    /* view login page */

    public function index() {
        /* check login */
        if (Session()) {
            redirect(backend('dashboard'));
        } else {
            content_page_view('login', 'Admin_Login', 'content', $page_data);
        }
    }

    /* check login ccredential */

    public function login_action() {

        /* post data */
        $email = $this->input->post("email", true);
        $password = $this->input->post("password", true);

        /* check validation */
        $form_required = array(
            'trim' => 'email,password',
            'required' => 'email,password',
            'valid_email' => 'email'
        );
        form_required($form_required);
        if ($this->form_validation->run() == false) {

            /* show error login form */
            $this->login();
        } else {

            /* check login credential valid or not */
            $users = $this->model_login->authenticate($email, $password);
            if ($users['errorCode'] == 0) {
                error($users['errorMessage']);
                redirect(backend('login', 1));
            } else {
                success(lang('Welcome_Site'));
                redirect(backend('dashboard', 1));
            }
        }
    }

    /* admin current session unset */

    public function logout() {
        $this->session->unset_userdata("LoginID");
        $this->session->unset_userdata("AdminID");
        $this->session->unset_userdata("AccountType");
        $this->session->unset_userdata("ProfileComplate");
        $this->session->set_flashdata('msg_class', "success");
        $this->session->set_flashdata('msg', lang('Logout_success'));
        redirect('backend');
    }

}
