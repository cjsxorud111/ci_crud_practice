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
			/*'g294196' => array('South_Korea', '대한민국'),
			'g294232' => array('Japan', '일본'),
			'g294211' => array('China', '중국'),*/
			'g191' => array('United_States', '미국'),
			'g294220' => array('Australia', '호주'),
			'g294280' => array('India', '인도'),
			'g294260' => array('France', '프랑스'),
			'g294265' => array('Canada', '캐나다'),
			'g294217' => array('UK', '영국'),
			'g294243' => array('Germany', '독일'),
			'g294253' => array('Italy', '이탈리아'),
			'g294276' => array('Spain', '스페인'),
			'g294268' => array('Russia', '러시아'),
			'g294245' => array('Brazil', '브라질'),
			'g294251' => array('Mexico', '멕시코'),
			'g294278' => array('Singapore', '싱가포르'),
			'g294254' => array('Malaysia', '말레이시아'),
			'g294262' => array('Indonesia', '인도네시아'),
			'g294266' => array('Thailand', '태국'),
			'g294263' => array('Vietnam', '베트남'),
			'g294259' => array('Philippines', '필리핀'),
			'g294269' => array('New_Zealand', '뉴질랜드'),
			'g294255' => array('Netherlands', '네덜란드'),
			'g294242' => array('Belgium', '벨기에'),
			'g294241' => array('Switzerland', '스위스'),
			'g294279' => array('Sweden', '스웨덴'),
			'g294277' => array('Norway', '노르웨이'),
			'g294250' => array('Denmark', '덴마크'),
			'g294223' => array('Poland', '폴란드'),
			'g294246' => array('Austria', '오스트리아'),
			'g294221' => array('Hungary', '헝가리'),
			'g294239' => array('Czech_Republic', '체코'),
			'g294257' => array('Greece', '그리스'),
			'g294234' => array('Portugal', '포르투갈'),
			'g294247' => array('Finland', '핀란드'),
			'g294235' => array('Ireland', '아일랜드'),
			'g294227' => array('UAE', '아랍에미리트'),
			'g294273' => array('Saudi_Arabia', '사우디아라비아'),
			'g294218' => array('South_Africa', '남아프리카'),
			'g294224' => array('Egypt', '이집트'),
			'g294222' => array('Turkey', '터키'),
			'g294238' => array('Israel', '이스라엘'),
			'g294258' => array('Argentina', '아르헨티나'),
			'g294256' => array('Chile', '칠레'),
			'g294228' => array('Colombia', '콜롬비아'),
			'g294275' => array('Peru', '페루'),
			'g294240' => array('Venezuela', '베네수엘라'),
			'g294272' => array('Ecuador', '에콰도르'),
			'g294274' => array('Bolivia', '볼리비아'),
			'g294233' => array('Costa_Rica', '코스타리카'),
			'g294249' => array('Guatemala', '과테말라'),
			'g294229' => array('Honduras', '온두라스'),
			'g294230' => array('El_Salvador', '엘살바도르'),
			'g294219' => array('Nicaragua', '니카라과'),
			'g294226' => array('Panama', '파나마'),
			'g294248' => array('Uruguay', '우루과이'),
			'g294231' => array('Paraguay', '파라과이'),
			'g294244' => array('Jamaica', '자메이카'),
			'g294237' => array('Trinidad_and_Tobago', '트리니다드 토바고'),
			'g294271' => array('Barbados', '바베이도스'),
			'g294267' => array('Grenada', '그레나다'),
			'g294264' => array('Saint_Lucia', '세인트루시아'),
			'g294261' => array('Dominican_Republic', '도미니카공화국'),
			'g294225' => array('Haiti', '아이티'),
			'g294270' => array('Belize', '벨리즈'),
			'g294252' => array('Guyana', '가이아나'),
			'g294236' => array('Suriname', '수리남'),
			'g294213' => array('Fiji', '피지'),
			'g294215' => array('Papua_New_Guinea', '파푸아뉴기니'),
			'g294214' => array('Vanuatu', '바누아투'),
			'g294210' => array('Solomon_Islands', '솔로몬 제도'),
			'g294209' => array('Samoa', '사모아'),
			'g294207' => array('Kiribati', '키리바시'),
			'g294205' => array('Tonga', '통가'),
			'g294204' => array('Micronesia', '미크로네시아'),
			'g294203' => array('Palau', '팔라우'),
			'g294202' => array('Marshall_Islands', '마셜 제도'),
			'g294200' => array('Nauru', '나우루'),
			'g294198' => array('Tuvalu', '투발루'),
			'g294197' => array('Mauritius', '모리셔스'),
			'g294195' => array('Seychelles', '세이셸'),
			'g294194' => array('Maldives', '몰디브'),
			'g294193' => array('Brunei', '브루나이'),
			'g294192' => array('Bahrain', '바레인'),
			'g294190' => array('Qatar', '카타르'),
			'g294189' => array('Oman', '오만'),
			'g294188' => array('Kuwait', '쿠웨이트'),
			'g294187' => array('Lebanon', '레바논'),
			'g294186' => array('Jordan', '요르단')
		);


		foreach ($countries as $code => $country_info) {
			$offset = 30;
			$countryExistsInHTML = false;

			$url = "https://www.tripadvisor.co.kr/Attractions-{$code}-Activities-{$country_info[0]}.html";

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537');

			$result = curl_exec($ch);
			$html = str_get_html($result);

			if (!$html) {
				echo "Failed to parse HTML.";
				break;
			}

			// h1 태그 내부에서 국가명을 찾습니다.
			$h1Tag = $html->find('h1', 0);

			if ($h1Tag) {
				if (strpos($h1Tag->plaintext, $country_info[0]) !== false || strpos($h1Tag->plaintext, $country_info[1]) !== false) {
					$countryExistsInHTML = true;
				}
			}

			if (!$countryExistsInHTML) {
				$data = array(
					'country_name_en' => $country_info[0],
					'country_name_kr' => $country_info[1],
					'attraction_name' => 'notmatched'
				);

				// Insert into database
				$this->db->insert('attractions', $data);
				continue;  // 다음 국가로 이동합니다.
			}

			while (true) {
				$url = "https://www.tripadvisor.co.kr/Attractions-{$code}-Activities-oa{$offset}-{$country_info[0]}.html";

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537');

				$result = curl_exec($ch);

				$html = str_get_html($result);

				if (!$html) {
					echo "Failed to parse HTML.";
					break;
				}

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

					// 숫자로 시작하고 '.' 또는 공백에 도달할 때까지의 문자열 추출
					preg_match('/^(\d+)[\.\s]/', $attraction_name, $matches);
					$attraction_number = isset($matches[1]) ? $matches[1] : null;  // 숫자가 있다면 추출, 없으면 null
					$attraction_name = preg_replace("/[0-9\.]/", "", $attraction_name);

					$data = array(
						'country_name_en' => $country_info[0],  // English Name
						'country_name_kr' => $country_info[1],  // Korean Name
						'attraction_number' => $attraction_number,
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



	//gpt로 테스트하고싶어



	public function searchCityNames($keyword) {

		$this->db->select('attraction_name'); // 검색하려는 컬럼 선택
		$this->db->like('attraction_name', $keyword, 'after'); // $keyword로 시작하는 도시 이름 검색
		$this->db->limit(5); // 결과를 5개로 제한
		$query = $this->db->get('attractions'); // attractions 테이블에서 검색

		$matchingCities = [];
		foreach ($query->result() as $row) {
			$matchingCities[] = $row->attraction_name;
		}

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
