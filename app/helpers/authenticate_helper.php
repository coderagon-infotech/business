<?php

defined('BASEPATH') OR exit('No direct script access allowed');

function Authenticate() {
    $CI = & get_instance();
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: private, no-store, max-age=0, no-cache, must-revalidate, post-check=0, pre-check=0");
    header("Pragma: no-cache");

    $session_val = (int) $CI->session->userdata('AdminID');
    if ($session_val == 0) {
        $CI->session->set_flashdata('msg_class', "error");
        $CI->session->set_flashdata('msg', lang('Login_protected'));
        redirect("backend");
    }
}

function Session() {
    $CI = & get_instance();
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: private, no-store, max-age=0, no-cache, must-revalidate, post-check=0, pre-check=0");
    header("Pragma: no-cache");

    $login = (int) $CI->session->userdata('AdminID');
    if ($login > 0) {
        return true;
    } else {
        return false;
    }
}

function load_lang($files = array(), $lang = 'english') {
    $CI = & get_instance();
    if (isset($files) && !empty($files) && count($files) > 0) {
        foreach ($files as $value) {
            $CI->lang->load($value, $lang);
        }
    }
}

function backend($param, $base = NULL) {
    if (is_null($base)) {
        return site_url('backend/' . $param);
    } else {
        return 'backend/' . $param;
    }
}

function ModelLoad($param) {
    $CI = & get_instance();
    return $CI->load->model($param);
}



function form_required($param, $val_key = NULL) {
    $CI = &get_instance();
    if (isset($param) && count($param) > 0) {
        foreach ($param as $key => $value) {
            $arr_value = explode(',', $value);
            $validation[] = '';
            foreach ($arr_value as $value_arr) {
                if (array_key_exists($value_arr, $validation)) {
                    $key_validation = $validation[$value_arr];
                    $val_validation = $key_validation . "|" . $key;
                    $validation[$value_arr] = $val_validation;
                } else {
                    $validation[$value_arr] = $key;
                }
            }
        }
        $final_array = array_filter($validation);
        foreach ($final_array as $f_key => $f_value) {
            $CI->form_validation->set_rules($f_key, isset($val_key) && !is_null($val_key) ? $f_key : '', $f_value);
        }
        $CI->form_validation->set_error_delimiters('<label class="error">', '</label>');
    }
}

function Model($method, $param = NULL) {
    $CI = get_instance();
    $get_load_model = (array) $CI->load->model();
    foreach ($get_load_model as $key => $value) {
        $new_model[] = $value;
    }
    if (isset($new_model) && count($new_model[7]) > 0) {
        foreach ($new_model[7] as $key => $value) {
            if (method_exists($value, $method)) {
                if (is_null($param)) {
                    $result = $CI->$value->$method();
                } else {
                    if (isset($param) && count($param) > 0) {
                        $param_val = $CI->$value->$method;
                        foreach ($param as $keys => $row) {
                            if ($keys == 0) {
                                $param_val .= "( '" . $row . "'";
                            } else if (count($param) == $keys + 1) {
                                $param_val .= ",'" . $row . "')";
                            } else {
                                $param_val .= ",'" . $row . "'";
                            }
                        }
                        $result = $param_val;
                    } else {
                        $result = $CI->$value->$method();
                    }
                }
                return $result;
            }
        }
    }
}

function breadcrumb($page_title = 'dashboard', $name = NULL, $method = NULL) {
    $html = '<div class="page-title-box">
                <div class="btn-group float-right">
                    <ol class="breadcrumb hide-phone p-0 m-0">
                        <li class="breadcrumb-item"><a href="' . site_url('backend/dashboard') . '">' . lang('Dashboard') . '</a></li>';
    if (!is_null($name) && !is_null($method)) {
        $html .= '<li class="breadcrumb-item active"><a href="' . site_url('backend/' . $method) . '">' . lang($name) . '</a></li>';
    }
    if (!is_null($page_title) && strtolower($page_title) != 'dashboard') {
        $html .= '<li class="breadcrumb-item active">' . ucfirst($page_title) . '</li>';
    }
    $html .= '</ol>
                </div>
                <h4 class="page-title">' . ucfirst($page_title) . '</h4>
            </div>';
    return $html;
}

function emp_work($param = 0) {
    $text_color = isset($param) && $param > 0 ? 'text-success' : 'text-danger';
    $html = '<span class="text-center ' . $text_color . '"><i class="mdi mdi-arrow-up"></i> <span>' . number_format($param, 2) . '%</span></span>';
    return $html;
}

function side_menu() {
    $CI = &get_instance();
    $CI->db->where('parent', '0');
    $CI->db->where('status', 'A');
    $CI->db->order_by('sort');
    return $CI->db->get('app_menu')->result_array();
}

function side_parent_menu($parent) {
    $CI = &get_instance();
    $CI->db->where('parent', $parent);
    $CI->db->where('status', 'A');
    $CI->db->order_by('sort');
    return $CI->db->get('app_menu')->result_array();
}

function AdminID() {
    $CI = & get_instance();
    return (int) $CI->session->userdata('AdminID');
}

function DateFormat($date, $Custome_formate = NULL) {
    $Custome_formate = 'd-m-Y';
    $CI = & get_instance();
    if (is_null($Custome_formate)) {
        $this->db->select('date_format');
        $site_setting = $CI->db->get('tbl_site_setting')->result_array();
        $Custome_formate = $site_setting[0]['date_format'];
    }
    return date($Custome_formate, strtotime($date));
}

function get_image($image) {
    $img = json_decode($image);
    return $img->thumb;
}

function get_image_pro($image) {
    $img = json_decode($image);
    return $img->profile;
}

function check_image($image) {
    if (file_exists(dirname(BASEPATH) . "/" . $image) && pathinfo($image, PATHINFO_EXTENSION) != '') {
        $path = base_url() . $image;
    } else {
        $path = base_url() . IMG_PATH . "no-client.jpg";
    }
    return $path;
}

function get_general_setting() {
    $CI = & get_instance();
    $res = $CI->db->get_where('app_general', array('id' => 1))->result_array();
    return isset($res) && count($res) > 0 ? $res[0] : '';
}

function get_slider() {
    $CI = & get_instance();
    $res = $CI->db->where('status', 'A')->order_by('sort')->get('app_banner')->result_array();
    return $res;
}

function get_about_limit() {
    $CI = & get_instance();
    $CI->db->where('status', 'A')->order_by('sort');
    $CI->db->limit(1);
    $res = $CI->db->get('app_about')->result_array();
    return isset($res) && count($res) > 0 ? $res[0] : '';
}

function get_about() {
    $CI = & get_instance();
    $CI->db->where('status', 'A')->order_by('sort');
    $res = $CI->db->get('app_about')->result_array();
    return $res;
}

function get_services($limit = NULL) {
    $CI = & get_instance();
    $CI->db->where('status', 'A');
    if (!is_null($limit)) {
        $CI->db->limit($limit);
    }
    $res = $CI->db->get('app_service')->result_array();
    return $res;
}

function get_team() {
    $CI = & get_instance();
    $res = $CI->db->where('status', 'A')->get('app_team')->result_array();
    return $res;
}

function get_testimonials() {
    $CI = & get_instance();
    $res = $CI->db->where('status', 'A')->get('app_testimonial')->result_array();
    return $res;
}

function get_client() {
    $CI = & get_instance();
    $res = $CI->db->where('status', 'A')->get('app_client')->result_array();
    return $res;
}

?> 