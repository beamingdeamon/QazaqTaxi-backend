<?php
namespace PayGate\PayHost\types;

class Order {
	/**
	 * @var string
	 */
	public $MerchantOrderId;
	/**
	 * @var string
	 *
	 * ISO 3
	 */
	public $Currency;
	/**
	 * @var int
	 */
	public $Amount;
	/**
	 * @var int
	 */
	public $Discount;
	/**
	 * @var string
	 */
	public $TransactionDate;
	/**
	 * @var BillingDetails
	 */
	public $BillingDetails;
	/**
	 * @var ShippingDetails
	 */
	public $ShippingDetails;
	/**
	 * @var AirlineBookingDetails
	 */
	public $AirlineBookingDetails;
	/**
	 * @var array
	 */
	public $OrderItems;
	/**
	 * @var string
	 */
	public $Locale;

	/**
	 * @return string
	 */
	public function getMerchantOrderId(){
		return $this->MerchantOrderId;
	}

	/**
	 * @param string $MerchantOrderId
	 *
	 * @return Order
	 */
	public function setMerchantOrderId($MerchantOrderId){
		$this->MerchantOrderId = $MerchantOrderId;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getCurrency(){
		return $this->Currency;
	}

	/**
	 * @param string $Currency
	 *
	 * @return Order
	 */
	public function setCurrency($Currency){
		$this->Currency = $Currency;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getAmount(){
		return $this->Amount;
	}

	/**
	 * @param int $Amount
	 *
	 * @return Order
	 */
	public function setAmount($Amount){
		$this->Amount = $Amount;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getDiscount(){
		return $this->Discount;
	}

	/**
	 * @param int $Discount
	 *
	 * @return Order
	 */
	public function setDiscount($Discount){
		$this->Discount = $Discount;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getTransactionDate(){
		return $this->TransactionDate;
	}

	/**
	 * @param string $TransactionDate
	 *
	 * @return Order
	 */
	public function setTransactionDate($TransactionDate){
		$this->TransactionDate = $TransactionDate;

		return $this;
	}

	/**
	 * @return BillingDetails
	 */
	public function getBillingDetails(){
		return $this->BillingDetails;
	}

	/**
	 * @param BillingDetails $BillingDetails
	 *
	 * @return Order
	 */
	public function setBillingDetails($BillingDetails){
		$this->BillingDetails = $BillingDetails;

		return $this;
	}

	/**
	 * @return ShippingDetails
	 */
	public function getShippingDetails(){
		return $this->ShippingDetails;
	}

	/**
	 * @param ShippingDetails $ShippingDetails
	 *
	 * @return Order
	 */
	public function setShippingDetails($ShippingDetails){
		$this->ShippingDetails = $ShippingDetails;

		return $this;
	}

	/**
	 * @return AirlineBookingDetails
	 */
	public function getAirlineBookingDetails(){
		return $this->AirlineBookingDetails;
	}

	/**
	 * @param AirlineBookingDetails $AirlineBookingDetails
	 *
	 * @return Order
	 */
	public function setAirlineBookingDetails($AirlineBookingDetails){
		$this->AirlineBookingDetails = $AirlineBookingDetails;

		return $this;
	}

	/**
	 * @return array
	 */
	public function getOrderItems(){
		return $this->OrderItems;
	}

	/**
	 * @param array $OrderItems
	 *
	 * @return Order
	 */
	public function setOrderItems($OrderItems){
		$this->OrderItems = $OrderItems;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getLocale(){
		return $this->Locale;
	}

	/**
	 * @param string $Locale
	 *
	 * @return Order
	 */
	public function setLocale($Locale){
		$this->Locale = $Locale;

		return $this;
	}
}