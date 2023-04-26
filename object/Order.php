<?php 
class Order{
    private $id;
    private $custId;
    private $total;
    private $status;
    private $createdDate;
    private $canceledDate;
    private $completedDate;
    function __construct($id, $custId, $total, $status, $createdDate, $canceledDate, 
                        $completedDate) {
        $this->id = $id;
        $this->custId = $custId;
        $this->total = $total;
        $this->status = $status;
        $this->createdDate = $createdDate;
        $this->canceledDate = $canceledDate;
        $this->completedDate = $completedDate;
    
    }

	/**
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 * @param mixed $id 
	 * @return self
	 */
	public function setId($id): self {
		$this->id = $id;
		return $this;
	}
	
	/**
	 * @return mixed
	 */
	public function getCustId() {
		return $this->custId;
	}
	
	/**
	 * @param mixed $custId 
	 * @return self
	 */
	public function setCustId($custId): self {
		$this->custId = $custId;
		return $this;
	}
	
	/**
	 * @return mixed
	 */
	public function getTotal() {
		return $this->total;
	}
	
	/**
	 * @param mixed $total 
	 * @return self
	 */
	public function setTotal($total): self {
		$this->total = $total;
		return $this;
	}
	
	/**
	 * @return mixed
	 */
	public function getStatus() {
		return $this->status;
	}
	
	/**
	 * @param mixed $status 
	 * @return self
	 */
	public function setStatus($status): self {
		$this->status = $status;
		return $this;
	}
	
	/**
	 * @return mixed
	 */
	public function getCreatedDate() {
		return $this->createdDate;
	}
	
	/**
	 * @param mixed $createdDate 
	 * @return self
	 */
	public function setCreatedDate($createdDate): self {
		$this->createdDate = $createdDate;
		return $this;
	}
	
	/**
	 * @return mixed
	 */
	public function getCanceledDate() {
		return $this->canceledDate;
	}
	
	/**
	 * @param mixed $canceledDate 
	 * @return self
	 */
	public function setCanceledDate($canceledDate): self {
		$this->canceledDate = $canceledDate;
		return $this;
	}
	
	/**
	 * @return mixed
	 */
	public function getCompletedDate() {
		return $this->completedDate;
	}
	
	/**
	 * @param mixed $completedDate 
	 * @return self
	 */
	public function setCompletedDate($completedDate): self {
		$this->completedDate = $completedDate;
		return $this;
	}
}
?>