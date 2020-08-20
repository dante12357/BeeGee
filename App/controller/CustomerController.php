<?php

class CustomerController extends AbstractController
{
    private $customer;
    public function __construct()
    {
        parent::__construct();
        $this->customer = new CustomerModel($this->database);
    }

    public function loginAction()
    {
        if ($_POST) {
            $result = $this->customer->login();
            echo $result;
            exit;
        }
        $this->render('login');
    }

    public function logoutAction()
    {
        $result = $this->customer->logout();
        echo $result;
    }

    public function registrationAction()
    {
        $this->render('registration');
    }
}
