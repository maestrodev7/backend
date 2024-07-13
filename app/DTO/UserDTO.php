<?php
namespace App\DTO;

class UserDTO{
    public $username;
    public $email;
    public $role;
    public $phoneNumber;
    public $password;

    public function __construct($username,$email,$role,$phoneNumber,$password)
    {
        $this->username= $username;
        $this->email = $email;
        $this->role= $role;
        $this->phoneNumber = $phoneNumber;
        $this->password= $password;

    }
}