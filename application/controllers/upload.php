<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {

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
	public function __construct(){
		parent::__construct();
		$this->load->model('Model_Upload');
	}

	public function index(){
		$data['record'] = $this->Model_Upload->show();
		$this->load->view('upload', $data);
	}

	public function add(){
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100'; //in kb
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->upload->initialize($config);

		//if upload failed
		if ( ! $this->upload->do_upload('file_file')){
			echo "fail";
		}else{
			$data = array('img' => $this->upload->data('file_name'));
			$this->Model_Upload->add($data);
		}
	}

	public function delete(){
		$id = $this->uri->segment(3);
		$folder ='./uploads/';
		$img = $this->Model_Upload->get_one($id)->row_array();
		@unlink($folder.$img['img']);
		$this->Model_Upload->delete($id);
		redirect('upload');
	}

	public function update(){
		if(isset($_POST['submit'])){

			

			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '100'; //in kb
			$config['max_width']  = '1024';
			$config['max_height']  = '768';

			$this->upload->initialize($config);

			//if upload failed
			if ( ! $this->upload->do_upload('file_file')){
				echo "fail";
			}else{

				$id = $this->input->post('id_file');
				$folder ='./uploads/';
				$img = $this->Model_Upload->get_one($id)->row_array();
				@unlink($folder.$img['img']);

				$data = array('img' => $this->upload->data('file_name'));
				$this->Model_Upload->update($this->input->post('id_file'), $data);
				redirect('upload');
			}

		}else{
			$id = $this->uri->segment(3);
			$data['record'] = $this->Model_Upload->get_one($id)->row_array();		
			$this->load->view('update', $data);
		}
	}
}
