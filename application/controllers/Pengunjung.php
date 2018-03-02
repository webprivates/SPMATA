<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pengunjung extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
       // is_login();
        $this->load->model('Pengunjung_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/pengunjung/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/pengunjung/index/';
            $config['first_url'] = base_url() . 'index.php/pengunjung/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Pengunjung_model->total_rows($q);
        $pengunjung = $this->Pengunjung_model->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'pengunjung_data' => $pengunjung,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','pengunjung/tbl_pengunjung_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Pengunjung_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_pengunjung' => $row->id_pengunjung,
		'nama' => $row->nama,
		'jenkel' => $row->jenkel,
		'umur' => $row->umur,
		'alamat' => $row->alamat,
		'tanggal' => $row->tanggal,
		'email' => $row->email,
	    );
            $this->template->load('template','pengunjung/tbl_pengunjung_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pengunjung'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('pengunjung/create_action'),
	    'id_pengunjung' => set_value('id_pengunjung'),
	    'nama' => set_value('nama'),
	    'jenkel' => set_value('jenkel'),
	    'umur' => set_value('umur'),
	    'alamat' => set_value('alamat'),
	    'tanggal' => set_value('tanggal'),
	    'email' => set_value('email'),
	);
        $this->template->load('template','pengunjung/tbl_pengunjung_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'jenkel' => $this->input->post('jenkel',TRUE),
		'umur' => $this->input->post('umur',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'tanggal' => $this->input->post('tanggal',TRUE),
		'email' => $this->input->post('email',TRUE),
	    );

            $this->Pengunjung_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('pengunjung'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Pengunjung_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pengunjung/update_action'),
		'id_pengunjung' => set_value('id_pengunjung', $row->id_pengunjung),
		'nama' => set_value('nama', $row->nama),
		'jenkel' => set_value('jenkel', $row->jenkel),
		'umur' => set_value('umur', $row->umur),
		'alamat' => set_value('alamat', $row->alamat),
		'tanggal' => set_value('tanggal', $row->tanggal),
		'email' => set_value('email', $row->email),
	    );
            $this->template->load('template','pengunjung/tbl_pengunjung_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pengunjung'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_pengunjung', TRUE));
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'jenkel' => $this->input->post('jenkel',TRUE),
		'umur' => $this->input->post('umur',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'tanggal' => $this->input->post('tanggal',TRUE),
		'email' => $this->input->post('email',TRUE),
	    );

            $this->Pengunjung_model->update($this->input->post('id_pengunjung', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pengunjung'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Pengunjung_model->get_by_id($id);

        if ($row) {
            $this->Pengunjung_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pengunjung'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pengunjung'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('jenkel', 'jenkel', 'trim|required');
	$this->form_validation->set_rules('umur', 'umur', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');
	$this->form_validation->set_rules('email', 'email', 'trim|required');

	$this->form_validation->set_rules('id_pengunjung', 'id_pengunjung', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Pengunjung.php */
/* Location: ./application/controllers/Pengunjung.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-03-02 10:49:27 */
/* http://harviacode.com */