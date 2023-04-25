<?php
namespace PayGate\PayHost\types;

class Account {
	/**
	 * @var string
	 */
	public $PayGateId;
	/**
	 * @var string
	 */
	public $Password;

	/**
	 * @return string
	 */
	public function getPayGateId(){
		return $this->PayGateId;
	}

	/**
	 * @param string $PayGateId
	 *
	 * @return Account
	 */
	public function setPayGateId($PayGateId){
		$this->PayGateId = $PayGateId;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getPassword(){
		return $this->Password;
	}

	/**
	 * @param string $Password
	 *
	 * @return Account
	 */
	public function setPassword($Password){
		$this->Password = $Password;

		return $this;
	}
}