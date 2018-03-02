<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Hasil extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //is_login();
        $this->load->model('Hasil_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/hasil/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/hasil/index/';
            $config['first_url'] = base_url() . 'index.php/hasil/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Hasil_model->total_rows($q);
        $hasil = $this->Hasil_model->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'hasil_data' => $hasil,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','hasil/tbl_hasil_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Hasil_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_hasil' => $row->id_hasil,
		'id_pengunjung' => $row->id_pengunjung,
		'kd_penyakit' => $row->kd_penyakit,
		'tanggal' => $row->tanggal,
	    );
            $this->template->load('template','hasil/tbl_hasil_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('hasil'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('hasil/create_action'),
	    'id_hasil' => set_value('id_hasil'),
	    'id_pengunjung' => set_value('id_pengunjung'),
	    'kd_penyakit' => set_value('kd_penyakit'),
	    'tanggal' => set_value('tanggal'),
	);
        $this->template->load('template','hasil/tbl_hasil_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_pengunjung' => $this->input->post('id_pengunjung',TRUE),
		'kd_penyakit' => $this->input->post('kd_penyakit',TRUE),
		'tanggal' => $this->input->post('tanggal',TRUE),
	    );

            $this->Hasil_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('hasil'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Hasil_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('hasil/update_action'),
		'id_hasil' => set_value('id_hasil', $row->id_hasil),
		'id_pengunjung' => set_value('id_pengunjung', $row->id_pengunjung),
		'kd_penyakit' => set_value('kd_penyakit', $row->kd_penyakit),
		'tanggal' => set_value('tanggal', $row->tanggal),
	    );
            $this->template->load('template','hasil/tbl_hasil_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('hasil'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_hasil', TRUE));
        } else {
            $data = array(
		'id_pengunjung' => $this->input->post('id_pengunjung',TRUE),
		'kd_penyakit' => $this->input->post('kd_penyakit',TRUE),
		'tanggal' => $this->input->post('tanggal',TRUE),
	    );

            $this->Hasil_model->update($this->input->post('id_hasil', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('hasil'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Hasil_model->get_by_id($id);

        if ($row) {
            $this->Hasil_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('hasil'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('hasil'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_pengunjung', 'id pengunjung', 'trim|required');
	$this->form_validation->set_rules('kd_penyakit', 'kd penyakit', 'trim|required');
	$this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');

	$this->form_validation->set_rules('id_hasil', 'id_hasil', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Hasil.php */
/* Location: ./application/controllers/Hasil.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-03-02 10:39:38 */
/* http://harviacode.com */