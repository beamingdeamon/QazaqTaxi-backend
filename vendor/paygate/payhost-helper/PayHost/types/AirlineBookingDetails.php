<?php
namespace PayGate\PayHost\types;

class AirlineBookingDetails {
	/**
	 * @var string
	 */
	public $TicketNumber;
	/**
	 * @var string
	 */
	public $InternalCustomerCode;
	/**
	 * @var string
	 */
	public $ReservationSystem;
	/**
	 * @var string
	 */
	public $TravelAgencyCode;
	/**
	 * @var string
	 */
	public $TravelAgencyName;
	/**
	 * @var string
	 */
	public $PayerTravelling;
	/**
	 * @var string
	 */
	public $PNR;
	/**
	 * @var Passengers
	 */
	public $Passengers;
	/**
	 * @var array
	 */
	public $FlightLegs;

	/**
	 * @return string
	 */
	public function getTicketNumber(){
		return $this->TicketNumber;
	}

	/**
	 * @param string $TicketNumber
	 *
	 * @return AirlineBookingDetails
	 */
	public function setTicketNumber($TicketNumber){
		$this->TicketNumber = $TicketNumber;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getInternalCustomerCode(){
		return $this->InternalCustomerCode;
	}

	/**
	 * @param string $InternalCustomerCode
	 *
	 * @return AirlineBookingDetails
	 */
	public function setInternalCustomerCode($InternalCustomerCode){
		$this->InternalCustomerCode = $InternalCustomerCode;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getReservationSystem(){
		return $this->ReservationSystem;
	}

	/**
	 * @param string $ReservationSystem
	 *
	 * @return AirlineBookingDetails
	 */
	public function setReservationSystem($ReservationSystem){
		$this->ReservationSystem = $ReservationSystem;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getTravelAgencyCode(){
		return $this->TravelAgencyCode;
	}

	/**
	 * @param string $TravelAgencyCode
	 *
	 * @return AirlineBookingDetails
	 */
	public function setTravelAgencyCode($TravelAgencyCode){
		$this->TravelAgencyCode = $TravelAgencyCode;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getTravelAgencyName(){
		return $this->TravelAgencyName;
	}

	/**
	 * @param string $TravelAgencyName
	 *
	 * @return AirlineBookingDetails
	 */
	public function setTravelAgencyName($TravelAgencyName){
		$this->TravelAgencyName = $TravelAgencyName;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getPayerTravelling(){
		return $this->PayerTravelling;
	}

	/**
	 * @param string $PayerTravelling
	 *
	 * @return AirlineBookingDetails
	 */
	public function setPayerTravelling($PayerTravelling){
		$this->PayerTravelling = $PayerTravelling;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getPNR(){
		return $this->PNR;
	}

	/**
	 * @param string $PNR
	 *
	 * @return AirlineBookingDetails
	 */
	public function setPNR($PNR){
		$this->PNR = $PNR;

		return $this;
	}

	/**
	 * @return Passengers
	 */
	public function getPassengers(){
		return $this->Passengers;
	}

	/**
	 * @param Passengers $Passengers
	 *
	 * @return AirlineBookingDetails
	 */
	public function setPassengers($Passengers){
		$this->Passengers = $Passengers;

		return $this;
	}

	/**
	 * @return array
	 */
	public function getFlightLegs(){
		return $this->FlightLegs;
	}

	/**
	 * @param array $FlightLegs
	 *
	 * @return AirlineBookingDetails
	 */
	public function setFlightLegs($FlightLegs){
		$this->FlightLegs = $FlightLegs;

		return $this;
	}

}