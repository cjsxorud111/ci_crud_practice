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

	public function scrape() {
		$this->Plan_model->scrape();
	}

	public function search_ajax() {
		if ($this->input->is_ajax_request()) {
			$keyword = $this->input->get('keyword');
			$results = $this->Plan_model->searchCityNames($keyword);

			$output = '';
			foreach($results as $result) {
				$output .= "<div class='suggestion-item'>" . $result . "</div>"; // 클래스를 추가하여 스타일을 적용할 수 있습니다.
			}
			echo $output;
		}
	}

	public function sign_on() {
		// HTTP 요청에서 JSON 데이터 읽기
		$json = $this->request->getJSON();
		if (!$json) {
			return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid data'])->setStatusCode(400);
		}

		// 비밀번호를 해시화하여 저장
		$data = [
			'username' => $json->username,
			'password' => password_hash($json->password, PASSWORD_BCRYPT)
		];

		// 데이터 저장
		if ($this->Plan_model->saveUser($data)) {
			return $this->response->setJSON(['status' => 'success'])->setStatusCode(200);
		} else {
			return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to save user'])->setStatusCode(500);
		}
	}
}


