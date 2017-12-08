<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('Admincontroller.php');

class Admin extends Admincontroller
{

    var $userData = false;
    var $loggedIn = false;
    var $userId = 0;
    var $userEmail = '';


    function __construct()
    {
        parent::__construct();

        $this->pageData['mod'] = "welcome";
        $this->load->model('admin/user_model');

        if ($this->_isLoggedIn()) {

//            $this->session->sess_destroy();
            $user = $this->session->userdata('user');
            $rest_id = $user->restaurant_id;

            if ($user->userrole != 'admin' && $this->uri->segment(3) != 'logout' && $this->uri->segment(3) != 'check_table_numbers' && $this->uri->segment(3) != 'allow_table_numbers') {

                redirect(site_url("admin/restaurants/edit/{$rest_id}/0"));
            }

        } else {

//            redirect(site_url('admin/admin/login'));
        }
        $this->form_validation->set_error_delimiters('<div class="error_validation">', '</div>');

    }

    function index()
    {
        if (!$this->_isLoggedIn()) {
            $this->pageData['is_login_page'] = true;
            $this->pageData['current_view'] = "admin/login";
            $this->_renderPage();
        } else {
            $this->_renderPage();
        }
    }

    function test()
    {
        echo 11;
        exit;

    }

    function login()
    {

        if (!$this->_isLoggedIn()) {


            $this->form_validation->set_rules('login', 'Login', 'required|trim');
            $this->form_validation->set_rules('password', 'Password', 'required|trim');

            if ($this->form_validation->run('') == TRUE) {

                $username = $this->input->post("login", TRUE);
                $password = $this->input->post("password", TRUE);

                $userdata = $this->user_model->AdminLogin($username, $password);

                if (!empty($userdata)) {
                    if ($userdata->userrole == 'admin') {
                        $this->load->library('encrypt');
                        $verifyCode = $this->encrypt->encode($userdata->email . $this->config->item('encryption_key'));
                        $this->session->set_userdata('verify_code', $verifyCode);
                        $this->session->set_userdata('user', $userdata);
                        redirect('admin');
                    } else {

                        $this->load->library('encrypt');
                        $verifyCode = $this->encrypt->encode($userdata->email . $this->config->item('encryption_key'));
                        $this->session->set_userdata('verify_code', $verifyCode);
                        $this->session->set_userdata('user', $userdata);
                        redirect("admin/restaurants/edit/{$userdata->restaurant_id}/0");
                    }
                } else {
                    $this->pageData['invalid_username_password'] = '<div class="error_validation">Invalid username/password.</div>';
                }

            } else {
                $this->pageData['error_string'] = validation_errors();
            }


            //$this->load->view('admin/login',$this->pageData);
            $this->pageData['is_login_page'] = true;
            $this->pageData['current_view'] = "admin/login";
            $this->_renderPage();
            return;


        }
        redirect('admin/');
    }


    function profile()
    {
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        $this->form_validation->set_rules('oldpass', 'Old Pass', 'trim');
        $this->form_validation->set_rules('pass', 'New Pass', 'trim|min_length[6]|callback_check_password');
        $this->form_validation->set_rules('repass', 'Re New Pass*', 'trim');

        $userObj = $this->user_model->GetAdmin();

        if ($this->form_validation->run('') == TRUE) {
            $oldPass = $this->input->post('oldpass', true);
            $pass = $this->input->post('pass', true);
            $repass = $this->input->post('repass', true);
            $err = false;

            $prArr = array(
                'email' => $this->input->post('email', true),
                'first_name' => $this->input->post('first_name', true),
                'last_name' => $this->input->post('last_name', true),
            );

            if (!empty($oldPass) && (empty($pass) || empty($repass))) {
                $this->pageData['error_msg'] = 'Please enter New Password';
                $err = true;
            }

            if (!empty($oldPass) && (sha1($oldPass) != $userObj->password)) {
                $this->pageData['error_msg'] = 'Old Password is incorrect';
                $err = true;
            }

            if (empty($oldPass) && (!empty($pass) && !empty($repass))) {
                $this->pageData['error_msg'] = 'Please enter Old Password';
                $err = true;
            }

            if (!empty($oldPass) && (sha1($oldPass) == $userObj->password) && !$err) {
                $prArr['password'] = sha1($pass);
                $upd = $this->user_model->UpdateAdmin($prArr);
                if ($upd) {
                    $this->session->set_userdata('edit', 1);
                }
                redirect('/admin/admin/profile');
            }

            if (empty($oldPass) && empty($pass) && !$err) {
                $upd = $this->user_model->UpdateAdmin($prArr);
                if ($upd) {
                    $this->session->set_userdata('edit', 1);
                }
                redirect('/admin/admin/profile');
            }
        }

        $this->pageData['error_string'] = validation_errors();
        $this->pageData['userObj'] = $userObj;

        $this->pageData['current_view'] = 'admin/profile';
        $this->_renderPage();
    }


    function check_password($val)
    {
        if (!empty($val) && ($val !== $this->input->post('repass'))) {
            $this->form_validation->set_message('check_password', 'New Pass and Re New Pass fields must contain the same value');
            return FALSE;
        } else {
            return true;
        }
    }


    function logout()
    {
        $this->session->unset_userdata('verify_code');
        $this->session->unset_userdata('user_email');
        $this->session->sess_destroy();
        redirect('admin/admin/login');
    }


    function check_table_numbers()
    {
        $tables = array();
        if ($this->userData->userrole != 'admin') {
            $tables = $this->mAdmin->GetAll1('order_table_numbers', 0, 0, array('status' => 0, 'restaurant_id' => $this->userData->restaurant_id));
        }
        echo json_encode($tables);

    }


    function allow_table_numbers($restaurant_id = 0, $table_number = 0)
    {
        if ($restaurant_id && $table_number) {
            $this->mAdmin->UpdateWhere('order_table_numbers',
                array(
                    'status' => STATUS_PUBLISHED,
                    'push_date' => time()),
                array(
                    'restaurant_id' => $restaurant_id,
                    'table_number' => $table_number,
                )
            );
        }
    }

}