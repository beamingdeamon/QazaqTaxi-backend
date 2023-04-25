<?php
namespace PayGate\PayHost\types;

class ThreeDSecure {
	/**
	 * @var string
	 */
	public $Enrolled;
	/**
	 * @var string
	 */
	public $Paresstatus;
	/**
	 * @var string
	 */
	public $Eci;
	/**
	 * @var string
	 */
	public $Xid;
	/**
	 * @var string
	 */
	public $Cavv;

	/**
	 * @return string
	 */
	public function getEnrolled(){
		return $this->Enrolled;
	}

	/**
	 * @param string $Enrolled
	 *
	 * @return ThreeDSecure
	 */
	public function setEnrolled($Enrolled){
		$this->Enrolled = $Enrolled;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getParesstatus(){
		return $this->Paresstatus;
	}

	/**
	 * @param string $Paresstatus
	 *
	 * @return ThreeDSecure
	 */
	public function setParesstatus($Paresstatus){
		$this->Paresstatus = $Paresstatus;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getEci(){
		return $this->Eci;
	}

	/**
	 * @param string $Eci
	 *
	 * @return ThreeDSecure
	 */
	public function setEci($Eci){
		$this->Eci = $Eci;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getXid(){
		return $this->Xid;
	}

	/**
	 * @param string $Xid
	 *
	 * @return ThreeDSecure
	 */
	public function setXid($Xid){
		$this->Xid = $Xid;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getCavv(){
		return $this->Cavv;
	}

	/**
	 * @param string $Cavv
	 *
	 * @return ThreeDSecure
	 */
	public function setCavv($Cavv){
		$this->Cavv = $Cavv;

		return $this;
	}
}