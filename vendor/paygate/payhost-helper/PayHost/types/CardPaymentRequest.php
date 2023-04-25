<?php
namespace PayGate\PayHost\types;

class CardPaymentRequest {
	/**
	 * @var Account
	 */
	public $Account;
	/**
	 * @var Customer
	 */
	public $Customer;
	/**
	 * @var string
	 */
	public $VaultId;
	/**
	 * @var string
	 */
	public $CardNumber;
	/**
	 * @var string
	 */
	public $CardExpiryDate;
	/**
	 * @var string
	 */
	public $CardIssueDate;
	/**
	 * @var string
	 */
	public $CardIssueNumber;
	/**
	 * @var string
	 */
	public $CVV;
	/**
	 * @var int
	 *
	 * 1 or 0
	 */
	public $Vault;
	/**
	 * @var string
	 */
	public $BudgetPeriod;
	/**
	 * @var Redirect
	 */
	public $Redirect;
	/**
	 * @var Order
	 */
	public $Order;
	/**
	 * @var ThreeDSecure
	 */
	public $ThreeDSecure;
	/**
	 * @var Risk
	 */
	public $Risk;
	/**
	 * @var array
	 */
	public $UserDefinedFields;
	/**
	 * @var string
	 */
	public $BillingDescriptor;

	/**
	 * @return Account
	 */
	public function getAccount(){
		return $this->Account;
	}

	/**
	 * @param Account $Account
	 *
	 * @return CardPaymentRequest
	 */
	public function setAccount($Account){
		$this->Account = $Account;

		return $this;
	}

	/**
	 * @return Customer
	 */
	public function getCustomer(){
		return $this->Customer;
	}

	/**
	 * @param Customer $Customer
	 *
	 * @return CardPaymentRequest
	 */
	public function setCustomer($Customer){
		$this->Customer = $Customer;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getVaultId(){
		return $this->VaultId;
	}

	/**
	 * @param string $VaultId
	 *
	 * @return CardPaymentRequest
	 */
	public function setVaultId($VaultId){
		$this->VaultId = $VaultId;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getCardNumber(){
		return $this->CardNumber;
	}

	/**
	 * @param string $CardNumber
	 *
	 * @return CardPaymentRequest
	 */
	public function setCardNumber($CardNumber){
		$this->CardNumber = $CardNumber;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getCardExpiryDate(){
		return $this->CardExpiryDate;
	}

	/**
	 * @param string $CardExpiryDate
	 *
	 * @return CardPaymentRequest
	 */
	public function setCardExpiryDate($CardExpiryDate){
		$this->CardExpiryDate = $CardExpiryDate;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getCardIssueDate(){
		return $this->CardIssueDate;
	}

	/**
	 * @param string $CardIssueDate
	 *
	 * @return CardPaymentRequest
	 */
	public function setCardIssueDate($CardIssueDate){
		$this->CardIssueDate = $CardIssueDate;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getCardIssueNumber(){
		return $this->CardIssueNumber;
	}

	/**
	 * @param string $CardIssueNumber
	 *
	 * @return CardPaymentRequest
	 */
	public function setCardIssueNumber($CardIssueNumber){
		$this->CardIssueNumber = $CardIssueNumber;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getCVV(){
		return $this->CVV;
	}

	/**
	 * @param string $CVV
	 *
	 * @return CardPaymentRequest
	 */
	public function setCVV($CVV){
		$this->CVV = $CVV;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getVault(){
		return $this->Vault;
	}

	/**
	 * @param int $Vault
	 *
	 * @return CardPaymentRequest
	 */
	public function setVault($Vault){
		$this->Vault = $Vault;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getBudgetPeriod(){
		return $this->BudgetPeriod;
	}

	/**
	 * @param string $BudgetPeriod
	 *
	 * @return CardPaymentRequest
	 */
	public function setBudgetPeriod($BudgetPeriod){
		$this->BudgetPeriod = $BudgetPeriod;

		return $this;
	}

	/**
	 * @return Redirect
	 */
	public function getRedirect(){
		return $this->Redirect;
	}

	/**
	 * @param Redirect $Redirect
	 *
	 * @return CardPaymentRequest
	 */
	public function setRedirect($Redirect){
		$this->Redirect = $Redirect;

		return $this;
	}

	/**
	 * @return Order
	 */
	public function getOrder(){
		return $this->Order;
	}

	/**
	 * @param Order $Order
	 *
	 * @return CardPaymentRequest
	 */
	public function setOrder($Order){
		$this->Order = $Order;

		return $this;
	}

	/**
	 * @return ThreeDSecure
	 */
	public function getThreeDSecure(){
		return $this->ThreeDSecure;
	}

	/**
	 * @param ThreeDSecure $ThreeDSecure
	 *
	 * @return CardPaymentRequest
	 */
	public function setThreeDSecure($ThreeDSecure){
		$this->ThreeDSecure = $ThreeDSecure;

		return $this;
	}

	/**
	 * @return Risk
	 */
	public function getRisk(){
		return $this->Risk;
	}

	/**
	 * @param Risk $Risk
	 *
	 * @return CardPaymentRequest
	 */
	public function setRisk($Risk){
		$this->Risk = $Risk;

		return $this;
	}

	/**
	 * @return array
	 */
	public function getUserDefinedFields(){
		return $this->UserDefinedFields;
	}

	/**
	 * @param array $UserDefinedFields
	 *
	 * @return CardPaymentRequest
	 */
	public function setUserDefinedFields($UserDefinedFields){
		$this->UserDefinedFields = $UserDefinedFields;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getBillingDescriptor(){
		return $this->BillingDescriptor;
	}

	/**
	 * @param string $BillingDescriptor
	 *
	 * @return CardPaymentRequest
	 */
	public function setBillingDescriptor($BillingDescriptor){
		$this->BillingDescriptor = $BillingDescriptor;

		return $this;
	}
}