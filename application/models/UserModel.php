<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class UserModel extends CI_Model
{

    public function get($username)
    {

        $this->db->where('username', $username);
        $data['user'] = $this->db->get('user')->row();

        return $data;
    }

    public function getProfile($username)
    {
        $this->db->where('username', $username);
        $data['user'] = $this->db->get('user')->row();
        return $data;
    }

    public function registerAccount($data)
    {
        return $this->db->insert('user', $data);
    }

    public function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
}
