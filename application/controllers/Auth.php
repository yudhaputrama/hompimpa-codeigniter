<?php

/**
 * @property  CI_Form_validation form_validation
 * @property  Authentication authentication
 * @property  Facebook facebook
 */
class Auth extends PT_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('facebook');
    }

    public function index(){
        redirect('/auth/login');
    }

    public function keygenerate(){
//        $this->load->library('encryption');
//        echo bin2hex($this->encryption->create_key(16));
//        $plain_text = 'This is a plain-text message!';
//        echo $ciphertext = $this->encryption->encrypt($plain_text);
//        echo password_hash("Kurniawan", PASSWORD_BCRYPT);
//        echo password_verify("Kurniawan", "$2y$10$5aDj9PSOoWfj/MIqzAvekulnsqI8QohC2A4fxzvrOiPgH3tIaKj.q");
//        $this->authentication->set_auth(12);
//        echo $this->authentication->login('YUDHAPUTRAMA',"Kurniawan");
//        var_dump($this->authentication->is_logged());
//        var_dump($this->authentication->get_user());
//        $this->authentication->clear_auth();
//        var_dump($this->authentication->is_logged());
//        $this->authentication->guest_redirect_to();
// Outputs: This is a plain-text message!
//        echo $this->encryption->decrypt($ciphertext);
    }

    public function login(){

        $this->form_validation->set_rules('email','Email','required');
        $this->form_validation->set_rules('password','Password','required');

        if ($this->form_validation->run() === FALSE){
            $this->view_template('auth/login');
//            $this->load->view('templates/header.php');
//            $this->load->view('auth/login');
//            $this->load->view('templates/footer.php');
        } else {
            $this->form_validation->set_rules('email','Email','valid_email');

        }
    }

    public function fb_login(){
        $data['user'] = array();

        // Check if user is logged in
        if ($this->facebook->is_authenticated())
        {
            echo $this->facebook->is_authenticated();
            // User logged in, get user details
            $user = $this->facebook->request('get', '/me?fields=id,name,email');
            if (!isset($user['error']))
            {
                $data['user'] = $user;
            }

        }

        // display view
        $this->load->view('examples/web', $data);
    }

    public function twitter(){

    }

    public function register(){
        $this->view_template('auth/register');
    }
}