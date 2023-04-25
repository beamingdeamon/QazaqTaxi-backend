<?php
namespace PayGate\PayHost\types;

class Passengers {
	/**
	 * @var array
	 */
	public $Passenger;
	/**
	 * @var string
	 *
	 * possible values:
	 * A - Adult
	 * C - Child
	 * T - Teen
	 * I - Infant
	 */
	public $TravellerType;
	/**
	 * @var string
	 */
	public $LoyaltyNumber;
	/**
	 * @var string
	 */
	public $LoyaltyType;
	/**
	 * @var string
	 */
	public $LoyaltyTier;

	/**
	 * @return array
	 */
	public function getPassenger(){
		return $this->Passenger;
	}

	/**
	 * @param array $Passenger
	 *
	 * @return Passengers
	 */
	public function setPassenger($Passenger){
		$this->Passenger = $Passenger;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getTravellerType(){
		return $this->TravellerType;
	}

	/**
	 * @param string $TravellerType
	 *
	 * @return Passengers
	 */
	public function setTravellerType($TravellerType){
		$this->TravellerType = $TravellerType;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getLoyaltyNumber(){
		return $this->LoyaltyNumber;
	}

	/**
	 * @param string $LoyaltyNumber
	 *
	 * @return Passengers
	 */
	public function setLoyaltyNumber($LoyaltyNumber){
		$this->LoyaltyNumber = $LoyaltyNumber;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getLoyaltyType(){
		return $this->LoyaltyType;
	}

	/**
	 * @param string $LoyaltyType
	 *
	 * @return Passengers
	 */
	public function setLoyaltyType($LoyaltyType){
		$this->LoyaltyType = $LoyaltyType;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getLoyaltyTier(){
		return $this->LoyaltyTier;
	}

	/**
	 * @param string $LoyaltyTier
	 *
	 * @return Passengers
	 */
	public function setLoyaltyTier($LoyaltyTier){
		$this->LoyaltyTier = $LoyaltyTier;

		return $this;
	}


}