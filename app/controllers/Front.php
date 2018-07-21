<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Front extends FRONT_Controller {
    /* show home */

    public function index() {
        front_page_view('index', 'Home_Title', 'home');
    }

    /* show about */

    public function about() {
        front_page_view('index', 'About', 'about');
    }

    /* show services */

    public function services() {
        front_page_view('index', 'Services', 'services');
    }
    
    /* show contact */

    public function contact() {
        front_page_view('index', 'Contact', 'contact');
    }

    public function contact_action() {
        /* post data */
        $name = $this->input->post("name", true);
        $email = $this->input->post("email", true);
        $subject = $this->input->post("subject", true);
        $message = $this->input->post("message", true);

        /* check validation */
        $form_required = array(
            'trim' => 'name,email,subject,message',
            'required' => 'name,email,subject,message',
            'valid_email' => 'email'
        );
        form_required($form_required);
        if ($this->form_validation->run() == false) {

            /* show error login form */
            $this->contact_action();
        } else {
            $insert_data = array(
                'name' => $name,
                'email' => $email,
                'subject' => $subject,
                'message' => $message
            );
            $this->db->insert('app_contact', $insert_data);
            redirect(site_url());
        }
    }

}
