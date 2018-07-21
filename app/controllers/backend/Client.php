<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends MY_Controller {

    public function __construct() {
        parent::__construct();
        /* load model */
        ModelLoad('client_model');
    }

    /* show manage client page */

    public function index() {
        $page_data['all_client'] = $this->client_model->get_all_client();
        backend_page_view('index', 'Client', 'client', $page_data);
    }

    /* show client form */

    public function add_client() {
        $page_data['all_client'] = array();
        backend_page_view('client', 'Add_Client', 'client', $page_data);
    }

    /* show client form */

    public function update_client($id) {
        $all_client = $this->client_model->get_all_client($id);
        if (isset($all_client) && count($all_client) > 0) {
            $page_data['all_client'] = $all_client[0];
            backend_page_view('client', 'Update_Client', 'client', $page_data);
        } else {
            show_404();
        }
    }

    /* save client information */

    public function client_action() {
        $id = (int) $this->input->post('id', true);
        $hidden_image = $this->input->post('hidden_image', true);
        /* check validation */
        if (isset($_FILES['image']) && $_FILES['image']['name'] == '' && $hidden_image == '') {
            $form_required = array(
                'required' => 'status,image',
                'callback_check_client_size' => 'image'
            );
        } else {
            $form_required = array(
                'required' => 'status',
                'callback_check_client_size' => 'image'
            );
        }
        form_required($form_required);
        if ($this->form_validation->run() == false) {

            /* show error client form */
            if ($id > 0) {
                $this->update_client();
            } else {
                $this->add_client();
            }
        } else {
            $_POST['image'] = $hidden_image;
            if (isset($_FILES['image']) && $_FILES['image']['name'] != '') {
                $path = config_item('upload_root_dir');
                if (!is_dir($path . 'client')) {
                    mkdir($path . 'client');
                    chmod($path . 'client', 0777);
                }
                if (isset($hidden_image) && !empty($hidden_image)) {
                    $dirPath = $path . 'client/';
                    if (is_dir($dirPath)) {
                        $dir_handle = opendir($dirPath);
                        if (!$dir_handle) {
                            return false;
                        }
                        while ($file = readdir($dir_handle)) {
                            if (!is_dir($dirPath . $hidden_image))
                                unlink($dirPath . $hidden_image);
                        }
                    }
                }
                $config['upload_path'] = $path . 'client/';
                $config['allowed_types'] = 'jpeg|jpg|png';
                $temp = explode(".", $_FILES["image"]['name']);
                $uniqid = uniqid();
                $new_name = $uniqid . '.' . end($temp);
                $config['file_name'] = $new_name;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $data['upload_data'] = '';
                $this->upload->do_upload('image');
                $data['upload_data'] = $this->upload->data();
                $file['upload_data'] = $this->upload->data('file_name');
                $file['upload_file_type'] = $this->upload->data('file_type');
                $_POST['image'] = $file['upload_data'];
            }
            $_POST['created_by'] = AdminID();
            $_POST['updated_by'] = AdminID();
            $_POST['created_on'] = date('Y-m-d H:i:s');
            $_POST['updated_on'] = date('Y-m-d H:i:s');
            if ($id > 0) {
                $post_array = post_array(array('image', 'status', 'updated_by', 'updated_on'));
                $this->client_model->update('', $post_array, "id='$id'");
                success(lang('Client_update'));
                redirect(backend('client', 1));
            } else {
                $post_array = post_array(array('image', 'status', 'created_by', 'created_on'));
                $this->client_model->insert('', $post_array);
                success(lang('Client_insert'));
                redirect(backend('client', 1));
            }
        }
    }

    /* delete client */

    public function delete_client($id) {
        $image = $this->db->get_where('app_client', array('id' => $id))->row()->image;
        $this->client_model->delete('', "id='$id'");
        $path = config_item('upload_root_dir');
        $dirPath = $path . 'client/';
        if (is_dir($dirPath)) {
            $dir_handle = opendir($dirPath);
            if (!$dir_handle) {
                return false;
            }
            while ($file = readdir($dir_handle)) {
                if (!is_dir($dirPath . $image))
                    unlink($dirPath . $image);
            }
        }
        success(lang('Client_delete'));
        echo 'true';
        exit;
    }

    public function check_client_size() {
        if (isset($_FILES['image']['tmp_name']) && $_FILES['image']['tmp_name'] != "") {
            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $valid_extension_arr = array('jpg', 'png', 'jpeg');
            if (!in_array(strtolower($ext), $valid_extension_arr)) {
                $this->form_validation->set_message('check_client_size', $this->lang->line('Valid_image'));
                return FALSE;
            } else {
                $data = getimagesize($_FILES['image']['tmp_name']);
                $width = isset($data[0]) ? (int) $data[0] : 0;
                $height = isset($data[1]) ? (int) $data[1] : 0;
                if ($width == 189 && $height == 43) {
                    return TRUE;
                } else {
                    $this->form_validation->set_message('check_client_size', $this->lang->line('Valid_client_image'));
                    return FALSE;
                }
            }
        }
    }

}
