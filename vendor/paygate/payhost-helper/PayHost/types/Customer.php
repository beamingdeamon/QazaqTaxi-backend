<?php
namespace PayGate\PayHost\types;

class Customer {
	/**
	 * @var string
	 */
	public $Title;
	/**
	 * @var string
	 */
	public $FirstName;
	/**
	 * @var string
	 */
	public $MiddleName;
	/**
	 * @var string
	 */
	public $LastName;
	/**
	 * @var string
	 */
	public $Telephone;
	/**
	 * @var string
	 */
	public $Mobile;
	/**
	 * @var string
	 */
	public $Fax;
	/**
	 * @var string
	 */
	public $Email;
	/**
	 * @var string
	 */
	public $DateOfBirth;
	/**
	 * @var string
	 */
	public $Nationality;
	/**
	 * @var string
	 */
	public $IdNumber;
	/**
	 * @var string
	 */
	public $IdType;
	/**
	 * @var string
	 */
	public $SocialSecurityNumber;
	/**
	 * @var Address
	 */
	public $Address;

	/**
	 * @return string
	 */
	public function getTitle(){
		return $this->Title;
	}

	/**
	 * @param string $Title
	 *
	 * @return Customer
	 */
	public function setTitle($Title){
		$this->Title = $Title;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getFirstName(){
		return $this->FirstName;
	}

	/**
	 * @param string $FirstName
	 *
	 * @return Customer
	 */
	public function setFirstName($FirstName){
		$this->FirstName = $FirstName;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getMiddleName(){
		return $this->MiddleName;
	}

	/**
	 * @param string $MiddleName
	 *
	 * @return Customer
	 */
	public function setMiddleName($MiddleName){
		$this->MiddleName = $MiddleName;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getLastName(){
		return $this->LastName;
	}

	/**
	 * @param string $LastName
	 *
	 * @return Customer
	 */
	public function setLastName($LastName){
		$this->LastName = $LastName;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getTelephone(){
		return $this->Telephone;
	}

	/**
	 * @param string $Telephone
	 *
	 * @return Customer
	 */
	public function setTelephone($Telephone){
		$this->Telephone = $Telephone;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getMobile(){
		return $this->Mobile;
	}

	/**
	 * @param string $Mobile
	 *
	 * @return Customer
	 */
	public function setMobile($Mobile){
		$this->Mobile = $Mobile;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getFax(){
		return $this->Fax;
	}

	/**
	 * @param string $Fax
	 *
	 * @return Customer
	 */
	public function setFax($Fax){
		$this->Fax = $Fax;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getEmail(){
		return $this->Email;
	}

	/**
	 * @param string $Email
	 *
	 * @return Customer
	 */
	public function setEmail($Email){
		$this->Email = $Email;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getDateOfBirth(){
		return $this->DateOfBirth;
	}

	/**
	 * @param string $DateOfBirth
	 *
	 * @return Customer
	 */
	public function setDateOfBirth($DateOfBirth){
		$this->DateOfBirth = $DateOfBirth;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getNationality(){
		return $this->Nationality;
	}

	/**
	 * @param string $Nationality
	 *
	 * @return Customer
	 */
	public function setNationality($Nationality){
		$this->Nationality = $Nationality;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getIdNumber(){
		return $this->IdNumber;
	}

	/**
	 * @param string $IdNumber
	 *
	 * @return Customer
	 */
	public function setIdNumber($IdNumber){
		$this->IdNumber = $IdNumber;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getIdType(){
		return $this->IdType;
	}

	/**
	 * @param string $IdType
	 *
	 * @return Customer
	 */
	public function setIdType($IdType){
		$this->IdType = $IdType;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getSocialSecurityNumber(){
		return $this->SocialSecurityNumber;
	}

	/**
	 * @param string $SocialSecurityNumber
	 *
	 * @return Customer
	 */
	public function setSocialSecurityNumber($SocialSecurityNumber){
		$this->SocialSecurityNumber = $SocialSecurityNumber;

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
	 * @return Customer
	 */
	public function setAddress($Address){
		$this->Address = $Address;

		return $this;
	}
}