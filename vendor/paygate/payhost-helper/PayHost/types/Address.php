<?php
namespace PayGate\PayHost\types;

class Address {
	/**
	 * @var array
	 */
	public $AddressLine;
	/**
	 * @var string
	 */
	public $City;
	/**
	 * @var string
	 *
	 * ISO 3
	 */
	public $Country;
	/**
	 * @var string
	 */
	public $State;
	/**
	 * @var string
	 */
	public $Zip;

	/**
	 * @return array
	 */
	public function getAddressLine(){
		return $this->AddressLine;
	}

	/**
	 * @param array $AddressLine
	 *
	 * @return Address
	 */
	public function setAddressLine($AddressLine){
		$this->AddressLine = $AddressLine;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getCity(){
		return $this->City;
	}

	/**
	 * @param string $City
	 *
	 * @return Address
	 */
	public function setCity($City){
		$this->City = $City;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getCountry(){
		return $this->Country;
	}

	/**
	 * @param string $Country
	 *
	 * @return Address
	 */
	public function setCountry($Country){
		$this->Country = $Country;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getState(){
		return $this->State;
	}

	/**
	 * @param string $State
	 *
	 * @return Address
	 */
	public function setState($State){
		$this->State = $State;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getZip(){
		return $this->Zip;
	}

	/**
	 * @param string $Zip
	 *
	 * @return Address
	 */
	public function setZip($Zip){
		$this->Zip = $Zip;

		return $this;
	}
}