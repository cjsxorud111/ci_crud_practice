<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Plan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Plan_model');
	}

	public function main()
	{
		$this->load->view('trip_plan/plan_main');
	}

	public function store() {

		$result = $this->Plan_model->store();

		$this->load->view('trip_plan/schedule', $result);
	}

}
