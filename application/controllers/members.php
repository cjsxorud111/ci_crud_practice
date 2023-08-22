<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Members extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library(['form_validation', 'session']);
		$this->load->database();
	}

	public function join()
	{
		$this->load->view('login/join');
	}

	public function store()
	{
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == False) {
			$this->load->view('login/join');
		} else {
			$email = $this->input->post('email');
			$password = $this->input->post('password');

			$data = array(
				'email' => $email,
				'password' => hash('sha256', $password)
			);

			$this->db->insert('members', $data);

			$sess_data = array( 'email' => $email);

			$this->session->set_userdata($sess_data);

			redirect('members/list');
		}
	}

	public function list()
	{
		$this->load->view('login/list');
	}
}
