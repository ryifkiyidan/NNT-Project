<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class DatabaseModel extends CI_Model {

    public function getQuizScore($id=NULL){
        $this->db->where('username', $id);
        $data = $this->db->get('score')->result_array();

        return $data;
    }

    public function getAllQuiz(){
        $data = $this->db->get('quiz')->result_array();
        return $data;
    }

    public function getQuiz($id){
        $this->db->where('id', $id);
        $data = $this->db->get('quiz')->row();
        return $data;
    }

    public function deleteQuiz($id){
        $this->db->where('quiz_id', $id);
        $this->db->delete('score');

        $this->db->where('id', $id);
        $this->db->delete('quiz');
    }

    public function update_data($where, $data, $table){
        $this->db->where($where);
        $q = $this->db->get($table);
		if($q->num_rows() > 0){
            $this->db->where($where);
            $this->db->update($table,$data);
        }
        else{
            $this->db->set($data);
            $this->db->insert($table, $data);
        }
    }

    public function insert_data($data, $table){
        $this->db->insert($table, $data);
    }

}
?>