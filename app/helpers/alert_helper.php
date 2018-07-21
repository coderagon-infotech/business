<?php

function success($param) {
    $CI = & get_instance();
    $CI->session->set_flashdata('msg_class', "success");
    $CI->session->set_flashdata('msg', $param);
}

function error($param) {
    $CI = & get_instance();
    $CI->session->set_flashdata('msg_class', "error");
    $CI->session->set_flashdata('msg', $param);
}

function warning($param) {
    $CI = & get_instance();
    $CI->session->set_flashdata('msg_class', "warning");
    $CI->session->set_flashdata('msg', $param);
}

function info($param) {
    $CI = & get_instance();
    $CI->session->set_flashdata('msg_class', "info");
    $CI->session->set_flashdata('msg', $param);
}

function ShowAlert() {
    $CI = & get_instance();
    $type = $CI->session->flashdata('msg_class');
    $text = $CI->session->flashdata('msg');
    $html = '<script>';
    if ($type == 'success') {
        $html .= 'toastr.success("","' . $text . '");';
    } else if ($type == 'error') {
        $html .= 'toastr.error("","' . $text . '");';
    } else if ($type == 'warning') {
        $html .= 'toastr.warning("","' . $text . '");';
    } else if ($type == 'info') {
        $html .= 'toastr.info("","' . $text . '");';
    }
    $html .= '</script>';
    return $html;
}
