<?php
namespace PayGate\PayHost\types;

class OrderItems {
	public $ProductCode;
	public $ProductDescription;
	public $ProductCategory;
	public $ProductRisk;
	public $OrderQuantity;
	public $UnitPrice;
	public $Currency;

	/**
	 * @return mixed
	 */
	public function getProductCode(){
		return $this->ProductCode;
	}

	/**
	 * @param mixed $ProductCode
	 */
	public function setProductCode($ProductCode){
		$this->ProductCode = $ProductCode;
	}

	/**
	 * @return mixed
	 */
	public function getProductDescription(){
		return $this->ProductDescription;
	}

	/**
	 * @param mixed $ProductDescription
	 */
	public function setProductDescription($ProductDescription){
		$this->ProductDescription = $ProductDescription;
	}

	/**
	 * @return mixed
	 */
	public function getProductCategory(){
		return $this->ProductCategory;
	}

	/**
	 * @param mixed $ProductCategory
	 */
	public function setProductCategory($ProductCategory){
		$this->ProductCategory = $ProductCategory;
	}

	/**
	 * @return mixed
	 */
	public function getProductRisk(){
		return $this->ProductRisk;
	}

	/**
	 * @param mixed $ProductRisk
	 */
	public function setProductRisk($ProductRisk){
		$this->ProductRisk = $ProductRisk;
	}

	/**
	 * @return mixed
	 */
	public function getOrderQuantity(){
		return $this->OrderQuantity;
	}

	/**
	 * @param mixed $OrderQuantity
	 */
	public function setOrderQuantity($OrderQuantity){
		$this->OrderQuantity = $OrderQuantity;
	}

	/**
	 * @return mixed
	 */
	public function getUnitPrice(){
		return $this->UnitPrice;
	}

	/**
	 * @param mixed $UnitPrice
	 */
	public function setUnitPrice($UnitPrice){
		$this->UnitPrice = $UnitPrice;
	}

	/**
	 * @return mixed
	 */
	public function getCurrency(){
		return $this->Currency;
	}

	/**
	 * @param mixed $Currency
	 */
	public function setCurrency($Currency){
		$this->Currency = $Currency;
	}
}