<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Action extends MY_Controller {

    public function __construct(){
        parent:: __construct();
        $this->load->model('DatabaseModel');
        $this->load->helper('date');
        date_default_timezone_set("Asia/Jakarta");
    }

    public function new_quiz(){

        if (!empty($_FILES) && isset($_FILES['question'])) {
            $target_dir = "./assets/soal/";
            $target_file = $target_dir . basename($_FILES["question"]["name"]);
            $target_file2 = "/assets/soal/" . basename($_FILES["question"]["name"]);
            if (move_uploaded_file($_FILES["question"]["tmp_name"], $target_file)) {
                $id = $this->input->post('id');
                $title = $this->input->post('title');
                $subtitle = $this->input->post('subtitle');
                $imageUrl = $this->input->post('imageUrl');
                $question = $target_file2;
                $answer = $this->input->post('answer');

                
                $data = array(
                    'id'        => $id,
                    'title'     => $title,
                    'subtitle'  => $subtitle,
                    'imageUrl'  => $imageUrl,
                    'question'  => $question,
                    'answer'    => $answer
                );

               
                $table = 'quiz';

                $this->DatabaseModel->insert_data($data, $table);

                redirect('page/quiz');
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    public function delete_quiz($id){
        $quiz = $this->DatabaseModel->getQuiz($id);
        unlink('.'.$quiz->question);
        $this->DatabaseModel->deleteQuiz($id);
        redirect('page/quiz');
    }

    public function quiz_result($id=NULL){
        $answer = [];
        for($i=0;$i<10;$i++){
            $answer[$i] = $this->input->post('q-'.($i+1));
        }

        $quiz = $this->DatabaseModel->getQuiz($id);
        $keyAnswer = explode(',',$quiz->answer);
        $totalScore = 0;
        for($i=0;$i<count($keyAnswer);$i++){
            if ($answer[$i] === $keyAnswer[$i]) $totalScore++;
        }

        $format = "d-M-Y h:i:s A";
      
        $data = array(
            'username'      => $this->session->userdata('username'),
            'quiz_id'       => $id,
            'quiz_score'    => $totalScore*10,
            'last_updated'  => date($format)
        );

       
        $where = array(
            'quiz_id'  => $id,
            'username' =>  $this->session->userdata('username')
        );

     
        $table = 'score';
        
        $this->DatabaseModel->update_data($where, $data, $table);
        
        redirect('page/quiz');
    }
}
?>