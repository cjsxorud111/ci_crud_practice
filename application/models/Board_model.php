<?php
class Board_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
		$this->load->helper('url');

    }

	public function store()
	{
		$data = [
			'title' => $this->input->post('title'),
			'contents' => $this->input->post('contents'),
			'regdate' => date("Y-m-d H:i:s")
		];

		$result = $this->db->insert('boards', $data);
		return $result;
    }

	public function getAll()
	{
		$board = $this->db->get('boards')->result();

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

}
