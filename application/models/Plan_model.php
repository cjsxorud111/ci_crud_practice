<?php
class Plan_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
		$this->load->helper('url');

	}

	public function store()
	{
		$start_times = $this->input->post('start_time');
		$end_times = $this->input->post('end_time');
		$plans = $this->input->post('plan');
		$prices = $this->input->post('price');

		// $datas 배열에 데이터를 담기 위한 루프
		$datas = array();

		for ($i = 0; $i < count($start_times); $i++) {
			$data = array(
				'start_time' => $start_times[$i],
				'end_time' => $end_times[$i],
				'plan' => $plans[$i],
				'price' => $prices[$i]
			);
			$datas[] = $data;
		}
		var_dump($datas);

		/*$result = $this->db->insert('boards', $data);
		return $result;*/
	}

	public function getAll($type="all", $limit=3, $page=1)
	{

		if ($type=="count")
		{
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
