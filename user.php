<?php

class User {

    public $id;
    public $name;
    public $sex;
    public $account;

    function __construct($id, $name, $sex, $account) {
        $this->id = $id;
        $this->name = $name;
        $this->sex = $sex;
        $this->account = $account;
    }
}


?>