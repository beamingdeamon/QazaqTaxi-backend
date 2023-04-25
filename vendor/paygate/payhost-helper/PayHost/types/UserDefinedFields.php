<?php
namespace PayGate\PayHost\types;

class UserDefinedFields {
	/**
	 * @var string
	 */
	public $key;
	/**
	 * @var string
	 */
	public $value;

	/**
	 * @return string
	 */
	public function getKey(){
		return $this->key;
	}

	/**
	 * @param string $key
	 *
	 * @return UserDefinedFields
	 */
	public function setKey($key){
		$this->key = $key;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getValue(){
		return $this->value;
	}

	/**
	 * @param string $value
	 *
	 * @return UserDefinedFields
	 */
	public function setValue($value){
		$this->value = $value;

		return $this;
	}


}