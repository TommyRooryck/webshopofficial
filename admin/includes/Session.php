<?php


class Session
{

    private $signed_in = false;
    public $user_id;

    /**Sessions methods**/
    function __construct()
    {
        session_start();
        $this->check_the_login();
        $this->check_message();

    }


    private function check_the_login()
    {
        if (isset($_SESSION['user_id'])) {
            $this->user_id = $_SESSION['user_id'];
            $this->signed_in = true;
        } else {
            unset($this->user_id);
            $this->signed_in = false;
        }
    }


    /**Login methodes**/
    public function is_signed_in()
    {
        return $this->signed_in;
    }

    public function login($user)
    {
        if ($user) {
            $this->user_id = $_SESSION['user_id'] = $user->id;
            $this->signed_in = true;
        }
    }


    /**Logout methode**/
    public function logout()
    {
        session_destroy();
        $this->signed_in = false;
    }

    /* public  function auto_logout(){
        $_SESSION['timestamp'] = time();
        if (time() - $_SESSION['timestamp'] > 10){
            echo "<script type='text/javascript'> alert('Logged out due to inactivity!'); </script> ";
            unset($_SESSION['user_id']);
            unset($this->user_id);
            $this->signed_in = false;
        } else{
            $_SESSION['timestamp'] = time();
        }
    }*/



    /**Message methods**/
    public function message($msg="")
    {
        if (!empty($msg)) {
            $_SESSION['message'] = $msg;
        }else {
            return $this->message;
        }
    }

    private function check_message()
    {
        if (isset($_SESSION['message'])){
            $this->message = $_SESSION['message'];
            unset($_SESSION['message']);
        } else{
            $this->message = "";
        }
    }




}

$session = new Session();
