<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Yayasan extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('response_helper');
		$this->load->model('Yayasan_model');
		
	}
	
	public function get_data(){
		
		if(empty($_POST['id'])){
            echo json_encode(response_error(203, "Maaf, id diperlukan untuk melakukan permintaan ini"));
		}else if(count($this->Yayasan_model->select_all($_POST['id'])) == 0){
			echo json_encode(response_error(203, "Maaf id yg diminta tidak ada"));
		}else{
			$result = $this->Yayasan_model->select_all($_POST['id']);
			$message = "Data tersedia";
			echo json_encode(response_success($message, $result));
		}
		
	}
	public function update_data(){
		
		$this->Yayasan_model->record = [
					"id" => $_POST['id'],
                    "nama_yayasan" => $_POST["nama_yysn"],
					"lokasi" => $_POST["lokasi"],
                    "kegiatan" => $_POST["keg"]
                ];
		
		foreach($this->Yayasan_model->record as $key => $value){		
		if(empty($value)){
			unset($this->Yayasan_model->record[$key]);
		}
		}
		$result = $this->Yayasan_model->update_data($_POST['id']);
		if($result){
					$message = "Data telah diupdate";
                    echo json_encode(response_success($message, $this->Yayasan_model->record));
                } else {
                    echo json_encode(response_error(203, "Maaf, update data tidak berhasil"));
                }
		
	}
}