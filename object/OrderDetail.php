<?php
class orderDetail{
    private $customerName;
    private $orderId;
    private $productId;
    private $productName;
    private $quantity;
    private $price;
	private $size;
    function __construct($customerName, $orderId, $productId, $productName, $quantity, $price, $size) {
        $this->customerName = $customerName;
        $this->orderId = $orderId;
        $this->productId = $productId;
        $this->productName = $productName;
        $this->quantity = $quantity;
        $this->price = $price;
		$this->size = $size;
    
    }

	/**
	 * @return mixed
	 */
	public function getSize() {
		return $this->size;
	}
	
	/**
	 * @param mixed $size
	 * @return self
	 */
	/**
	 * @return mixed
	 */
	public function getCustomerName() {
		return $this->customerName;
	}
	
	/**
	 * @param mixed $customerName 
	 * @return self
	 */
	public function setCustomerName($customerName): self {
		$this->customerName = $customerName;
		return $this;
	}
	
	/**
	 * @return mixed
	 */
	public function getOrderId() {
		return $this->orderId;
	}
	
	/**
	 * @param mixed $orderId 
	 * @return self
	 */
	public function setOrderId($orderId): self {
		$this->orderId = $orderId;
		return $this;
	}
	
	/**
	 * @return mixed
	 */
	public function getProductId() {
		return $this->productId;
	}
	
	/**
	 * @param mixed $productId 
	 * @return self
	 */
	public function setProductId($productId): self {
		$this->productId = $productId;
		return $this;
	}
	
	/**
	 * @return mixed
	 */
	public function getProductName() {
		return $this->productName;
	}
	
	/**
	 * @param mixed $productName 
	 * @return self
	 */
	public function setProductName($productName): self {
		$this->productName = $productName;
		return $this;
	}
	
	/**
	 * @return mixed
	 */
	public function getQuantity() {
		return $this->quantity;
	}
	
	/**
	 * @param mixed $quantity 
	 * @return self
	 */
	public function setQuantity($quantity): self {
		$this->quantity = $quantity;
		return $this;
	}
	
	/**
	 * @return mixed
	 */
	public function getPrice() {
		return $this->price;
	}
	
	/**
	 * @param mixed $price 
	 * @return self
	 */
	public function setPrice($price): self {
		$this->price = $price;
		return $this;
	}
}

?>