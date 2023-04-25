<?php
namespace PayGate\PayHost\types;

class ShippingDetails {
	/**
	 * @var Customer
	 */
	public $Customer;
	/**
	 * @var Address
	 */
	public $Address;
	/**
	 * @var string
	 */
	public $DeliveryDate;
	/**
	 * @var string
	 */
	public $DeliveryMethod;
	/**
	 * @var string
	 */
	public $InstallationRequested;

	/**
	 * @return Customer
	 */
	public function getCustomer(){
		return $this->Customer;
	}

	/**
	 * @param Customer $Customer
	 *
	 * @return ShippingDetails
	 */
	public function setCustomer($Customer){
		$this->Customer = $Customer;

		return $this;
	}

	/**
	 * @return Address
	 */
	public function getAddress(){
		return $this->Address;
	}

	/**
	 * @param Address $Address
	 *
	 * @return ShippingDetails
	 */
	public function setAddress($Address){
		$this->Address = $Address;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getDeliveryDate(){
		return $this->DeliveryDate;
	}

	/**
	 * @param string $DeliveryDate
	 *
	 * @return ShippingDetails
	 */
	public function setDeliveryDate($DeliveryDate){
		$this->DeliveryDate = $DeliveryDate;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getDeliveryMethod(){
		return $this->DeliveryMethod;
	}

	/**
	 * @param string $DeliveryMethod
	 *
	 * @return ShippingDetails
	 */
	public function setDeliveryMethod($DeliveryMethod){
		$this->DeliveryMethod = $DeliveryMethod;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getInstallationRequested(){
		return $this->InstallationRequested;
	}

	/**
	 * @param string $InstallationRequested
	 *
	 * @return ShippingDetails
	 */
	public function setInstallationRequested($InstallationRequested){
		$this->InstallationRequested = $InstallationRequested;

		return $this;
	}
}