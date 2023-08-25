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

		// $datas 배열을 활용하여 원하는 처리 수행

		// 예를 들어, 데이터를 모델을 통해 데이터베이스에 저장하려면:
		$this->Plan_model->store();

		// 다음으로 이동하거나 결과를 표시하는 등의 작업 수행

		// 예산계산 페이지로 리디렉션하거나 다른 작업 수행
		// redirect('다음_페이지_주소');
	}

}
