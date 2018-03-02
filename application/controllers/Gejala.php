<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gejala extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //is_login();
        $this->load->model('Gejala_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/gejala/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/gejala/index/';
            $config['first_url'] = base_url() . 'index.php/gejala/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Gejala_model->total_rows($q);
        $gejala = $this->Gejala_model->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'gejala_data' => $gejala,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','gejala/tbl_gejala_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Gejala_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_gejala' => $row->id_gejala,
		'kd_gejala' => $row->kd_gejala,
		'nm_gejala' => $row->nm_gejala,
	    );
            $this->template->load('template','gejala/tbl_gejala_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('gejala'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('gejala/create_action'),
	    'id_gejala' => set_value('id_gejala'),
	    'kd_gejala' => set_value('kd_gejala'),
	    'nm_gejala' => set_value('nm_gejala'),
	);
        $this->template->load('template','gejala/tbl_gejala_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kd_gejala' => $this->input->post('kd_gejala',TRUE),
		'nm_gejala' => $this->input->post('nm_gejala',TRUE),
	    );

            $this->Gejala_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('gejala'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Gejala_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('gejala/update_action'),
		'id_gejala' => set_value('id_gejala', $row->id_gejala),
		'kd_gejala' => set_value('kd_gejala', $row->kd_gejala),
		'nm_gejala' => set_value('nm_gejala', $row->nm_gejala),
	    );
            $this->template->load('template','gejala/tbl_gejala_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('gejala'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_gejala', TRUE));
        } else {
            $data = array(
		'kd_gejala' => $this->input->post('kd_gejala',TRUE),
		'nm_gejala' => $this->input->post('nm_gejala',TRUE),
	    );

            $this->Gejala_model->update($this->input->post('id_gejala', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('gejala'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Gejala_model->get_by_id($id);

        if ($row) {
            $this->Gejala_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('gejala'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('gejala'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kd_gejala', 'kd gejala', 'trim|required');
	$this->form_validation->set_rules('nm_gejala', 'nm gejala', 'trim|required');

	$this->form_validation->set_rules('id_gejala', 'id_gejala', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Gejala.php */
/* Location: ./application/controllers/Gejala.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-03-02 09:46:56 */
/* http://harviacode.com */