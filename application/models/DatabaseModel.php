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

	public function getDatasetsDO($id)
	{
		$data = $this->db
			->select('od.ID as ID, CONCAT(p.Name," - ",p.Size) as Name, od.Qty_Order as Qty_Order, od.Qty_Sent as Qty_Sent')
			->from('deliveryorder as do')
			->join('relation_od_do as r', 'do.ID = r.ID_DeliveryOrder')
			->join('orderdetail as od', 'od.ID = r.ID_OrderDetail')
			->join('product as p', 'p.ID = od.ID_Product')
			->where("$id = od.ID_PurchaseOrder")
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

	public function getCount($table)
	{
		$data = $this->db->get($table)->num_rows();
		return $data;
	}

	public function getPending()
	{
		$data = $this->db
			->select('*')
			->from('purchaseorder as po')
			->join('orderdetail as od', 'po.ID = od.ID_PurchaseOrder')
			->where('od.Qty_Sent < od.Qty_Order')
			->get()->num_rows();
		return $data;
	}

	public function getEarning()
	{
		$data = $this->db
			->select('SUM(pd.Price * od.Qty_Order) as Total')
			->from('purchaseorder as po')
			->join('orderdetail as od', 'po.ID = od.ID_PurchaseOrder')
			->join('product as pd', 'pd.ID = od.ID_Product')
			->where('od.Qty_Sent = od.Qty_Order')
			->get()->row();
		return $data;
	}

	public function getEarningOverview()
	{
		$data = $this->db
			->select('MONTHNAME(po.Date) as Label, SUM(pd.Price * od.Qty_Order) as Total')
			->from('purchaseorder as po')
			->join('orderdetail as od', 'po.ID = od.ID_PurchaseOrder')
			->join('product as pd', 'pd.ID = od.ID_Product')
			->where('od.Qty_Sent = od.Qty_Order')
			->group_by('YEAR(po.Date)')
			->group_by('MONTH(po.Date)')
			->get()->result();
		return $data;
	}

	public function getProjects()
	{
		$data = $this->db
			->select('CONCAT(po.PO_Number, " - ", co.Name) as Label, CAST(((SUM(od.Qty_Sent) / SUM(od.Qty_Order))*100) AS int) as Percentage')
			->from('purchaseorder as po')
			->join('orderdetail as od', 'po.ID = od.ID_PurchaseOrder')
			->join('company as co', 'co.ID = po.ID_Company')
			->group_by('po.PO_Number')
			->limit(5)
			->order_by('po.Date', 'DESC')
			->get()->result();
		return $data;
	}

	public function getFabricUsed()
	{
		$data = $this->db
			->select('f.Name as Label, COUNT(p.ID_Fabric) as Total')
			->from('product as p')
			->join('fabric as f', 'p.ID_Fabric = f.ID')
			->group_by('f.Name')
			->limit(3)
			->order_by('Total', 'DESC')
			->get()->result();
		return $data;
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
