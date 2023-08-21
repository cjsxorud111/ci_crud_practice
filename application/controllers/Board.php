<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Board extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');

        $this->load->model('Board_model', 'board');
    }

    public function index()
    {
		$this->load->library('pagination');

		$config['base_url'] = '/board/';
		$config['total_rows'] = $this->board->getAll('count', 0, 0);
		$config['per_page'] = 3;
		$config['uri_segment'] = 2;

		$this->pagination->initialize($config);

		$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

		$data['pages'] = $this->pagination->create_links();

		$data['list'] = $this->board->getAll('all', $config['per_page'], $page);

        $this->load->view('board/list', $data);
    }

    public function create()
    {
        $this->load->view('board/create');
    }

    public function store()
    {
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('contents', 'Contents', 'required');


        /*$this->form_validation->run();
        $this->board->store();
        redirect('/board/create');*/

        if ($this->form_validation->run()) {
            $this->board->store();
            redirect('/board');
        } else {
            echo "Error";
        }
    }

    public function show($idx)
    {
        $data['view'] = $this->board->get($idx);
        $this->load->view('board/show', $data);
    }

	public function edit($idx)
	{
		$data['edit'] = $this->board->get($idx);
		$this->load->view('board/edit', $data);
	}

	public function update($idx)
	{
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('contents', 'Contents', 'required');

		if ($this->form_validation->run()) {
			$this->board->update($idx);
			redirect('/board');
		} else {
			echo "Error";
		}
	}
	public function delete($idx)
	{
		$item = $this->board->delete($idx);
		redirect("/board");
	}
}
