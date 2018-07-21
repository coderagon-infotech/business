<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends ADMIN_Controller {

    public function __construct() {
        parent::__construct();
        ModelLoad('login_model');
    }

    /* view login page */

    public function index() {
        /* check login */
        if (Session()) {
            redirect(backend('dashboard'));
        } else {
            content_page_view('login', 'Admin_Login', $this->folder_name, 'content');
        }
    }

    /* check login ccredential */

    public function login_action() {

        /* post data */
        $email = $this->input->post("email", true);
        $password = $this->input->post("password", true);

        /* check validation */
        $form_required = array(
            'trim' => 'email,password',
            'required' => 'email,password',
            'valid_email' => 'email'
        );
        form_required($form_required);
        if ($this->form_validation->run() == false) {

            /* show error login form */
            $this->index();
        } else {

            /* check login credential valid or not */
            $users = $this->login_model->admin_authenticate($email, $password);
            if ($users['errorCode'] == 0) {
                error($users['errorMessage']);
                redirect(backend('login', 1));
            } else {
                success(lang('Welcome_Site'));
                redirect(backend('dashboard', 1));
            }
        }
    }

    /* admin current session unset */

    public function logout() {
        $this->session->unset_userdata("AdminID");
        $this->session->set_flashdata('msg_class', "success");
        $this->session->set_flashdata('msg', lang('Logout_success'));
        redirect('backend');
    }

    /* view forgot password page */

    public function forgot_password() {
        content_page_view('forgot-password', 'Forgot_Password', $this->folder_name, 'content');
    }

    /* check email reset password */

    public function forgot_action() {
        /* post data */
        $email = $this->input->post("email", true);

        /* check validation */
        $form_required = array(
            'trim' => 'email',
            'required' => 'email',
            'valid_email' => 'email'
        );
        form_required($form_required);
        if ($this->form_validation->run() == false) {

            /* show error login form */
            $this->forgot_password();
        } else {

            /* check login credential valid or not */
            $users = $this->login_model->check_admin_email($email);
            $this->load->helper('security');
            $this->load->library('sendmail');

            /* check error */
            if ($users['errorCode'] == 0) {
                error($users['errorMessage']);
                redirect(backend('forgot-password', 1));
            } else if ($users['errorCode'] == 1) {
                /* user data */
                $userid = $users['data']['id'];
                $code = rand(111111, 999999);
                $hidenuseremail = $users['data']['email'];
                $hidenusername = ucfirst($users['data']['first_name']) . " " . ucfirst($users['data']['last_name']);

                /* encryprt data */
                $encid = encryptData($userid);
                $enccode = encryptData($code);
                $url = site_url('backend/reset-password/' . $encid . "/" . $enccode);

                $update['reset_code'] = $code;
                $update['reset_date'] = date("Y-m-d H:i:S");
                $this->login_model->update('', $update, "id='" . $userid . "'");

                /* header */
                $html .= '<table cellmodel_supportspacing="0" cellpadding="0" style="background-color:#3bcdb0;width: 100%;">
                        <tr>
                            <td style = "background-color:#3bcdb0;">
                                <table cellspacing = "0" cellpadding = "0" style = "width: 100%;">
                                    <tr>
                                        <td style = "font-size:40px; padding: 10px 25px; color: #ffffff; text-align:center;" class = "mobile-spacing">
                                              ' . lang('Forgot_mail_message') . '
                                        <br>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>';

                $html .= '<table cellspacing = "0" cellpadding = "0" style = "width: 100%;" bgcolor = "#ffffff" >
                        <tr>
                            <td style = "background-color:#ffffff; padding-top: 15px;">
                                <center>
                                <table style = "margin: 0 auto;width: 90%;" cellspacing = "0" cellpadding = "0">
                                    <tbody>
                                        <tr>
                                            <td style = "text-align:left; color: #6f6f6f; font-size: 18px;">
                                                <br>
                                              ' . lang('Forgot_mail_content') . '
                                                <br>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <table style = "margin:0 auto;" cellspacing = "0" cellpadding = "10" width = "100%">
                                    <tbody>
                                        <tr>
                                            <td style = "text-align:center; margin:0 auto;">
                                                <br>
                                                    <div>
                                                    <a  style="background-color:#f5774e;color:#ffffff;display:inline-block;font-family:Helvetica, Arial, sans-serif;font-size:18px;font-weight:400;line-height:45px;text-align:center;text-decoration:none;width:220px;-webkit-text-size-adjust:none;" href = "' . $url . '">' . lang('Reset_Password') . '</a>
                                                    </div>
                                                <br>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>';

                $define_param['to_name'] = $hidenusername;
                $define_param['to_email'] = $hidenuseremail;
                $subject = lang('Forgot_success');
                $this->sendmail->send($define_param, $subject, $html);

                success(lang('Welcome_Site'));
                redirect(backend('forgot-password', 1));
            } else {
                error($users['errorMessage']);
                redirect(backend('forgot-password', 1));
            }
        }
    }

    /* show reset password form */

    public function reset_password($encid, $enccode) {
        $this->load->helper('security');
        $id = (int) decryptData($encid);
        $code = (int) decryptData($enccode);
        $fetch_data = $this->login_model->getData("", "*", "id='" . $id . "' AND reset_code='" . $code . "'");

        if (count($fetch_data) > 0) {
            $add_min = date("Y-m-d H:i:s", strtotime($fetch_data[0]['reset_date'] . "+1 hour"));
            if ($add_min > date("Y-m-d H:i:s")) {
                if ($fetch_data[0]['reset_code'] != 0) {
                    $page_data['id'] = $id;
                    content_page_view('reset-password', 'Reset_Password', $this->folder_name, 'content', $page_data);
                } else {
                    error(lang('Reset_failure'));
                    redirect(backend('forgot-password'));
                }
            } else {
                error(lang('Reset_failure'));
                 redirect(backend('forgot-password'));
            }
        } else {
            error(lang('Invalid_request'));
            redirect(backend('forgot-password'));
        }
    }

    /* reset password */

    public function reset_action() {
        /* post data */
        $this->load->helper('security');
        $id = (int) decryptData($this->input->post('id'));
        $password = $this->input->post('password');

        /* check validation */
        $form_required = array(
            'trim' => 'password,cpassword',
            'required' => 'password,password',
            'min_length[8]' => 'password,cpassword',
            'matches[password]' => 'cpassword'
        );
        form_required($form_required);
        if ($this->form_validation->run() == false) {

            /* show error login form */
            $page_data['id'] = $id;
            content_page_view('reset-password', 'Reset_Password', $this->folder_name, 'content', $page_data);
        } else {
            $update['reset_code'] = 0;
            $update['reset_date'] = "0000-00-00 00:00:00";
            $update['password'] = md5($password);
            $this->login_model->update("", $update, "id='" . $id . "'");
            success(lang('Reset_success'));
            redirect('backend');
        }
    }

}
