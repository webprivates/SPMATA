<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Penyakit extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //is_login();
        $this->load->model('Penyakit_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/penyakit/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/penyakit/index/';
            $config['first_url'] = base_url() . 'index.php/penyakit/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Penyakit_model->total_rows($q);
        $penyakit = $this->Penyakit_model->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'penyakit_data' => $penyakit,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','penyakit/tbl_penyakit_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Penyakit_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_penyakit' => $row->id_penyakit,
		'kd_penyakit' => $row->kd_penyakit,
		'nm_penyakit' => $row->nm_penyakit,
		'definisi' => $row->definisi,
		'solusi' => $row->solusi,
		'foto' => $row->foto,
	    );
            $this->template->load('template','penyakit/tbl_penyakit_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('penyakit'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('penyakit/create_action'),
	    'id_penyakit' => set_value('id_penyakit'),
	    'kd_penyakit' => set_value('kd_penyakit'),
	    'nm_penyakit' => set_value('nm_penyakit'),
	    'definisi' => set_value('definisi'),
	    'solusi' => set_value('solusi'),
	    'foto' => set_value('foto'),
	);
        $this->template->load('template','penyakit/tbl_penyakit_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kd_penyakit' => $this->input->post('kd_penyakit',TRUE),
		'nm_penyakit' => $this->input->post('nm_penyakit',TRUE),
		'definisi' => $this->input->post('definisi',TRUE),
		'solusi' => $this->input->post('solusi',TRUE),
		'foto' => $this->input->post('foto',TRUE),
	    );

            $this->Penyakit_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('penyakit'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Penyakit_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('penyakit/update_action'),
		'id_penyakit' => set_value('id_penyakit', $row->id_penyakit),
		'kd_penyakit' => set_value('kd_penyakit', $row->kd_penyakit),
		'nm_penyakit' => set_value('nm_penyakit', $row->nm_penyakit),
		'definisi' => set_value('definisi', $row->definisi),
		'solusi' => set_value('solusi', $row->solusi),
		'foto' => set_value('foto', $row->foto),
	    );
            $this->template->load('template','penyakit/tbl_penyakit_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('penyakit'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_penyakit', TRUE));
        } else {
            $data = array(
		'kd_penyakit' => $this->input->post('kd_penyakit',TRUE),
		'nm_penyakit' => $this->input->post('nm_penyakit',TRUE),
		'definisi' => $this->input->post('definisi',TRUE),
		'solusi' => $this->input->post('solusi',TRUE),
		'foto' => $this->input->post('foto',TRUE),
	    );

            $this->Penyakit_model->update($this->input->post('id_penyakit', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('penyakit'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Penyakit_model->get_by_id($id);

        if ($row) {
            $this->Penyakit_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('penyakit'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('penyakit'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kd_penyakit', 'kd penyakit', 'trim|required');
	$this->form_validation->set_rules('nm_penyakit', 'nm penyakit', 'trim|required');
	$this->form_validation->set_rules('definisi', 'definisi', 'trim|required');
	$this->form_validation->set_rules('solusi', 'solusi', 'trim|required');
	$this->form_validation->set_rules('foto', 'foto', 'trim|required');

	$this->form_validation->set_rules('id_penyakit', 'id_penyakit', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Penyakit.php */
/* Location: ./application/controllers/Penyakit.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-03-02 10:23:00 */
/* http://harviacode.com */