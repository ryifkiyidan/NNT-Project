<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Controller extends CI_Controller{
    public function __construct(){
    parent:: __construct();
        $this->authenticated(); 
    }
    public function authenticated(){ 
        if($this->uri->segment(1) != 'auth' && $this->uri->segment(1) != ''){
            if( ! $this->session->userdata('authenticated')) 
                redirect('auth'); 
        }
    }
    public function render_login($content, $data = NULL){
        $data['contentnya'] = $this->load->view($content, $data, TRUE);
        $this->load->view('template/login/index', $data);
    }
    public function render_backend($content, $data = NULL){
        $data['sidebarnya'] = $this->load->view('template/backend/sidebar', $data, TRUE);
        $data['topbarnya'] = $this->load->view('template/backend/topbar', $data, TRUE);
        $data['contentnya'] = $this->load->view($content, $data, TRUE);
        $this->load->view('template/backend/index', $data);
    }
}
?>