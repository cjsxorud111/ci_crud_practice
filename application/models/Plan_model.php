<?php

class Plan_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
		$this->load->helper('url');
		include_once APPPATH . '../vendor/simplehtmldom/simplehtmldom/simple_html_dom.php';


	}

	public function scrape() {
		set_time_limit(0);

		$countries = array(
			'g294196' => 'South_Korea',
			'g294232' => 'Japan'
			// ... 다른 국가들 추가
		);

		foreach ($countries as $code => $country_name) {
			$offset = 10590;

			while (true) {
				$url = "https://www.tripadvisor.co.kr/Attractions-{$code}-Activities-oa{$offset}-{$country_name}.html";

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537');

				$result = curl_exec($ch);

				$html = str_get_html($result);

				// "검색 결과 전체" 문자열을 포함하는 div를 찾습니다.
				$searchDiv = null;
				foreach ($html->find('div') as $div) {
					if (strpos($div->plaintext, '검색 결과 전체') !== false) {
						$searchDiv = $div;
						break;
					}
				}

				if ($searchDiv) {
					$text = $searchDiv->plaintext;
					preg_match("/([\d,]+) 중 ([\d,]+)-([\d,]+)/", $text, $matches);

					if (isset($matches[1]) && isset($matches[3])) {
						$startNum = (int) str_replace(",", "", $matches[1]);
						$lastNum = (int) str_replace(",", "", $matches[3]);

						if ($lastNum >= $startNum - 100) {
							break;
						}
					}
				}

				$attractions = $html->find('div.XfVdV.o.AIbhI');

				foreach ($attractions as $element) {
					$attraction_name = trim($element->plaintext);

					$data = array(
						'country_name' => $country_name,
						'attraction_name' => $attraction_name
					);
					echo "<pre>";
					print_r($data);
					echo "</pre>";

					// Insert into database, e.g., $this->db->insert('your_table_name', $data);
					$this->db->insert('attractions', $data);
				}

				$offset += 30;
			}
		}
	}






	public function searchCityNames($keyword) {


		$xml = simplexml_load_file(APPPATH . '/models/cities.xml'); // XML 파일 경로 지정


		$matchingCities = [];

		foreach ($xml->city as $city) {
			if (strpos(strtolower($city->name), strtolco,ower($keyword)) !== false) {
				$matchingCities[] = (string)$city->name;
			}
		}

		sort($matchingCities); // 정렬
		return $matchingCities;
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

		// cURL이 반환한 결과를 변수에 저장하도록 설정
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		// cURL 세션을 실행하고 결과를 $response 변수에 저장합니다.
		$response = curl_exec($ch);

		// cURL 세션을 종료합니다.
		curl_close($ch);

		if ($response === false) {
			// API 요청이 실패한 경우 에러 메시지를 출력합니다.
			echo "API request failed: " . curl_error($ch);
			return;
		}

		// API 응답을 JSON으로 파싱합니다.
		$responseData = json_decode($response, true);

		// "conversion_rates" 데이터를 반환합니다.
		return $responseData['conversion_rates'];
	}


	public function update_exchange_rate()
	{
		// 1. 마지막 업데이트 날짜 조회
		$query = $this->db->select('update_date')
			->from('exchange_rates')
			->limit(1)
			->get();
		$lastUpdate = $query->row()->update_date;

		$today = date('Y-m-d');


		// 오늘 날짜와 마지막 업데이트 날짜가 같으면 함수 종료
		if ($lastUpdate == $today) {
			return;
		}

		$conversion_rates = $this->fetch_exchange_rate();

		if (!$conversion_rates) {
			return;
		}

		// (환율 정보 업데이트 로직)
		foreach ($conversion_rates as $currency => $rate) {
			$data = array(
				'currency_code' => $currency,
				'exchange_rate' => $rate,
				'update_date' => $today
			);

			$this->db->where('currency_code', $currency)->update('exchange_rates', $data);
		}

	}



	public function store()
	{
		$start_times = $this->input->post('start_time');
		$end_times = $this->input->post('end_time');
		$destination_names = $this->input->post('destination_name');
		$travel_costs = $this->input->post('travel_cost');
		$currency_code = $this->input->post('currency');

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
		$this->db->insert_batch('travel_plans', $datas);

		$this->update_exchange_rate();

		return array(
			'datas' => $datas,
			'total_travel_cost' => $this->convert_to_krw_sum($travel_costs, $currency_code)
		);
	}


	public function convert_to_krw_sum($travel_costs, $currency_code) {
		$total_krw = 0; // KRW로 변환된 금액의 총합을 저장할 변수

		// 각 currency_code별로 travel_costs의 값을 KRW로 변환하고 합산합니다.
		for ($i = 0; $i < count($travel_costs); $i++) {
			// $travel_costs의 값을 실수로 변환합니다.
			$cost = floatval($travel_costs[$i]);

			if ($currency_code[$i] !== 'KRW') {
				$total_krw += $this->convert_to_krw($cost, $currency_code[$i]);
			} else {
				$total_krw += $cost;
			}
		}

		return $total_krw; // KRW로 변환된 금액의 총합을 반환합니다.
	}

	public function convert_to_krw($amount, $currency_code) {
		// 국가코드를 기준으로 exchange_rates 테이블에서 환율을 조회
		$this->db->select('exchange_rate');
		$this->db->from('exchange_rates');
		$this->db->where('currency_code', $currency_code);
		$query = $this->db->get();

		// 결과가 없으면 null을 반환
		if ($query->num_rows() == 0) {
			return null;
		}

		// 환율을 가져옵니다.
		$exchange_rate = $query->row()->exchange_rate;

		// 입력받은 금액에 환율을 곱하여 KRW로 변환
		$converted_amount = $amount * (1 / $exchange_rate);

		return $converted_amount;
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
