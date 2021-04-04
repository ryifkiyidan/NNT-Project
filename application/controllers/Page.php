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
		$crud->required_fields(array('Name', 'Location', 'Phone_Number'));

		// Callbacks
		$this->crud_state = $crud->getState();

		//callback get activitylog
		//get id bersangkutan
		$this->curr_id = $crud->getStateInfo();
		$crud->callback_after_insert(array($this, '_getUserLog'));
		$crud->callback_after_update(array($this, '_getUserLog'));
		$crud->callback_after_delete(array($this, '_getUserLog'));

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

		$crud->columns('ID_Company', 'Name', 'Gender');

		// Rules
		$crud->required_fields(array('ID_Company', 'Name', 'Gender'));

		// Callbacks
		$this->crud_state = $crud->getState();

		//callback get activitylog
		$this->curr_id = $crud->getStateInfo();
		$crud->callback_after_insert(array($this, '_getUserLog'));
		$crud->callback_after_update(array($this, '_getUserLog'));

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
		$crud->required_fields(array('Name', 'Price'));

		$this->crud_state = $crud->getState();
		// Callback get activitylog
		$this->curr_id = $crud->getStateInfo();
		$crud->callback_after_insert(array($this, '_getUserLog'));
		$crud->callback_after_update(array($this, '_getUserLog'));

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
		$crud->required_fields(array('ID_Company', 'ID_Fabric', 'Name', 'Price'));

		// Callbacks
		$this->crud_state = $crud->getState();

		//callback get activitylog
		$this->curr_id = $crud->getStateInfo();
		$crud->callback_after_insert(array($this, '_getUserLog'));
		$crud->callback_after_update(array($this, '_getUserLog'));

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

		$crud->columns('PO_Number', 'ID_Company', 'Date', 'Delivered_Schedule', 'Delivered_By', 'Status');

		// Rules
		$crud->unique_fields('PO_Number');
		$crud->required_fields(array('PO_Number', 'ID_Company', 'Date', 'Delivered_Schedule'));

		// Callbacks
		$crud->callback_column('Status', function ($value, $row) {
			$this->load->model('DatabaseModel');
			$ods = $this->DatabaseModel->getDatas('orderdetail', array('ID_PurchaseOrder' => $row->ID));
			foreach ($ods as $od) {
				if ($od->Qty_Sent < $od->Qty_Order) {
					return 'Pending';
				}
			}
			return 'Delivered';
		});
		//callback get activitylog
		$this->crud_state = $crud->getState();
		$this->curr_id = $crud->getStateInfo();
		$crud->callback_after_insert(array($this, '_getUserLog'));
		$crud->callback_after_update(array($this, '_getUserLog'));

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
		$crud->display_as('ID_PurchaseOrder', 'PO_Number');

		$crud->set_relation('ID_Product', 'product', 'Name');
		$crud->set_relation('ID_PurchaseOrder', 'purchaseorder', 'PO_Number');

		$crud->columns('ID_Product', 'Qty_Order', 'Size');

		$crud->where('ID_PurchaseOrder', $id);

		$crud->unset_fields('Qty_Sent');

		// Rules
		$crud->required_fields(array('ID_Product', 'ID_PurchaseOrder', 'Qty_Order', 'Size'));

		// Callbacks
		$this->crud_state = $crud->getState();
		$this->id = $id;
		$crud->callback_add_field('ID_PurchaseOrder', function () {
			$po = $this->DatabaseModel->getPO($this->id);
			return '<select id="field-ID_PurchaseOrder" class="form-control" name="ID_PurchaseOrder" data-placeholder="Select PO Number" readonly><option value="' . $this->id . '">' . $po->PO_Number . '</option></select>';
		});
		$crud->callback_edit_field('ID_PurchaseOrder', function () {
			$po = $this->DatabaseModel->getPO($this->id);
			return '<select id="field-ID_PurchaseOrder" class="form-control" name="ID_PurchaseOrder" data-placeholder="Select PO Number" readonly><option value="' . $this->id . '">' . $po->PO_Number . '</option></select>';
		});

		//callback get activitylog
		$this->curr_id = $crud->getStateInfo();
		$crud->callback_after_insert(array($this, '_getUserLog'));
		$crud->callback_after_update(array($this, '_getUserLog'));

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

		$crud->display_as('ID_PurchaseOrder', 'PO_Number');

		$crud->set_relation('ID_PurchaseOrder', 'purchaseorder', 'PO_Number');

		$crud->columns('DO_Number', 'ID_PurchaseOrder', 'Company_Name', 'Date');

		// Rules
		$crud->unique_fields(array('ID', 'DO_Number'));
		$crud->required_fields(array('DO_Number', 'ID_PurchaseOrder', 'Date'));

		// Callbacks
		$this->crud_state = $crud->getState();
		$crud->callback_column('Company_Name', function ($value, $row) {
			$this->load->model('DatabaseModel');
			$po = $this->DatabaseModel->getPO($row->ID_PurchaseOrder);
			return $po->Name;
		});

		//callback get activitylog
		$this->curr_id = $crud->getStateInfo();
		$crud->callback_after_insert(array($this, '_getUserLog'));
		$crud->callback_after_update(array($this, '_getUserLog'));

		$output = $crud->render();
		$data['crud'] = get_object_vars($output);

		$this->render_backend('crud_view', $data);
	}

	public function detail_do($id)
	{
		$data['curr_page'] = 'deliveryorder';

		$this->load->model('DatabaseModel');
		$do = $this->DatabaseModel->getData('deliveryorder', array('ID' => $id));
		$po = $this->DatabaseModel->getPO($do->ID_PurchaseOrder);
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

		$crud->columns('ID_Product', 'Size', 'Qty_Order', 'Qty_Sent', 'Status');

		$crud->where('ID_PurchaseOrder', $do->ID_PurchaseOrder);

		$crud->unset_add();
		$crud->unset_edit_fields('Qty_Order', 'ID', 'ID_PurchaseOrder');
		$crud->field_type('ID_Product', 'readonly');
		$crud->field_type('Size', 'readonly');

		// Rules
		$crud->required_fields(array('Qty_Sent'));

		// Callbacks
		$this->crud_state = $crud->getState();
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

		//callback get activitylog
		$this->curr_id = $crud->getStateInfo();
		$crud->callback_after_update(array($this, '_getUserLog'));

		$output = $crud->render();
		$data['crud'] = get_object_vars($output);
		$data['extra'] = get_object_vars($this->DatabaseModel->getDO($id));
		$data['table'] = 'Delivery Order';
		$data['state'] = $crud->getState();

		$this->render_backend('crud_view', $data);
	}

	public function print_do($id)
	{
		$data['curr_page'] = 'deliveryorder';

		$this->load->model('DatabaseModel');
		$do = $this->DatabaseModel->getData('deliveryorder', array('ID' => $id));
		$data['deliveryorder'] = $this->DatabaseModel->getDO($id);
		$data['orderdetail'] = $this->DatabaseModel->getOrderDetail($do->ID_PurchaseOrder);
		$this->load->view('prints/delivery_order', $data);
	}

	public function activitylog()
	{
		$data['curr_page'] = 'activitylog';

		$this->load->library('grocery_CRUD');
		$crud = new grocery_CRUD();
		$crud->set_theme('tablestrap4');

		$this->curr_table = 'activitylog';
		$crud->set_table('activitylog');
		$crud->set_subject('Activity Log');
		$crud->columns('username', 'action', 'action_table', 'action_time');
		$crud->display_as('username', 'User');

		$crud->order_by('action_time', 'desc');
		$crud->unset_add();
		$crud->unset_edit();

		$output = $crud->render();
		$data['crud'] = get_object_vars($output);

		$this->render_backend('crud_view', $data);
	}


	public function _getUserLog($post_array = null, $primary_key = null)
	{
		//get activitylog
		$username = $this->session->userdata('username');
		$ip = $this->_getUserIpAddr();
		$currID = $this->curr_id->primary_key;

		//ambil ID setelah insert/add/clone
		$this->load->model('DatabaseModel');
		if ($currID == NULL) {
			$currID = $this->DatabaseModel->getLastId($this->curr_table);
		}

		//Capitalize each automatic var
		$thistable = strtoupper($this->curr_table);
		$thisstate = strtoupper($this->crud_state);

		$loginfo = array(
			'username' => $username,
			'action' => $thisstate,
			'action_table' => $thistable,
			'action_detail' => 'Successfully ' . $thisstate . ' ' . $thistable . ' ID: ' . $currID . ' From: ' . $ip,

		);
		$logtable = 'activitylog';
		$this->DatabaseModel->insert_data($loginfo, $logtable);

		return true;
	}

	public function _getUserIpAddr()
	{
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			//ip from share internet
			$ip = gethostbyname($_SERVER['HTTP_CLIENT_IP']);
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			//ip pass from proxy
			$ip = gethostbyname($_SERVER['HTTP_X_FORWARDED_FOR']);
		} else {
			$ip = gethostbyname($_SERVER['REMOTE_ADDR']);
		}
		return $ip;
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
