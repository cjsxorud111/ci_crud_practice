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
		$apiKey = "703f1bcdb1bcabc463952e7a";
		$baseCurrency = "KRW";
		$endpoint = "https://v6.exchangerate-api.com/v6/";

		$url = $endpoint . $apiKey . "/latest/" . $baseCurrency;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$response = curl_exec($ch);
		curl_close($ch);

		if ($response !== false) {
			$data = json_decode($response, true);
			echo $data;
		} else {
			echo "API request failed";
		}
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
