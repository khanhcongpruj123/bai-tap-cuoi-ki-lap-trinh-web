<?php

class User {

    public $id;
    public $name;
    public $sex;
    public $account;
    public $role;

    function __construct($id, $name, $sex, $account, $role) {
        $this->id = $id;
        $this->name = $name;
        $this->sex = $sex;
        $this->account = $account;
        $this->role = $role;
    }
}


?>