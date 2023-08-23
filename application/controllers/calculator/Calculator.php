<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Calculator extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

	}

	public function calculator_view()
	{

		$this->load->view('calculator/calculator_view');
	}

	public function calculate()
	{
		$this->form_validation->set_rules('numbers', 'Numbers', 'required');
		if ($this->form_validation->run() == False) {
			$this->load->view('calculator/calculator_view');
		} else {
			$numbers = $this->input->post('numbers');

			$numbers_array = explode("+-*/", $numbers);
			foreach ($numbers_array as $number) {
				print_r($number);
				echo "<br>";
			}

			$this->load->view('calculator/calculator_view');

		}
	}
}
