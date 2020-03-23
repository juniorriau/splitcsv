<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Data_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'data/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'data/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'data/index';
            $config['first_url'] = base_url() . 'data/index';
        }

        $config['per_page'] = 100;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Data_model->total_rows($q);
        $data = $this->Data_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'data_data' => $data,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('data/data_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Data_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'no' => $row->no,
		'date' => $row->date,
	    );
            $this->load->view('data/data_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('data/create_action'),
	    'id' => set_value('id'),
	    'no' => set_value('no'),
	    'date' => set_value('date'),
	);
        $this->load->view('data/data_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
			$file_data = $this->csvimport->get_array($_FILES["file"]["tmp_name"]);
			foreach($file_data as $row)
			{
				$data=array(
					"no"=>$row['no_hp'],
					"date"=>date("Y-m-d"),
				);
				$this->Data_model->insert($data);
			}
            redirect(site_url('data'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Data_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('data/update_action'),
		'id' => set_value('id', $row->id),
		'no' => set_value('no', $row->no),
		'date' => set_value('date', $row->date),
	    );
            $this->load->view('data/data_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'no' => $this->input->post('no',TRUE),
		'date' => $this->input->post('date',TRUE),
	    );

            $this->Data_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('data'));
        }
    }
	
	public function export()
	{
		$perpage=100;
        $rows = floor($this->Data_model->total_rows()/$perpage);
		//echo "<pre>";
		for ($i=0;$i<$rows;$i++)
		{
			$data = $this->Data_model->get_export_data($perpage, $i*$perpage);
			$path ="";
			header("Content-Description: File Transfer"); 
		    header("Content-Disposition: attachment; filename=$path"); 
		    header("Content-Type: application/csv; ");
			$this->load->dbutil();
			$this->load->helper('file');
			$this->load->helper('download');

			$delimiter = ",";
	        $newline = "\r\n";
	        $data = $this->dbutil->csv_from_result($data, $delimiter, 
$newline);
			force_download('csv_no_'.$i.'.csv', $data);
		}
		if($i==1)
			die();
	}
    
	public function empty()
	{
		$this->Data_model->truncate();
		redirect(site_url("data"));
	}
    
	public function delete($id) 
    {
        $row = $this->Data_model->get_by_id($id);

        if ($row) {
            $this->Data_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('data'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Data.php */
/* Location: ./application/controllers/Data.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-03-21 15:06:41 */
/* http://harviacode.com */