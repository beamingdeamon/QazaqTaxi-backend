<?php
namespace PayGate\PayHost\types;

class BillingDetails {
	/**
	 * @var Customer
	 */
	public $Customer;
	/**
	 * @var Address
	 */
	public $Address;

	/**
	 * @return Customer
	 */
	public function getCustomer(){
		return $this->Customer;
	}

	/**
	 * @param Customer $Customer
	 *
	 * @return BillingDetails
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
	 * @return BillingDetails
	 */
	public function setAddress($Address){
		$this->Address = $Address;

		return $this;
	}

}