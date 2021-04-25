<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Auth extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('UserModel');
		$this->load->model('DatabaseModel');
	}

	public function index()
	{
		if ($this->session->userdata('authenticated'))
			redirect('page/dashboard');

		$this->render_login('login');
	}

	public function register_page()
	{
		if ($this->session->userdata('authenticated'))
			redirect('page/dashboard');

		$this->render_login('register');
	}

	public function register()
	{
		$first_name   = $this->input->post('first_name');
		$last_name   = $this->input->post('last_name');
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));
		$repeat_password = md5($this->input->post('repeat_password'));

		$data     = $this->UserModel->get($username);
		if (!empty($data['user'])) {
			$this->session->set_tempdata('danger', 'Username sudah ada', 1);
			redirect('auth/register_page');
		}
		if ($password !== $repeat_password) {
			$this->session->set_tempdata('danger', 'Repeat Password salah', 1);
			redirect('auth/register_page');
		}
		if (strlen($this->input->post('password')) < 5) {
			$this->session->set_tempdata('danger', 'Password harus mengandung 5 atau lebih karakter', 1);
			redirect('auth/register_page');
		}

		$data = array(
			'first_name'      => $first_name,
			'last_name'       => $last_name,
			'username'        => $username,
			'password'        => $password,
			'role'			  => 'admin',
		);

		if ($this->UserModel->registerAccount($data)) {
			$this->session->set_tempdata('success', 'Akun berhasil dibuat, Silahkan Login', 1);
			redirect('auth');
		} else {
			$this->session->set_tempdata('success', 'Akun gagal dibuat, Silahkan Coba Beberapa Saat Lagi', 1);
			redirect('auth');
		}
	}

	public function login()
	{

		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));
		$data     = $this->UserModel->get($username);

		if (empty($data['user'])) {
			$this->session->set_tempdata('danger', 'Username tidak ditemukan', 1);
			redirect('auth');
		} else {
			if ($password != $data['user']->password) {
				$this->session->set_tempdata('danger', 'Password salah', 1);
				redirect('auth');
			} else {
				$session = array(
					'authenticated' => true,
					'username'      => $data['user']->username,
					'first_name'    => $data['user']->first_name,
					'last_name'     => $data['user']->last_name,
					'role'          => $data['user']->role
				);

				$this->session->set_userdata($session);

				$loginfo = array(
					'username' => $data['user']->username,
					'action' => 'LOGIN',
					'action_table' => 'AUTH',
					'action_detail' => 'Successfully Login ',
				);
				$logtable = 'activitylog';
				$this->DatabaseModel->insert_data($loginfo, $logtable);


				redirect('page/dashboard');
			}
		}
	}

	public function logout()
	{

		$loginfo = array(
			'username' => $this->session->userdata('username'),
			'action' => 'LOGOUT',
			'action_table' => 'AUTH',
			'action_detail' => 'Successfully Logout',
		);
		$logtable = 'activitylog';
		$this->DatabaseModel->insert_data($loginfo, $logtable);

		//destroy sess
		$this->session->sess_destroy();
		redirect('auth');
	}
}
