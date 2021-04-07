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

	public function login()
	{

		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));
		$data     = $this->UserModel->get($username);

		if (empty($data['user'])) {
			$this->session->set_flashdata('message', 'Username tidak ditemukan');
			redirect('auth');
		} else {
			if ($password != $data['user']->password) {
				$this->session->set_flashdata('message', 'Password salah');
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
