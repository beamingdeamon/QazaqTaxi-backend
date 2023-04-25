<?php
namespace PayGate\PayHost\types;

class PaymentType {
	/**
	 * @var string
	 *
	 * possible values:
	 * CC - Credit Card
	 * DC - Debit Card
	 * EW - e-Wallet
	 * BT - Bank Transfer
	 * CV - Cash Voucher
	 * PC - Pre-Paid Card
	 */
	public $Method;
	/**
	 * @var string
	 */
	public $Detail;

	/**
	 * @return string
	 */
	public function getMethod(){
		return $this->Method;
	}

	/**
	 * @param string $Method
	 *
	 * @return PaymentType
	 */
	public function setMethod($Method){
		$this->Method = $Method;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getDetail(){
		return $this->Detail;
	}

	/**
	 * @param string $Detail
	 *
	 * @return PaymentType
	 */
	public function setDetail($Detail){
		$this->Detail = $Detail;

		return $this;
	}

}