<?php

class Client_model extends ADMIN_Model {
    /* public variable
     *   table primary key
     *   table name 
     */

    public $primary_key;
    public $main_table;

    public function __construct() {
        parent::__construct();
        /* table name */
        $this->main_table = "app_client";
        /* table primary key */
        $this->primary_key = "id";
    }

    /* get client */

    function get_all_client($id = NULL) {
        $this->db->select('*');
        if (!is_null($id))
            $this->db->where('id', $id);
        $res = $this->db->get($this->main_table)->result_array();
        return $res;
    }

}
