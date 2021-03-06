<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Page extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('grocery_CRUD');
		$this->load->model('DatabaseModel');
	}

	public function dashboard()
	{
		$data['curr_page'] = 'dashboard';
		$data['totalCompany'] = $this->DatabaseModel->getCount('Company');
		$data['totalProduct'] = $this->DatabaseModel->getCount('Product');
		$data['totalPending'] = $this->DatabaseModel->getPending();
		$data['totalEarning'] = $this->DatabaseModel->getEarning();
		$data['earningOverview'] = $this->DatabaseModel->getEarningOverview();
		$data['project'] = $this->DatabaseModel->getProjects();
		$data['fabricUsed'] = $this->DatabaseModel->getFabricUsed();
		$this->render_backend('dashboard', $data);
	}

	public function company()
	{
		$data['curr_page'] = 'company';

		$crud = new grocery_CRUD();
		$crud->set_theme('tablestrap4');

		$this->curr_table = 'company';
		$crud->set_table('company');
		$crud->set_subject('Company');

		// Rules
		$crud->columns('Name', 'Location', 'Phone_Number', 'Fax_Number');
		$crud->required_fields(array('Name', 'Location', 'Phone_Number'));

		//unset crud func
		$crud->unset_export();
		$crud->unset_print();

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
		$opt = $this->input->get('opt', TRUE);
		$data['curr_page'] = 'cusreqsize';

		$crud = new grocery_CRUD();
		$crud->set_theme('tablestrap4');

		$this->curr_table = 'cusreqsize';
		$crud->set_table('cusreqsize');
		$crud->set_subject('Custom Size');

		$crud->display_as('ID_Company', 'Company Name');

		$crud->set_relation('ID_Company', 'company', 'Name');

		if ($opt !== NULL && $opt === 'show_less') {
			$crud->columns('ID_Company', 'Name', 'Gender');
		}

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
		$data['state'] = $crud->getState();
		$data['opt'] = $opt;

		$this->render_backend('crud_view', $data);
	}

	public function fabric()
	{
		$data['curr_page'] = 'fabric';

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

		//unset crud func
		$crud->unset_export();
		$crud->unset_print();

		// Callbacks
		$crud->callback_column('Status', function ($value, $row) {

			$ods = $this->DatabaseModel->getDatas('orderdetail', array('ID_PurchaseOrder' => $row->ID));
			foreach ($ods as $od) {
				if ($od->Qty_Sent < $od->Qty_Order) {
					return 'Pending';
				} else if ($od->Qty_Sent == $od->Qty_Order) {
					return 'Delivered';
				}
			}
			return ' - ';
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
		$data['curr_page'] = 'detail_po';


		$crud = new grocery_CRUD();
		$crud->set_theme('tablestrap4');

		$this->curr_table = 'orderdetail';
		$crud->set_table('orderdetail');
		$crud->set_subject('Order Detail');

		$crud->display_as('ID_Product', 'Product Name');
		$crud->display_as('ID_PurchaseOrder', 'PO_Number');

		$crud->set_relation('ID_Product', 'product', '{Name} - {Size}');
		$crud->set_relation('ID_PurchaseOrder', 'purchaseorder', 'PO_Number');

		$crud->columns('ID_Product', 'Unit_Price', 'Qty_Order', 'Amount');

		$crud->where('ID_PurchaseOrder', $id);

		$crud->unset_fields('Qty_Sent');
		$crud->unset_read();

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
		$crud->callback_column('Unit_Price', function ($row, $value) {
			return 'Rp. ' . $this->DatabaseModel->getData('product', array('ID' => $value->ID_Product))->Price;
		});
		$crud->callback_column('Amount', function ($row, $value) {
			$product = $this->DatabaseModel->getData('product', array('ID' => $value->ID_Product));
			return 'Rp. ' . $product->Price * $value->Qty_Order;
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

		//unset crud func
		$crud->unset_export();
		$crud->unset_print();

		// Callbacks
		$this->crud_state = $crud->getState();
		$crud->callback_column('Company_Name', function ($value, $row) {

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
		$data['curr_page'] = 'detail_do';
		$data['id'] = $id;
		$this->id_deliveryOrder = $id;

		$do = $this->DatabaseModel->getData('deliveryorder', array('ID' => $id));
		$po = $this->DatabaseModel->getPO($do->ID_PurchaseOrder);
		$relation = $this->DatabaseModel->getDatas('relation_od_do', array('ID_DeliveryOrder' => $id));
		$do->Name = $po->Name;

		$crud = new grocery_CRUD();
		$crud->set_theme('tablestrap4');

		$state = $crud->getState();
		$stateInfo = $crud->getStateInfo();

		if ($state === 'print') {
			redirect('page/print_do/' . $id);
		} else if ($state === 'add') {
			redirect('page/add_do/' . $id);
		}

		$this->curr_table = 'orderdetail';
		$crud->set_table('orderdetail');
		$crud->set_subject('Order Detail');

		$crud->display_as('ID_Product', 'Product Name');

		$crud->set_relation('ID_Product', 'product', '{Name} - {Size}');

		$crud->columns('ID_Product', 'Qty_Order', 'Qty_Sent', 'Status');

		if (empty($relation)) {
			$crud->where('orderdetail.ID', '0');
		} else {
			foreach ($relation as $r) {
				$crud->or_where('orderdetail.ID', $r->ID_OrderDetail);
			}
		}

		$crud->unset_add();
		$crud->unset_read();
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
		$crud->callback_delete(array($this, '_delete_relation'));

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

	public function add_do($id)
	{
		$data['curr_page'] = 'add_do';
		// $id itu adalah ID Delivery Order
		$data['datasets'] = $this->DatabaseModel->getDatasetsDO($id);
		$data['curr_state'] = 'add';
		$data['id'] = $id;
		$this->render_backend('delivery_order/add', $data);
	}

	public function form_add_do($id_deliveryOrder)
	{
		$id_orderDetail = $this->input->post('checkbox');
		foreach ($id_orderDetail as $id) {
			$data = array('ID_DeliveryOrder' => $id_deliveryOrder, 'ID_OrderDetail' => $id);
			$this->DatabaseModel->insert_data($data, 'relation_od_do');
		}
		redirect('page/detail_do/' . $id_deliveryOrder);
	}

	public function print_do($id)
	{
		$data['curr_page'] = 'deliveryorder';

		$data['deliveryorder'] = $this->DatabaseModel->getDO($id);
		$data['orderdetail'] = $this->DatabaseModel->getOrderDetail($id);
		$this->load->view('prints/delivery_order', $data);
	}

	public function activitylog()
	{
		$data['curr_page'] = 'activitylog';

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
		$crud->unset_export();
		$crud->unset_print();

		$output = $crud->render();
		$data['crud'] = get_object_vars($output);

		$this->render_backend('crud_view', $data);
	}

	public function _delete_relation($primary_key)
	{
		return $this->DatabaseModel->deleteRelation($this->id_deliveryOrder, $primary_key);
	}

	public function _getUserLog($post_array = null, $primary_key = null)
	{
		//get activitylog
		$username = $this->session->userdata('username');
		$currID = $this->curr_id->primary_key;

		//ambil ID setelah insert/add/clone
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
			'action_detail' => 'Successfully ' . $thisstate . ' ' . $thistable . ' (ID: ' . $currID . ')',

		);
		$logtable = 'activitylog';
		$this->DatabaseModel->insert_data($loginfo, $logtable);

		return true;
	}

	public function profile()
	{
		$this->load->model('UserModel');

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

		$this->session->set_tempdata('message', 'Profile has changed successfully', 1);

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
			$this->session->set_tempdata('error', 'Current password is wrong', 1);
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

			$this->session->set_tempdata('message', 'Password has changed successfully', 1);

			redirect('page/profile');
		}
	}
}
