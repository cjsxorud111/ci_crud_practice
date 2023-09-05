<?php

class Plan_model extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
		$this->load->helper('url');

	}

	public function calculate_cost($cost_array)
	{
		foreach ($cost_array as $cost) {

		}
	}

	public function fetch_exchange_rate()
	{
		// API 키를 변수에 저장합니다.
		$apiKey = "703f1bcdb1bcabc463952e7a";

		// 기준 통화로 KRW (한국 원화)를 설정합니다.
		$baseCurrency = "KRW";

		// exchangerate-api의 기본 URL을 변수에 저장합니다.
		$endpoint = "https://v6.exchangerate-api.com/v6/";

		// 위에서 정의한 변수들을 사용하여 완전한 API 요청 URL을 생성합니다.
		$url = $endpoint . $apiKey . "/latest/" . $baseCurrency;

		// cURL 세션을 초기화합니다.
		$ch = curl_init();

		// 요청 URL을 설정합니다.
		curl_setopt($ch, CURLOPT_URL, $url);

		// SSL 검증을 건너뛰기 위한 설정 (보안 상 권장되지 않음)
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

		// cURL 세션을 실행합니다.
		if (!curl_exec($ch)) {
			// API 요청이 실패한 경우 에러 메시지를 출력합니다.
			echo "API request failed: " . curl_error($ch);
		}

		// cURL 세션을 종료합니다.
		curl_close($ch);
	}









	public function store()
	{
		$start_times = $this->input->post('start_time');
		$end_times = $this->input->post('end_time');
		$destination_names = $this->input->post('destination_name');
		$travel_costs = $this->input->post('travel_cost');
		$currency = $this->input->post('currency');

		// $datas 배열에 데이터를 담기 위한 루프
		$datas = array();
		$current_date = date('Y-m-d'); // 오늘 날짜를 가져옴

		for ($i = 0; $i < count($start_times); $i++) {
			$start_time = new DateTime($current_date . ' ' . $start_times[$i]);
			$end_time = new DateTime($current_date . ' ' . $end_times[$i]);

			$data = array(
				'start_time' => $start_time->format('H:i:s'),
				'end_time' => $end_time->format('H:i:s'),
				'destination_name' => $destination_names[$i],
				'travel_cost' => $travel_costs[$i]
			);
			$datas[] = $data;
		}

		// $datas를 DB에 저장
		$result = $this->db->insert_batch('travel_plans', $datas);

		$this->fetch_exchange_rate();

		return array(
			'datas' => $datas,
			'total_travel_cost' => array_sum($travel_costs)
		);
	}

	public function getAll($type = "all", $limit = 3, $page = 1)
	{

		if ($type == "count") {
			$board = $this->db->get('boards')->num_rows();
		} else {
			$this->db->limit($limit, $page);
			$this->db->order_by('idx', 'desc');
			$board = $this->db->get('boards')->result();
		}

		return $board;
	}

	public function get($idx)
	{
		$board = $this->db->get_where('boards', ['idx' => $idx])->row();
		return $board;
	}

	public function update($idx)
	{
		$data = [
			'title' => $this->input->post('title'),
			'contents' => $this->input->post('contents')
		];

		$result = $this->db->where('idx', $idx)->update('boards', $data);
		return $result;
	}

	public function delete($idx)
	{
		$result = $this->db->delete("boards", array('idx' => $idx));
		return $result;
	}

}
