<?php
namespace PayGate\PayHost\types;

class FlightLegs {
	/**
	 * @var string
	 */
	public $DepartureAirport;
	/**
	 * @var string
	 */
	public $DepartureCountry;
	/**
	 * @var string
	 */
	public $DepartureCity;
	/**
	 * @var string
	 */
	public $DepartureDateTime;
	/**
	 * @var string
	 */
	public $DepartureAirportTimeZone;
	/**
	 * @var string
	 */
	public $ArrivalAirport;
	/**
	 * @var string
	 */
	public $ArrivalCountry;
	/**
	 * @var string
	 */
	public $ArrivalCity;
	/**
	 * @var string
	 */
	public $ArrivalDateTime;
	/**
	 * @var string
	 */
	public $ArrivalAirportTimeZone;
	/**
	 * @var string
	 */
	public $MarketingCarrierCode;
	/**
	 * @var string
	 */
	public $MarketingCarrierName;
	/**
	 * @var string
	 */
	public $IssuingCarrierCode;
	/**
	 * @var string
	 */
	public $IssuingCarrierName;
	/**
	 * @var string
	 */
	public $FlightNumber;
	/**
	 * @var string
	 */
	public $FareBasisCode;
	/**
	 * @var string
	 */
	public $FareClass;
	/**
	 * @var string
	 */
	public $BaseFareAmount;
	/**
	 * @var string
	 */
	public $BaseFareCurrency;

	/**
	 * @return string
	 */
	public function getDepartureAirport(){
		return $this->DepartureAirport;
	}

	/**
	 * @param string $DepartureAirport
	 *
	 * @return FlightLegs
	 */
	public function setDepartureAirport($DepartureAirport){
		$this->DepartureAirport = $DepartureAirport;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getDepartureCountry(){
		return $this->DepartureCountry;
	}

	/**
	 * @param string $DepartureCountry
	 *
	 * @return FlightLegs
	 */
	public function setDepartureCountry($DepartureCountry){
		$this->DepartureCountry = $DepartureCountry;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getDepartureCity(){
		return $this->DepartureCity;
	}

	/**
	 * @param string $DepartureCity
	 *
	 * @return FlightLegs
	 */
	public function setDepartureCity($DepartureCity){
		$this->DepartureCity = $DepartureCity;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getDepartureDateTime(){
		return $this->DepartureDateTime;
	}

	/**
	 * @param string $DepartureDateTime
	 *
	 * @return FlightLegs
	 */
	public function setDepartureDateTime($DepartureDateTime){
		$this->DepartureDateTime = $DepartureDateTime;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getDepartureAirportTimeZone(){
		return $this->DepartureAirportTimeZone;
	}

	/**
	 * @param string $DepartureAirportTimeZone
	 *
	 * @return FlightLegs
	 */
	public function setDepartureAirportTimeZone($DepartureAirportTimeZone){
		$this->DepartureAirportTimeZone = $DepartureAirportTimeZone;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getArrivalAirport(){
		return $this->ArrivalAirport;
	}

	/**
	 * @param string $ArrivalAirport
	 *
	 * @return FlightLegs
	 */
	public function setArrivalAirport($ArrivalAirport){
		$this->ArrivalAirport = $ArrivalAirport;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getArrivalCountry(){
		return $this->ArrivalCountry;
	}

	/**
	 * @param string $ArrivalCountry
	 *
	 * @return FlightLegs
	 */
	public function setArrivalCountry($ArrivalCountry){
		$this->ArrivalCountry = $ArrivalCountry;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getArrivalCity(){
		return $this->ArrivalCity;
	}

	/**
	 * @param string $ArrivalCity
	 *
	 * @return FlightLegs
	 */
	public function setArrivalCity($ArrivalCity){
		$this->ArrivalCity = $ArrivalCity;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getArrivalDateTime(){
		return $this->ArrivalDateTime;
	}

	/**
	 * @param string $ArrivalDateTime
	 *
	 * @return FlightLegs
	 */
	public function setArrivalDateTime($ArrivalDateTime){
		$this->ArrivalDateTime = $ArrivalDateTime;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getArrivalAirportTimeZone(){
		return $this->ArrivalAirportTimeZone;
	}

	/**
	 * @param string $ArrivalAirportTimeZone
	 *
	 * @return FlightLegs
	 */
	public function setArrivalAirportTimeZone($ArrivalAirportTimeZone){
		$this->ArrivalAirportTimeZone = $ArrivalAirportTimeZone;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getMarketingCarrierCode(){
		return $this->MarketingCarrierCode;
	}

	/**
	 * @param string $MarketingCarrierCode
	 *
	 * @return FlightLegs
	 */
	public function setMarketingCarrierCode($MarketingCarrierCode){
		$this->MarketingCarrierCode = $MarketingCarrierCode;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getMarketingCarrierName(){
		return $this->MarketingCarrierName;
	}

	/**
	 * @param string $MarketingCarrierName
	 *
	 * @return FlightLegs
	 */
	public function setMarketingCarrierName($MarketingCarrierName){
		$this->MarketingCarrierName = $MarketingCarrierName;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getIssuingCarrierCode(){
		return $this->IssuingCarrierCode;
	}

	/**
	 * @param string $IssuingCarrierCode
	 *
	 * @return FlightLegs
	 */
	public function setIssuingCarrierCode($IssuingCarrierCode){
		$this->IssuingCarrierCode = $IssuingCarrierCode;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getIssuingCarrierName(){
		return $this->IssuingCarrierName;
	}

	/**
	 * @param string $IssuingCarrierName
	 *
	 * @return FlightLegs
	 */
	public function setIssuingCarrierName($IssuingCarrierName){
		$this->IssuingCarrierName = $IssuingCarrierName;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getFlightNumber(){
		return $this->FlightNumber;
	}

	/**
	 * @param string $FlightNumber
	 *
	 * @return FlightLegs
	 */
	public function setFlightNumber($FlightNumber){
		$this->FlightNumber = $FlightNumber;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getFareBasisCode(){
		return $this->FareBasisCode;
	}

	/**
	 * @param string $FareBasisCode
	 *
	 * @return FlightLegs
	 */
	public function setFareBasisCode($FareBasisCode){
		$this->FareBasisCode = $FareBasisCode;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getFareClass(){
		return $this->FareClass;
	}

	/**
	 * @param string $FareClass
	 *
	 * @return FlightLegs
	 */
	public function setFareClass($FareClass){
		$this->FareClass = $FareClass;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getBaseFareAmount(){
		return $this->BaseFareAmount;
	}

	/**
	 * @param string $BaseFareAmount
	 *
	 * @return FlightLegs
	 */
	public function setBaseFareAmount($BaseFareAmount){
		$this->BaseFareAmount = $BaseFareAmount;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getBaseFareCurrency(){
		return $this->BaseFareCurrency;
	}

	/**
	 * @param string $BaseFareCurrency
	 *
	 * @return FlightLegs
	 */
	public function setBaseFareCurrency($BaseFareCurrency){
		$this->BaseFareCurrency = $BaseFareCurrency;

		return $this;
	}



}