<?php
class Category {
    private $id;
    private $name;
    private $parentId;
    private $description;
    private $status;
    private $createdAt;

    function __construct($id, $name, $parentId, $description, $status, $createdAt)
    {
        $this->id = $id;
        $this->name = $name;
        $this->parentId = $parentId;
        $this->description = $description;
        $this->status = $status;
        $this->createdAt = $createdAt;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

}
?>