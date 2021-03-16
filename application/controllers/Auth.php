<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends MY_Controller {
    public function __construct(){
        parent:: __construct();
        $this->load->model('UserModel');
    }
    public function index(){
        if($this->session->userdata('authenticated'))
            redirect('page/dashboard');

        $this->render_login('login');
    }

    public function register_page(){
        if($this->session->userdata('authenticated'))
            redirect('page/dashboard');
        
        $this->render_login('register');
    }

    public function login(){
        
        $username = $this->input->post('username');       
        $password = md5($this->input->post('password'));
        $data     = $this->UserModel->get($username);
        
        if(empty($data['user'])){
            $this->session->set_flashdata('message', 'Username tidak ditemukan');
            redirect('auth');
        }else{
            if($password != $data['user']->password){
                $this->session->set_flashdata('message', 'Password salah');
                redirect('auth');
            }else{
                $session = array(
                    'authenticated' => true,
                    'username'      => $data['user']->username,
                    'first_name'    => $data['user']->first_name,
                    'last_name'     => $data['user']->last_name,
                    'role'          => $data['user']->role
                );

                $this->session->set_userdata($session);
                redirect('page/dashboard');
            }
        }
    }

    public function register(){
        $iFName   = $this->input->post('iFName');
        $iLName   = $this->input->post('iLName');
        $iGender  = $this->input->post('iGender');
        $iBDate   = $this->input->post('iBDate');
        $username = $this->input->post('username');       
        $password = md5($this->input->post('password'));
        $confirm_password = md5($this->input->post('confirm_password'));
        
        $data     = $this->UserModel->get($username);
        if(!empty($data['user'])){
            $this->session->set_flashdata('message', 'Username sudah ada');
            redirect('auth/register_page');
        }
        if($password !== $confirm_password){
            $this->session->set_flashdata('message', 'Confirm Password salah');
            redirect('auth/register_page');
        }
        if(strlen($password) < 6){
            $this->session->set_flashdata('message', 'Password harus mengandung 6 atau lebih karakter');
            redirect('auth/register_page');
        }

        $data = array(
            'first_name'      => $iFName,
            'last_name'       => $iLName,
            'gender'          => $iGender,
            'birth_date'      => $iBDate,
            'username'        => $username,
            'password'        => $password
        );

        if($this->UserModel->registerAccount($data)){
            $this->session->set_flashdata('message', 'Akun berhasil dibuat, Silahkan Login');
            redirect('auth');
        }
        else{
            $this->session->set_flashdata('message', 'Akun gagal dibuat, Silahkan Coba Beberapa Saat Lagi');
            redirect('auth');
        }

    }

    public function logout(){
        $this->session->sess_destroy();
        redirect('auth');
    }
}
?>