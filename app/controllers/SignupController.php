<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: SignupController
 * 
 * Automatically generated via CLI.
 */
class SignupController extends Controller {
    public function __construct() {
        parent::__construct();
        $this->call->library('lauth');
    }

    public function index() {
        if ($this->io->method() == 'post') {
            $firstname = $this->io->post('firstname');
            $lastname = $this->io->post('lastname');
            $email = $this->io->post('email');
            $password = $this->io->post('password');
            $confirm_password = $this->io->post('confirm_password');

            if ($password !== $confirm_password) {
                echo "Passwords do not match!";
                return;
            }

            $username = $firstname . ' ' . $lastname;
            $email_token = bin2hex(random_bytes(16));

            $this->lauth->register($username, $email, $password, $email_token);

            echo "Account created! Please check your email to verify.";
        } else {
            $this->call->view('auth/signup');
        }
    }
}