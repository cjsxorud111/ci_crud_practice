<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Plan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

	}

	public function main()
	{
		$this->load->view('trip_plan/plan_main');
	}

}
