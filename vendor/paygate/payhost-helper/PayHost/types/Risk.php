<?php
namespace PayGate\PayHost\types;

class Risk {
	/**
	 * @var string
	 */
	public $AccountNumber;
	/**
	 * @var string
	 */
	public $SessionId;
	/**
	 * @var string
	 */
	public $IpV4Address;
	/**
	 * @var string
	 */
	public $IpV6Address;
	/**
	 * @var string
	 */
	public $UserId;
	/**
	 * @var string
	 */
	public $MachineId;
	/**
	 * @var string
	 */
	public $UserProfile;
	/**
	 * @var string
	 */
	public $ConsumerWatch;
	/**
	 * @var Browser
	 */
	public $Browser;

	/**
	 * @return string
	 */
	public function getAccountNumber(){
		return $this->AccountNumber;
	}

	/**
	 * @param string $AccountNumber
	 *
	 * @return Risk
	 */
	public function setAccountNumber($AccountNumber){
		$this->AccountNumber = $AccountNumber;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getSessionId(){
		return $this->SessionId;
	}

	/**
	 * @param string $SessionId
	 *
	 * @return Risk
	 */
	public function setSessionId($SessionId){
		$this->SessionId = $SessionId;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getIpV4Address(){
		return $this->IpV4Address;
	}

	/**
	 * @param string $IpV4Address
	 *
	 * @return Risk
	 */
	public function setIpV4Address($IpV4Address){
		$this->IpV4Address = $IpV4Address;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getIpV6Address(){
		return $this->IpV6Address;
	}

	/**
	 * @param string $IpV6Address
	 *
	 * @return Risk
	 */
	public function setIpV6Address($IpV6Address){
		$this->IpV6Address = $IpV6Address;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getUserId(){
		return $this->UserId;
	}

	/**
	 * @param string $UserId
	 *
	 * @return Risk
	 */
	public function setUserId($UserId){
		$this->UserId = $UserId;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getMachineId(){
		return $this->MachineId;
	}

	/**
	 * @param string $MachineId
	 *
	 * @return Risk
	 */
	public function setMachineId($MachineId){
		$this->MachineId = $MachineId;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getUserProfile(){
		return $this->UserProfile;
	}

	/**
	 * @param string $UserProfile
	 *
	 * @return Risk
	 */
	public function setUserProfile($UserProfile){
		$this->UserProfile = $UserProfile;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getConsumerWatch(){
		return $this->ConsumerWatch;
	}

	/**
	 * @param string $ConsumerWatch
	 *
	 * @return Risk
	 */
	public function setConsumerWatch($ConsumerWatch){
		$this->ConsumerWatch = $ConsumerWatch;

		return $this;
	}

	/**
	 * @return Browser
	 */
	public function getBrowser(){
		return $this->Browser;
	}

	/**
	 * @param Browser $Browser
	 *
	 * @return Risk
	 */
	public function setBrowser($Browser){
		$this->Browser = $Browser;

		return $this;
	}
}