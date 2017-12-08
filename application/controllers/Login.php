<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->pageData['is_home'] = true;
        $this->load->model('login_model');


        if ($this->session->userdata('user_id')) {
            redirect(base_url());
        }
    }


    function login()
    {

        if ($this->input->post()) {

            $this->form_validation->set_rules('username', 'username', 'trim|required|valid_email');
            $this->form_validation->set_rules('password', 'password', 'trim|required');
            if ($this->form_validation->run('') == TRUE) {

                $password = $this->input->post('password');
                $username = $this->input->post('username');

                $password = $this->data_validate($password);
                $username = $this->data_validate($username);


                $user_data = $this->login_model->getRestoUser($username, $password);

                if (empty($user_data)) {

                    $data['error_string'] = "Invalid username/password";
                    $this->load->view('login', $data);
                } else {

                    $new_user = array(
                        'username' => $user_data->email,
                        'restaurant_id' => $user_data->restaurant_id,

                    );

                    $this->session->set_userdata('user_id', $new_user);

                    redirect(base_url());
                }

                //var_dump($user_data);die;
            } else {

                $data['error_string'] = validation_errors();
                $this->load->view('login', $data);
            }


        } else {

            if ($session_id = $this->session->userdata('user_id')) {
                redirect(base_url());
            } else {

                $this->load->view('login');
            }
        }


    }

    function user_login()
    {


    }


    function data_validate($value = "")
    {
        $value = trim($value);
        $value = stripslashes($value);
        $value = strip_tags($value);
        $value = htmlspecialchars($value);

        return $value;
    }
}