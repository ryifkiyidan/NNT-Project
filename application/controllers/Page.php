<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Page extends MY_Controller
{

	public function dashboard()
	{
		$data['curr_page'] = 'dashboard';

		$this->load->library('grocery_CRUD');
		$crud = new grocery_CRUD();
		$crud->set_table('company');
		$crud->set_theme('tablestrap4');
		$output = $crud->render();
		$data['crud'] = get_object_vars($output);

		$this->render_backend('dashboard', $data);
	}

	public function company()
	{
		$data['curr_page'] = 'company';

		$this->load->library('grocery_CRUD');
		$crud = new grocery_CRUD();
		$crud->set_theme('tablestrap4');

		$this->curr_table = 'company';
		$crud->set_table('company');
		$crud->set_subject('Company');

		// Rules
		$crud->unique_fields('ID');
		$crud->required_fields(array('ID', 'Name', 'Location', 'Phone_Number'));

		// Callbacks
		$this->crud_state = $crud->getState();
		$crud->callback_add_field('ID', array($this, '_get_auto_generate_id'));
		$crud->callback_edit_field('ID', array($this, '_get_auto_generate_id'));

		$output = $crud->render();
		$data['crud'] = get_object_vars($output);

		$this->render_backend('crud_view', $data);
	}

	public function cusreqsize()
	{
		$data['curr_page'] = 'cusreqsize';

		$this->load->library('grocery_CRUD');
		$crud = new grocery_CRUD();
		$crud->set_theme('tablestrap4');

		$this->curr_table = 'cusreqsize';
		$crud->set_table('cusreqsize');
		$crud->set_subject('Custom Size');

		$crud->display_as('ID_Company', 'Company Name');

		$crud->set_relation('ID_Company', 'company', 'Name');

		$crud->columns('ID', 'ID_Company', 'Name', 'Gender');

		// Rules
		$crud->unique_fields('ID');
		$crud->required_fields(array('ID', 'ID_Company', 'Name', 'Gender'));

		// Callbacks
		$this->crud_state = $crud->getState();
		$crud->callback_add_field('ID', array($this, '_get_auto_generate_id'));
		$crud->callback_edit_field('ID', array($this, '_get_auto_generate_id'));

		$output = $crud->render();
		$data['crud'] = get_object_vars($output);

		$this->render_backend('crud_view', $data);
	}

	public function fabric()
	{
		$data['curr_page'] = 'fabric';

		$this->load->library('grocery_CRUD');
		$crud = new grocery_CRUD();
		$crud->set_theme('tablestrap4');

		$this->curr_table = 'fabric';
		$crud->set_table('fabric');
		$crud->set_subject('Fabric');

		// Rules
		$crud->required_fields(array('ID', 'Name', 'Price'));

		// Callbacks
		$crud->unique_fields('ID');
		$this->crud_state = $crud->getState();
		$crud->callback_add_field('ID', array($this, '_get_auto_generate_id'));
		$crud->callback_edit_field('ID', array($this, '_get_auto_generate_id'));

		$output = $crud->render();
		$data['crud'] = get_object_vars($output);

		$this->render_backend('crud_view', $data);
	}

	public function product()
	{
		$data['curr_page'] = 'product';

		$this->load->library('grocery_CRUD');
		$crud = new grocery_CRUD();
		$crud->set_theme('tablestrap4');

		$this->curr_table = 'product';
		$crud->set_table('product');
		$crud->set_subject('Product');

		$crud->display_as('ID_Company', 'Company Name');
		$crud->display_as('ID_Fabric', 'Fabric Name');

		$crud->set_relation('ID_Company', 'company', 'name');
		$crud->set_relation('ID_Fabric', 'fabric', 'name');

		// Rules
		$crud->unique_fields('ID');
		$crud->required_fields(array('ID', 'ID_Company', 'ID_Fabric', 'Name', 'Price'));

		// Callbacks
		$this->crud_state = $crud->getState();
		$crud->callback_add_field('ID', array($this, '_get_auto_generate_id'));
		$crud->callback_edit_field('ID', array($this, '_get_auto_generate_id'));

		$output = $crud->render();
		$data['crud'] = get_object_vars($output);

		$this->render_backend('crud_view', $data);
	}

	public function purchaseorder()
	{
		$data['curr_page'] = 'purchaseorder';

		$this->load->library('grocery_CRUD');
		$crud = new grocery_CRUD();
		$crud->set_theme('tablestrap4');

		$state = $crud->getState();
		$stateInfo = $crud->getStateInfo();

		if ($state === 'read') {
			redirect('page/detail_po/' . $stateInfo->primary_key);
		}

		$this->curr_table = 'purchaseorder';
		$crud->set_table('purchaseorder');
		$crud->set_subject('Purchase Order');

		$crud->set_relation('ID_Company', 'company', 'Name');

		$crud->display_as('ID_Company', 'Company Name');

		// Rules
		$crud->unique_fields('PO_Number');
		$crud->required_fields(array('PO_Number', 'ID_Company', 'Date', 'Delivered_Schedule'));

		$output = $crud->render();
		$data['crud'] = get_object_vars($output);

		$this->render_backend('crud_view', $data);
	}

	public function detail_po($id)
	{
		$data['curr_page'] = 'purchaseorder';

		$this->load->model('DatabaseModel');

		$this->load->library('grocery_CRUD');
		$crud = new grocery_CRUD();
		$crud->set_theme('tablestrap4');

		$this->curr_table = 'orderdetail';
		$crud->set_table('orderdetail');
		$crud->set_subject('Order Detail');

		$crud->display_as('ID_Product', 'Product Name');

		$crud->set_relation('ID_Product', 'product', 'Name');

		$crud->columns('ID', 'ID_Product', 'Qty_Order', 'Size');

		$crud->where('PO_Number', $id);

		$crud->unset_fields('Qty_Sent');

		// Rules
		$crud->unique_fields('ID');
		$crud->required_fields(array('ID', 'ID_Product', 'PO_Number', 'Qty_Order', 'Size'));

		// Callbacks
		$this->crud_state = $crud->getState();
		$crud->callback_add_field('ID', array($this, '_get_auto_generate_id'));
		$crud->callback_edit_field('ID', array($this, '_get_auto_generate_id'));
		$this->po_number = $id;
		$crud->callback_add_field('PO_Number', function () {
			return '<input id="field-PO_Number" class="form-control" name="PO_Number" type="text" value="' . $this->po_number . '" maxlength="6" readonly>';
		});
		$crud->callback_edit_field('PO_Number', function () {
			return '<input id="field-PO_Number" class="form-control" name="PO_Number" type="text" value="' . $this->po_number . '" maxlength="6" readonly>';
		});

		$output = $crud->render();
		$data['crud'] = get_object_vars($output);
		$data['extra'] = get_object_vars($this->DatabaseModel->getPO($id));
		$data['table'] = 'Purchase Order';
		$data['state'] = $crud->getState();

		$this->render_backend('crud_view', $data);
	}

	public function deliveryorder()
	{
		$data['curr_page'] = 'deliveryorder';

		$this->load->library('grocery_CRUD');
		$crud = new grocery_CRUD();
		$crud->set_theme('tablestrap4');

		$state = $crud->getState();
		$stateInfo = $crud->getStateInfo();

		if ($state === 'read') {
			redirect('page/detail_do/' . $stateInfo->primary_key);
		}

		$this->curr_table = 'deliveryorder';
		$crud->set_table('deliveryorder');
		$crud->set_subject('Delivery Order');

		$crud->set_relation('PO_Number', 'purchaseorder', 'PO_Number');

		$crud->columns('ID', 'DO_Number', 'PO_Number', 'Company_Name', 'Date');

		// Rules
		$crud->unique_fields(array('ID', 'DO_Number'));
		$crud->required_fields(array('ID', 'DO_Number', 'PO_Number', 'Date'));

		// Callbacks
		$this->crud_state = $crud->getState();
		$crud->callback_add_field('ID', array($this, '_get_auto_generate_id'));
		$crud->callback_edit_field('ID', array($this, '_get_auto_generate_id'));
		$crud->callback_column('Company_Name', function ($value, $row) {
			$this->load->model('DatabaseModel');
			$po = $this->DatabaseModel->getPO($row->PO_Number);
			return $po->Name;
		});

		$output = $crud->render();
		$data['crud'] = get_object_vars($output);

		$this->render_backend('crud_view', $data);
	}

	public function detail_do($id)
	{
		$data['curr_page'] = 'deliveryorder';

		$this->load->model('DatabaseModel');
		$do = $this->DatabaseModel->getData('deliveryorder', array('ID' => $id));
		$po = $this->DatabaseModel->getPO($do->PO_Number);
		$do->Name = $po->Name;

		$this->load->library('grocery_CRUD');
		$crud = new grocery_CRUD();
		$crud->set_theme('tablestrap4');

		$state = $crud->getState();
		$stateInfo = $crud->getStateInfo();

		if ($state === 'print') {
			redirect('page/print_do/' . $id);
		}

		$this->curr_table = 'orderdetail';
		$crud->set_table('orderdetail');
		$crud->set_subject('Order Detail');

		$crud->display_as('ID_Product', 'Product Name');

		$crud->set_relation('ID_Product', 'product', 'Name');

		$crud->columns('ID', 'ID_Product', 'Size', 'Qty_Order', 'Qty_Sent', 'Status');

		$crud->where('PO_Number', $do->PO_Number);

		$crud->unset_add();
		$crud->unset_edit_fields('Qty_Order', 'ID', 'PO_Number');
		$crud->field_type('ID_Product', 'readonly');
		$crud->field_type('Size', 'readonly');

		// Rules
		$crud->unique_fields('ID');
		$crud->required_fields(array('Qty_Sent'));

		// Callbacks
		$crud->callback_read_field('Qty_Sent', function ($value, $row) {
			if ($value == 0) {
				return 0;
			}
			return $value;
		});
		$crud->callback_column('Status', function ($value, $row) {
			if ($row->Qty_Order === $row->Qty_Sent) {
				return 'Delivered';
			}
			return 'Pending';
		});

		$output = $crud->render();
		$data['crud'] = get_object_vars($output);
		$data['extra'] = get_object_vars($do);
		$data['table'] = 'Delivery Order';
		$data['state'] = $crud->getState();

		$this->render_backend('crud_view', $data);
	}

	public function print_do($id)
	{
		$data['curr_page'] = 'deliveryorder';

		$this->load->model('DatabaseModel');
		$data['deliveryorder'] = $this->DatabaseModel->getDO($id);
		$data['orderdetail'] = $this->DatabaseModel->getOrderDetail($data['deliveryorder']->PO_Number);
		$this->load->view('prints/delivery_order', $data);
	}

	public function _get_auto_generate_id($value)
	{
		if ($this->crud_state === 'edit') {
			return '<input id="field-ID" class="form-control" name="ID" type="text" value="' . $value . '" maxlength="6" readonly>';
		}
		$this->load->model('DatabaseModel');
		$lastId = $this->DatabaseModel->getLastId($this->curr_table);
		if ($lastId == NULL) {
			switch ($this->curr_table) {
				case 'company':
					$lastId = 'CY0000';
					break;
				case 'cusreqsize':
					$lastId = 'CS0000';
					break;
				case 'deliveryorder':
					$lastId = 'DO0000';
					break;
				case 'fabric':
					$lastId = 'FC0000';
					break;
				case 'orderdetail':
					$lastId = 'OD0000';
					break;
				case 'product':
					$lastId = 'PT0000';
					break;
			}
		}
		$newId = $this->DatabaseModel->getAutoId($lastId, 2, 4);
		return '<input id="field-ID" class="form-control" name="ID" type="text" value="' . $newId . '" maxlength="6" readonly>';
	}

	public function profile()
	{
		$this->load->model('UserModel');
		$this->load->model('DatabaseModel');

		$username = $this->session->userdata('username');
		$role = $this->session->userdata('role');
		$data = $this->UserModel->getProfile($username);

		$data['curr_page'] = 'profile';
		$this->render_backend('profile', $data);
	}

	public function form_profile()
	{

		$this->load->model('UserModel');

		$role = $this->session->userdata('role');

		$first_name = $this->input->post('iFName');
		$last_name = $this->input->post('iLName');
		$gender = $this->input->post('iGender');


		$data = array(
			'first_name' => $first_name,
			'last_name' => $last_name,
			'gender' => $gender,
		);

		$where = array(
			'username' => $this->session->userdata('username')
		);


		$table = 'user';

		$this->UserModel->update_data($where, $data, $table);

		$session = array(
			'first_name'    => $first_name,
			'last_name'     => $last_name,
		);

		$this->session->set_userdata($session);

		$this->session->set_flashdata('message', 'Profile has changed successfully');

		redirect('page/profile');
	}

	public function form_account()
	{
		$this->load->model('UserModel');

		$this->load->library('encryption');
		$key = 'super-secret-key';

		$role = $this->session->userdata('role');
		$username = $this->session->userdata('username');
		$user     = $this->UserModel->get($username);
		$curr_password = md5($this->input->post('curr_password'));
		$new_password = md5($this->input->post('new_password'));

		if ($curr_password != $user['user']->password) {
			$this->session->set_flashdata('error', 'Current password is wrong');
			redirect('page/profile');
		} else {

			$data = array(
				'password' => $new_password
			);


			$where = array(
				'username' => $username
			);


			$table = 'user';

			$this->UserModel->update_data($where, $data, $table);

			$this->session->set_flashdata('message', 'Password has changed successfully');

			redirect('page/profile');
		}
	}
}
