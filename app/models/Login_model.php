<?php

class Login_model extends ADMIN_Model {
    /* public variable
     *   table primary key
     *   table name 
     *   validation error code
     *   validation message
     */

    public $primary_key;
    public $main_table;
    public $errorCode;
    public $errorMessage;

    public function __construct() {
        parent::__construct();
        /* table name */
        $this->main_table = "app_admin";
        /* table primary key */
        $this->primary_key = "id";
    }

    /* check login credential */

    public function admin_authenticate($email, $password) {

        /* get credential data */
        $ext = 'password = ' . $this->db->escape(md5($password)) . ' AND  email = ' . $this->db->escape($email);
        $admin_query = $this->db->select('*')->where($ext)->get($this->main_table)->result_array();
        $admin_record = array_filter($admin_query);
        /* check login credential valid or not */
        if (isset($admin_record) && !empty($admin_record) && count($admin_record) > 0) {
            if (isset($admin_record[0]["status"]) && $admin_record[0]["status"] == "A") {
                $this->session->set_userdata("AdminID", $admin_record[0]["id"]);
                $this->errorCode = 1;
            } else if (isset($admin_record[0]["status"]) && $admin_record[0]["status"] == "I") {
                $this->errorCode = 0;
                $this->errorMessage = lang('Account_Deactive');
            } else if (isset($admin_record[0]["status"]) && $admin_record[0]["status"] == "H") {
                $this->errorCode = 0;
                $this->errorMessage = lang('Account_Not_Verify');
            } else if (isset($admin_record[0]["status"]) && $admin_record[0]["status"] == "S") {
                $this->errorCode = 0;
                $this->errorMessage = lang('Account_Suspended');
            } else if (isset($admin_record[0]["status"]) && $admin_record[0]["status"] == "D") {
                $this->errorCode = 0;
                $this->errorMessage = lang('Account_Deleted');
            }
        } else {
            $this->errorCode = 0;
            $this->errorMessage = lang('Invalid_Login_Request');
        }
        $error['errorCode'] = $this->errorCode;
        $error['errorMessage'] = $this->errorMessage;
        return $error;
    }

    /* check forgot credential */

    function check_admin_email($email) {
        /* get credential data */
        $this->db->select("*");
        $this->db->from($this->main_table);
        $this->db->where('email', $email);
        $list_data = $this->db->get()->row_array();
        /* check valid or not */
        if (is_array($list_data) && count($list_data) > 0) {
            $this->errorCode = 1;
        } else {
            $this->errorCode = 0;
            $this->errorMessage = lang('Email_Not_Register');
        }
        $error['data'] = $list_data;
        $error['errorCode'] = $this->errorCode;
        $error['errorMessage'] = $this->errorMessage;
        return $error;
    }

}
