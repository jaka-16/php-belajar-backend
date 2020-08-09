<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Yayasan_model extends CI_Model {

    private $table_name = "profile_yys";

    public $record = [];

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function select_all($user_id){
        $this->db->select('*');
        $query = $this->db->get_where($this->table_name, array('id' => $user_id));
        return $query->result();
    }
	public function update_data($user_id){
		//$data['update_at'] = date("Y-m-d h-i-s");
		$this->db->update($this->table_name, $this->record, array('id' => $user_id));
        if($this->db->affected_rows() > 0){
            return true;
        } else {
            return false;
        }
		
	}
	
}