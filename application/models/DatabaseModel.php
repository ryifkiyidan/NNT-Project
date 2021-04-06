<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class DatabaseModel extends CI_Model
{
	// New Code
	public function getData($table, $where = null)
	{
		if ($where !== null) $this->db->where($where);
		$data = $this->db->get($table)->row();
		return $data;
	}

	public function getDatas($table, $where = null)
	{
		if ($where !== null) $this->db->where($where);
		$data = $this->db->get($table)->result();
		return $data;
	}

	public function getPO($id)
	{
		$data = $this->db
			->select(array('P.PO_Number', 'C.Name', 'P.Date', 'P.Delivered_Schedule', 'P.Delivered_By'))
			->from('purchaseorder as P')
			->where('P.ID', $id)
			->join('company as C', 'P.ID_Company = C.ID')
			->get()->row();
		return $data;
	}

	public function getDO($id)
	{
		$data = $this->db
			->select(array('D.DO_Number', 'P.PO_Number', 'C.Name', 'C.Location', 'D.Date'))
			->from('deliveryorder as D')
			->where('D.ID', $id)
			->join('purchaseorder as P', 'P.ID = D.ID_PurchaseOrder')
			->join('company as C', 'P.ID_Company = C.ID')
			->get()->row();
		return $data;
	}

	public function getOrderDetail($id)
	{
		$data = $this->db
			->select(array('P.Name', 'P.Size', 'O.Qty_Order', 'O.Qty_Sent'))
			->from('orderdetail as O')
			->where('O.ID_PurchaseOrder', $id)
			->join('product as P', 'P.ID = O.ID_Product')
			->get()->result();
		return $data;
	}

	public function getLastId($table)
	{
		$this->db->select('ID');
		$this->db->order_by('ID', 'DESC');
		$this->db->limit(1);
		$data = $this->db->get($table)->row();
		if ($data == NULL) {
			return NULL;
		} else {
			return $data->ID;
		}
	}

	public function update_data($where, $data, $table)
	{
		$this->db->where($where);
		$q = $this->db->get($table);
		if ($q->num_rows() > 0) {
			$this->db->where($where);
			$this->db->update($table, $data);
		} else {
			$this->db->set($data);
			$this->db->insert($table, $data);
		}
	}

	public function insert_data($data, $table)
	{
		$this->db->insert($table, $data);
	}
}
