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

	public function getPO($id)
	{
		$data = $this->db
			->select(array('PO_Number', 'company.Name', 'Date', 'Delivered_Schedule', 'Delivered_By'))
			->where('PO_Number', $id)
			->join('company', 'purchaseorder.ID_Company = company.ID')
			->get('purchaseorder')->row();
		return $data;
	}

	public function getDO($id)
	{
		$data = $this->db
			->select(array('D.ID', 'D.DO_Number', 'D.PO_Number', 'C.Name', 'C.Location', 'D.Date'))
			->from('deliveryorder as D')
			->where('D.ID', $id)
			->join('purchaseorder as P', 'P.PO_Number = D.PO_Number')
			->join('company as C', 'P.ID_Company = C.ID')
			->get()->row();
		return $data;
	}

	public function getOrderDetail($id)
	{
		$data = $this->db
			->select(array('product.Name', 'Size', 'Qty_Order', 'Qty_Sent'))
			->where('PO_Number', $id)
			->join('product', 'product.ID = orderdetail.ID_Product')
			->get('orderdetail')->result();
		return $data;
	}

	public function getAutoId($id_terakhir, $panjang_kode, $panjang_angka)
	{
		// mengambil nilai kode ex: KNS0015 hasil KNS
		$kode = substr($id_terakhir, 0, $panjang_kode);

		// mengambil nilai angka
		// ex: KNS0015 hasilnya 0015
		$angka = substr($id_terakhir, $panjang_kode, $panjang_angka);

		// menambahkan nilai angka dengan 1
		// kemudian memberikan string 0 agar panjang string angka menjadi 4
		// ex: angka baru = 6 maka ditambahkan strig 0 tiga kali
		// sehingga menjadi 0006
		$angka_baru = str_repeat("0", $panjang_angka - strlen($angka + 1)) . ($angka + 1);

		// menggabungkan kode dengan nilang angka baru
		$id_baru = $kode . $angka_baru;

		return $id_baru;
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

	// REFERENSI
	public function getQuizScore($id = NULL)
	{
		$this->db->where('username', $id);
		$data = $this->db->get('score')->result_array();

		return $data;
	}

	public function getAllQuiz()
	{
		$data = $this->db->get('quiz')->result_array();
		return $data;
	}

	public function getQuiz($id)
	{
		$this->db->where('id', $id);
		$data = $this->db->get('quiz')->row();
		return $data;
	}

	public function deleteQuiz($id)
	{
		$this->db->where('quiz_id', $id);
		$this->db->delete('score');

		$this->db->where('id', $id);
		$this->db->delete('quiz');
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
