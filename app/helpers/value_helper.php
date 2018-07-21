<?php

function get_CompanyName() {
    return 'CodeRagon';
}

function front_page_view($page, $title, $folder = NULL, $data = NULL) {
    $CI = & get_instance();
    $data['page_title'] = lang($title);
    $data['page_folder'] = 'front/' . $folder;
    $data['page_name'] = $page;
    $CI->load->view('front/_layout', $data);
}

function backend_page_view($page, $title, $main_folder, $folder = NULL, $data = NULL) {
    $CI = & get_instance();
    $data['page_title'] = lang($title);
    $data['page_folder'] = 'backend/' . $main_folder . $folder;
    $data['page_name'] = $page;
    $CI->load->view('backend/' . $main_folder . '_layout', $data);
}

function content_page_view($page, $title, $main_folder, $folder = NULL, $data = NULL) {
    $CI = & get_instance();
    $data['page_title'] = lang($title);
    $data['page_folder'] = 'backend/' . $main_folder . $folder;
    $data['page_name'] = $page;
    $CI->load->view('backend/' . $main_folder . '_layout_content', $data);
}
