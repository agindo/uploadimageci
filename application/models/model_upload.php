<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Upload extends CI_Model {

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
	public function show(){
		return $this->db->get('upload');
	}

	public function add($data){
		$this->db->insert('upload', $data);
	}

	public function get_one($id){
		$this->db->where('id', $id);
		return $this->db->get('upload');
	}

	public function delete($id){
		$this->db->where('id', $id);
		$this->db->delete('upload');
	}

	public function update($id, $data){
		$this->db->where('id', $id);
		$this->db->update('upload', $data);
	}
}
