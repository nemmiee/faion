<?php
class Customer {
    private $id;
    private $name;
    private $email;
    private $address;
    private $phoneNum;
    private $createdAt;

    function __construct($id, $name, $email, $address, $phoneNum, $createdAt) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->address = $address;
        $this->phoneNum = $phoneNum;
        $this->createdAt = $createdAt;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function getAddress() {
        return $this->address;
    }

    public function setPhoneNum($phoneNum) {
        $this->phoneNum = $phoneNum;
    }

    public function getPhoneNum() {
        return $this->phoneNum;
    }

    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }
}
?>