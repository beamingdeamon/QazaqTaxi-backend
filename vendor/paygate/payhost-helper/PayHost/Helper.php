<?php
namespace PayGate\PayHost;

/**
 * Class Helper
 *
 * @package PayGate\PayHost
 */
class Helper {
	/**
	 * @var array
	 *
	 * example of input map:
	 *
	 * $inputMap = array(
			'Account'               => array(
			'PayGateId' => 'pgid',
			'Password'  => 'encryptionKey'
		),
		'Customer'              => array(
			'Title'                => 'customerTitle',
			'FirstName'            => 'firstName',
			'MiddleName'           => 'middleName',
			'LastName'             => 'lastName',
			'Telephone'            => 'telephone',
			'Mobile'               => 'mobile',
			'Fax'                  => 'fax',
			'Email'                => 'email',
			'DateOfBirth'          => 'dateOfBirth',
			'SocialSecurityNumber' => 'socialSecurity'
		),
		'Address'               => array(
			'AddressLine' => 'addressLine',
			'City'        => 'city',
			'Country'     => 'country',
			'State'       => 'state',
			'Zip'         => 'zip'
		),
		'PaymentType'           => array(
			'Method' => 'payMethod',
			'Detail' => 'payMethodDetail'
		),
		'Redirect'              => array(
			'NotifyUrl' => 'notifyURL',
			'ReturnUrl' => 'retUrl',
			'Target'    => 'target'
		),
		'ShippingDetails'       => array(
			'DeliveryDate'          => 'deliveryDate',
			'DeliveryMethod'        => 'deliveryMethod',
			'InstallationRequested' => 'installRequired'
		),
		'Order'                 => array(
			'MerchantOrderId' => 'reference',
			'Currency'        => 'currency',
			'Amount'          => 'amount',
			'Discount'        => null,
			'TransactionDate' => 'transDate',
			'Locale'          => 'locale'
		),
		'ThreeDSecure'          => array(
			'Enrolleed'   => null,
			'Paresstatus' => null,
			'Eci'         => null
		),
		'Risk'                  => array(
			'AccountNumber' => 'riskAccNum',
			'SessionId'     => null,
			'IpV4Address'   => 'riskIpAddr',
			'IpV6Address'   => null,
			'UserId'        => null,
			'MachineId'     => null,
			'UserProfile'   => null,
			'ConsumerWatch' => null,
			'Browser'       => null
		),
		'UserDefinedFields'     => array(
			'key'   => 'userKey',
			'value' => 'userField'
		),
		'WebPaymentRequest'     => array(
			'BillingDescriptor' => null
		),
		'CardPaymentRequest' => array(
			'CardNumber' => null,
			'CardExpiryDate' => null,
		),
		'AirlineBookingDetails' => array(
			'TicketNumber'         => 'ticketNumber',
			'InternalCustomerCode' => null,
			'ReservationSystem'    => null,
			'TravelAgencyCode'     => null,
			'TravelAgencyName'     => null,
			'PayerTravelling'      => null,
			'PNR'                  => null
		),
		'Passengers'            => array(
			'Passenger'     => null,
			'TravellerType' => 'travellerType',
			'LoyaltyNumber' => null,
			'LoyaltyType'   => null,
			'LoyaltyTier'   => null
		),
		'FlightLegs'            => array(
			'DepartureAirport'         => 'departureAirport',
			'DepartureCountry'         => 'departureCountry',
			'DepartureCity'            => 'departureCity',
			'DepartureDateTime'        => 'departureDateTime',
			'DepartureAirportTimeZone' => null,
			'ArrivalAirport'           => 'arrivalAirport',
			'ArrivalCountry'           => 'arrivalCountry',
			'ArrivalCity'              => 'arrivalCity',
			'ArrivalDateTime'          => 'arrivalDateTime',
			'ArrivalAirportTimeZone'   => null,
			'MarketingCarrierCode'     => 'marketingCarrierCode',
			'MarketingCarrierName'     => 'marketingCarrierName',
			'IssuingCarrierCode'       => 'issuingCarrierCode',
			'IssuingCarrierName'       => 'issuingCarrierName',
			'FlightNumber'             => 'flightNumber',
			'FareBasisCode'            => null,
			'FareClass'                => null,
			'BaseFareAmount'           => null,
			'BaseFareCurrency'         => null
		)
	);
	 */
	public $inputMap;
	/**
	 * @var string
	 */
	private static $ns = 'ns1';
	/**
	 * @var types\SinglePaymentRequest
	 */
	private $SinglePaymentRequest;
	/**
	 * @var types\CardPaymentRequest
	 */
	private $CardPaymentRequest;
	/**
	 * @var types\WebPaymentRequest
	 */
	private $WebPaymentRequest;
	/**
	 * @var types\Account
	 */
	private $Account;
	/**
	 * @var types\Address
	 */
	private $Address;
	/**
	 * @var types\Customer
	 */
	private $Customer;
	/**
	 * @var types\PaymentType
	 */
	private $PaymentType;
	/**
	 * @var types\Redirect
	 */
	private $Redirect;
	/**
	 * @var types\Order
	 */
	private $Order;
	/**
	 * @var array
	 */
	private $OrderItems;
	/**
	 * @var types\Risk
	 */
	private $Risk;
	/**
	 * @var array
	 */
	private $UserDefinedFields;
	/**
	 * @var types\BillingDetails
	 */
	private $BillingDetails;
	/**
	 * @var types\ShippingDetails
	 */
	private $ShippingDetails;
	/**
	 * @var array
	 */
	private $FlightLegs;
	/**
	 * @var types\Passengers
	 */
	private $Passengers;
	/**
	 * @var types\AirlineBookingDetails
	 */
	private $AirlineBookingDetails;

	public function __construct($inputMap){
		$this->inputMap = $inputMap;
	}

	private static function object_empty($obj){
		if(is_object($obj)){
			foreach($obj as $item){
				if($item != null){
					return false;
				}
			}
			return true;
		}

		return true;
	}

	public function setWebPaymentRequestMessage($post){
		$this->setWebPaymentRequest($post)
		     ->setSinglePaymentRequest('WebPaymentRequest');

		return $this->getSinglePaymentRequest();
	}

	public function setCardPaymentRequestMessage($post){
		$this->setCardPaymentRequest($post)
			 ->setSinglePaymentRequest('CardPaymentRequest');

		return $this->getSinglePaymentRequest();
	}

	/**
	 * @param array  $post
	 * @param mixed  $Class
	 * @param string $var
	 * @param string $input
	 */
	private function setLocalVar($post, $Class, $var, $input){
		if(!empty($input)){
			if(!empty($post[$input])){
				$method = "set$var";
				$Class->{$method}($post[$input]);
			}
		}
	}

	private function setAccount(array $post){
		$Account = new types\Account();
		foreach($this->inputMap['Account'] as $var => $input){
			self::setLocalVar($post, $Account, $var, $input);
		}

		$this->Account = $Account;

		return $this;
	}

	private function setAddress(array $post){
		$addressLines = array();

		for($i = 1; !empty($post['addressLine' . $i]); $i ++){
			$addressLines[] = $post['addressLine' . $i];
		}

		$Address = new types\Address();
		if(count($addressLines) > 0){
			$Address->setAddressLine($addressLines);
		}

		foreach($this->inputMap['Address'] as $var => $input){
			if($var != 'AddressLine'){
				self::setLocalVar($post, $Address, $var, $input);
			}
		}

		$this->Address = $Address;

		return $this;
	}

	private function setCustomer(array $post){
		$Customer = new types\Customer();

		foreach($this->inputMap['Customer'] as $var => $input){
			self::setLocalVar($post, $Customer, $var, $input);
		}

		$this->setAddress($post);
		if(!self::object_empty($this->Address)){
			$Customer->setAddress($this->Address);
		}

		$this->Customer = $Customer;

		return $this;
	}

	private function setPaymentType(array $post){

		if(!empty($post[$this->inputMap['PaymentType']['Method']]) || !empty($post[$this->inputMap['PaymentType']['Detail']])){

			$PaymentType = new types\PaymentType();

			foreach($this->inputMap['PaymentType'] as $var => $input){
				self::setLocalVar($post, $PaymentType, $var, $input);
			}

			$this->PaymentType = $PaymentType;
		}

		return $this;
	}

	private function setRedirect(array $post){
		$Redirect = new types\Redirect();

		foreach($this->inputMap['Redirect'] as $var => $input){
			self::setLocalVar($post, $Redirect, $var, $input);
		}

		$this->Redirect = $Redirect;

		return $this;
	}

	private function setOrder(array $post){
		$Order = new types\Order();

		foreach($this->inputMap['Order'] as $var => $input){
			self::setLocalVar($post, $Order, $var, $input);
		}

		$this->setBillingDetails($post);
		if(!self::object_empty($this->BillingDetails)){
			$Order->setBillingDetails($this->BillingDetails);
		}

		$this->setShippingDetails($post);
		if(!self::object_empty($this->ShippingDetails)){
			$Order->setShippingDetails($this->ShippingDetails);
		}

		$this->setAirlineBookingDetails($post);
		if(!self::object_empty($this->AirlineBookingDetails)){
			$Order->setAirlineBookingDetails($this->AirlineBookingDetails);
		}
		$this->setOrderItems($post);
		if(!self::object_empty($this->OrderItems)){
			$Order->setOrderItems($this->OrderItems);
		}

		$this->Order = $Order;

		return $this;
	}

	private function setOrderItems(array $post){
		return $this;
	}

	private function setUserDefinedFields(array $post){
		for($i=1; !empty($post[$this->inputMap['UserDefinedFields']['key'] . $i]) && !empty($post[$this->inputMap['UserDefinedFields']['value'] . $i]); $i++){
			$UserDefinedFields = new types\UserDefinedFields();
			$UserDefinedFields->setKey($post[$this->inputMap['UserDefinedFields']['key'] . $i])
			                  ->setValue($post[$this->inputMap['UserDefinedFields']['value'] . $i]);

			$this->UserDefinedFields[] = $UserDefinedFields;
		}

		return $this;
	}

	private function setBillingDetails(array $post){
		if(!empty($post['incBilling'])){
			$BillingDetails = new types\BillingDetails();

			$BillingDetails->setCustomer($this->Customer)
			               ->setAddress($this->Address);

			$this->BillingDetails = $BillingDetails;
		}

		return $this;
	}

	private function setShippingDetails(array $post){
		if(!empty($post['incShipping'])){
			$ShippingDetails = new types\ShippingDetails();

			$ShippingDetails->setCustomer($this->Customer)
							->setAddress($this->Address);

			foreach($this->inputMap['ShippingDetails'] as $var => $input){
				self::setLocalVar($post, $ShippingDetails, $var, $input);
			}

			$this->ShippingDetails = $ShippingDetails;
		}

		return $this;
	}

	private function setAirlineBookingDetails(array $post){
		$AirlineBookingDetails = new types\AirlineBookingDetails();

		foreach($this->inputMap['AirlineBookingDetails'] as $var => $input){
			self::setLocalVar($post, $AirlineBookingDetails, $var, $input);
		}

		$this->setPassengers($post);

		if(!self::object_empty($this->Passengers)){
			$AirlineBookingDetails->setPassengers($this->Passengers);
		}

		$this->setFlightLegs($post);
		if(!self::object_empty($this->FlightLegs)){
			$AirlineBookingDetails->setFlightLegs($this->FlightLegs);
		}

		$this->AirlineBookingDetails = $AirlineBookingDetails;

		return $this;
	}

	private function setFlightLegs(array $post){
		$FlightLegs = new types\FlightLegs();

		foreach($this->inputMap['FlightLegs'] as $var => $input){
			self::setLocalVar($post, $FlightLegs, $var, $input);
		}

		$this->FlightLegs[] = $FlightLegs;

		return $this;
	}

	private function setPassengers(array $post){
		$Passengers = new types\Passengers();

		foreach($this->inputMap['Passengers'] as $var => $input){
			self::setLocalVar($post, $Passengers, $var, $input);
		}

		$this->Passengers = $Passengers;

		return $this;
	}

	private function setWebPaymentRequest($post){
		$this->setAccount($post)
		     ->setCustomer($post)
		     ->setPaymentType($post)
		     ->setRedirect($post)
		     ->setOrder($post);

		$WebPaymentRequest = new types\WebPaymentRequest();

		$WebPaymentRequest->setAccount($this->Account)
		                  ->setCustomer($this->Customer);
		if(!empty($this->PaymentType)){
			$WebPaymentRequest->setPaymentType($this->PaymentType);
		}
		if(!empty($this->Redirect)){
			$WebPaymentRequest->setRedirect($this->Redirect);
		}

		$WebPaymentRequest->setOrder($this->Order);

		if(!empty($this->Risk)){
			$WebPaymentRequest->setRisk($this->Risk);
		}

		$this->setUserDefinedFields($post);
		if(!empty($this->UserDefinedFields)){
			$WebPaymentRequest->setUserDefinedFields($this->UserDefinedFields);
		}

		$this->WebPaymentRequest = $WebPaymentRequest;

		return $this;
	}

	private function setCardPaymentRequest($post){
		$this->setAccount($post)
		     ->setCustomer($post)
		     ->setPaymentType($post)
		     ->setRedirect($post)
		     ->setOrder($post);

		$CardPaymentRequest = new types\CardPaymentRequest();

		$CardPaymentRequest->setAccount($this->Account)
		                   ->setCustomer($this->Customer);

		foreach($this->inputMap['CardPaymentRequest'] as $var => $input){
			self::setLocalVar($post, $CardPaymentRequest, $var, $input);
		}

		$CardPaymentRequest->setRedirect($this->Redirect)
		                   ->setOrder($this->Order);

		$this->CardPaymentRequest = $CardPaymentRequest;

		return $this;
	}

	private function setSinglePaymentRequest($type){
		$SinglePaymentRequest = new types\SinglePaymentRequest();

		$call = "set$type";

		$SinglePaymentRequest->{$call}($this->{$type});

		$this->SinglePaymentRequest = $SinglePaymentRequest;

		return $this;
	}

	// functions adopted from http://www.sean-barton.co.uk/2009/03/turning-an-array-or-object-into-xml-using-php/

	public static function generateValidXmlFromObj($obj, $node_block = '', $node_name = ''){
		$arr = get_object_vars($obj);

		return self::generateValidXmlFromArray($arr, $node_block, $node_name);
	}

	public static function generateValidXmlFromArray($array, $node_block = '', $node_name = ''){
		$xml = '<' . self::$ns . ':' . $node_block . '>'. PHP_EOL;
		$xml .= self::generateXmlFromArray($array, $node_name) . PHP_EOL;
		$xml .= '</' . self::$ns . ':' . $node_block . '>' . PHP_EOL;

		return $xml;
	}

	private static function generateXmlFromArray($array, $node_name){
		$xml = '';

		if(is_array($array) || is_object($array)){
			foreach($array as $key => $value){
				if(is_array($value)){
					foreach($value as $item){
						$xml .= '<' . self::$ns . ':' . $key . '>' . self::generateXmlFromArray($item, $node_name) . '</' . self::$ns . ':' . $key . '>';
					}
				} else

					if(!empty($value)){
						$xml .= '<' . self::$ns . ':' . $key . '>' . self::generateXmlFromArray($value, $node_name) . '</' . self::$ns . ':' . $key . '>';
					}
			}
		} else {
			$xml = htmlspecialchars($array, ENT_QUOTES);
		}

		return $xml;
	}

	/**
	 * @return mixed
	 */
	public function getSinglePaymentRequest(){
		return $this->SinglePaymentRequest;
	}

	/**
	 * @return types\Account
	 */
	public function getAccount(){
		return $this->Account;
	}

	/**
	 * @return types\Address
	 */
	public function getAddress(){
		return $this->Address;
	}

	/**
	 * @return types\Customer
	 */
	public function getCustomer(){
		return $this->Customer;
	}

	/**
	 * @return types\PaymentType
	 */
	public function getPaymentType(){
		return $this->PaymentType;
	}

	/**
	 * @return types\WebPaymentRequest
	 */
	public function getWebPaymentRequest(){
		return $this->WebPaymentRequest;
	}

	/**
	 * @return types\Redirect
	 */
	public function getRedirect(){
		return $this->Redirect;
	}

	/**
	 * @return types\Order
	 */
	public function getOrder(){
		return $this->Order;
	}

	/**
	 * @return array of OrderItems
	 */
	public function getOrderItems(){
		return $this->OrderItems;
	}

	/**
	 * @return types\Risk
	 */
	public function getRisk(){
		return $this->Risk;
	}

	/**
	 * @return array
	 */
	public function getUserDefinedFields(){
		return $this->UserDefinedFields;
	}

	/**
	 * @return types\BillingDetails
	 */
	public function getBillingDetails(){
		return $this->BillingDetails;
	}

	/**
	 * @return types\ShippingDetails
	 */
	public function getShippingDetails(){
		return $this->ShippingDetails;
	}

	/**
	 * @return array of FlightLegs
	 */
	public function getFlightLegs(){
		return $this->FlightLegs;
	}

	/**
	 * @return types\Passengers
	 */
	public function getPassengers(){
		return $this->Passengers;
	}

	/**
	 * @return types\AirlineBookingDetails
	 */
	public function getAirlineBookingDetails(){
		return $this->AirlineBookingDetails;
	}

}