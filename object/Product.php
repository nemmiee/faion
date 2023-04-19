<?php
class Product {
    private $id;
    private $categoryId;
    private $name;
    private $description;
    private $price;
    private $image;
    private $discount;
    private $quantity;
    private $sold;
    private $status;
    private $createdAt;

    function __construct($id, $categoryId, $name, $description, $price, $image, 
                        $discount, $quantity, $sold, $status, $createdAt) {
        $this->id = $id;
        $this->categoryId = $categoryId;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->image = $image;
        $this->discount = $discount;
        $this->quantity = $quantity;
        $this->sold = $sold;
        $this->status = $status;
        $this->createdAt = $createdAt;
    }

    function setId($id) {
        $this->id = $id;
    }

    function getId() {
        return $this->id;
    }

    function setCategoryId($categoryId) {
        $this->categoryId = $categoryId;
    }

    function getCategoryId() {
        return $this->categoryId;
    }

    function setName($name) {
        $this->name = $name;
    }

    function getName() {
        return $this->name;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function getDescription() {
        return $this->description;
    }

    function setPrice($price) {
        $this->price = $price;
    }

    function getPrice() {
        return $this->price;
    }

    function setImage($image) {
        $this->image = $image;
    }

    function getImage() {
        return $this->image;
    }

    function setDiscount($discount) {
        $this->discount = $discount;
    }

    function getDiscount() {
        return $this->discount;
    }

    function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    function getQuantity() {
        return $this->quantity;
    }

    function setSold($sold) {
        $this->sold = $sold;
    }

    function getSold() {
        return $this->sold;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function getStatus() {
        return $this->status;
    }    

    function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;
    }

    function getCreatedAt() {
        return $this->createdAt;
    }
}
?>