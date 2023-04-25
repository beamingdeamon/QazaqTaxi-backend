<?php
namespace PayGate\PayHost\types;

class SinglePaymentRequest {
	/**
	 * @var WebPaymentRequest
	 */
	public $WebPaymentRequest;
	/**
	 * @var CardPaymentRequest
	 */
	public $CardPaymentRequest;

	/**
	 * @return WebPaymentRequest
	 */
	public function getWebPaymentRequest(){
		return $this->WebPaymentRequest;
	}

	/**
	 * @param WebPaymentRequest $WebPaymentRequest
	 *
	 * @return SinglePaymentRequest
	 */
	public function setWebPaymentRequest($WebPaymentRequest){
		$this->WebPaymentRequest = $WebPaymentRequest;

		return $this;
	}

	/**
	 * @return CardPaymentRequest
	 */
	public function getCardPaymentRequest(){
		return $this->CardPaymentRequest;
	}

	/**
	 * @param CardPaymentRequest $CardPaymentRequest
	 */
	public function setCardPaymentRequest($CardPaymentRequest){
		$this->CardPaymentRequest = $CardPaymentRequest;
	}
}