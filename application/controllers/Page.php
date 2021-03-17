<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Page extends MY_Controller {

    public function dashboard(){
        $data['curr_page'] = "dashboard";
        
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();
        $crud->set_table('company');
        $crud->set_theme('tablestrap4');
        $output = $crud->render();
        $data['crud'] = get_object_vars($output);

        $this->render_backend('dashboard', $data); 
    }

    public function company(){
        $data['curr_page'] = "company";

        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();
        $crud->set_table('company');
        $crud->set_theme('tablestrap4');
        $output = $crud->render();
        $data['crud'] = get_object_vars($output);

        $this->render_backend('crud_view', $data);  
    }

    public function cusreqsize(){
        $data['curr_page'] = "cusreqsize";

        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();
        $crud->set_table('cusreqsize');
        $crud->display_as('ID_Company', 'Company Name');
        $crud->set_subject('Custom Size');
        $crud->set_relation('ID_Company','company','Name');
        $crud->set_theme('tablestrap4');
        $output = $crud->render();
        $data['crud'] = get_object_vars($output);

        $this->render_backend('crud_view', $data);  
    }

    public function fabric(){
        $data['curr_page'] = "fabric";

        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();
        $crud->set_table('fabric');
        $crud->set_theme('tablestrap4');
        $output = $crud->render();
        $data['crud'] = get_object_vars($output);

        $this->render_backend('crud_view', $data);
    }

    public function product(){
        $data['curr_page'] = "product";

        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();
        $crud->set_table('product');
        $crud->set_theme('tablestrap4');
        $output = $crud->render();
        $data['crud'] = get_object_vars($output);

        $this->render_backend('crud_view', $data);
    }
    
    public function purchaseorder(){
        $data['curr_page'] = "purchaseorder";

        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();
        $crud->set_table('purchaseorder');
        $crud->set_theme('tablestrap4');
        $crud->display_as('ID_Company', 'Company Name');
        $crud->set_subject('Purchase Order');
        $crud->set_relation('ID_Company','company','Name');
        $output = $crud->render();
        $data['crud'] = get_object_vars($output);

        $this->render_backend('crud_view', $data);
    }

    public function deliveryorder(){
        $data['curr_page'] = "product";

        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();
        $crud->set_table('deliveryorder');
        $crud->set_theme('tablestrap4');
        $crud->set_subject('Delivery Order');
        $crud->set_relation('PO_Number','purchaseorder','PO_Number');
        $output = $crud->render();
        $data['crud'] = get_object_vars($output);

        $this->render_backend('crud_view', $data);
    }


    public function lesson(){

        $data['curr_page'] = "lesson";
        $this->render_backend('lesson', $data);
    }

    public function quiz(){
        $this->load->model('DatabaseModel');

        $data['curr_page'] = "quiz";
        $data['quiz'] = $this->DatabaseModel->getAllQuiz();
        $data['quiz_score'] = $this->DatabaseModel->getQuizScore($this->session->userdata('username'));
        
        $this->render_backend('quiz', $data);
    }

    public function quiz_form($id=NULL){
        $this->load->model('DatabaseModel');

        $data['curr_page'] = "quiz_form";
        $data['quiz'] = $this->DatabaseModel->getQuiz($id);
        $this->render_backend('quiz_form', $data);
    }

    public function profile(){
        $this->load->model('UserModel');
        $this->load->model('DatabaseModel');

        $username = $this->session->userdata('username');
        $role = $this->session->userdata('role');
        $data = $this->UserModel->getProfile($username);

        $data['curr_page'] = "profile";
        $this->render_backend('profile', $data); 
    }

    public function form_profile(){
        
        $this->load->model('UserModel');
            
        $role = $this->session->userdata('role');
        $nomor_induk = $this->session->userdata('nomor_induk');

        $first_name = $this->input->post('iFName');
        $last_name = $this->input->post('iLName');
        $gender = $this->input->post('iGender');
        $birth_date = $this->input->post('iBDate');

       
        $data = array(
            'first_name' => $first_name,
            'last_name' => $last_name,
            'gender' => $gender,
            'birth_date' => $birth_date
        );

    
        if($role == 'user'){
            $where = array(
                'username' => $this->session->userdata('username')
            );
        }

    
        $table = $role;
        
        $this->UserModel->update_data($where, $data, $table);

        $this->session->set_flashdata('message', 'Profile has changed successfully');

        redirect('page/profile');

    }

    public function form_account(){
        $this->load->model('UserModel');

        $this->load->library('encryption');
        $key = 'super-secret-key';

        $role = $this->session->userdata('role');
        $username = $this->session->userdata('username');
        $user     = $this->UserModel->get($username);
        $curr_password = md5($this->input->post('curr_password'));
        $new_password = md5($this->input->post('new_password'));

        if($curr_password != $user['user']->password){ 
            $this->session->set_flashdata('error', 'Current password is wrong'); 
            redirect('page/profile'); 
        }else{
          
            $data = array(
                'password' => $new_password
            );

           
            $where = array(
                'username' => $username
            );

          
            $table = $role;
            
            $this->UserModel->update_data($where, $data, $table);

            $this->session->set_flashdata('message', 'Password has changed successfully');

            redirect('page/profile');
        }

    }

}
?>