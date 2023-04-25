<?php
namespace PayGate\PayHost\types;

class Browser {
	/**
	 * @var string
	 */
	public $UserAgent;
	/**
	 * @var string
	 *
	 * according to RFC 1766
	 */
	public $Language;

	/**
	 * @return string
	 */
	public function getUserAgent(){
		return $this->UserAgent;
	}

	/**
	 * @param string $UserAgent
	 *
	 * @return Browser
	 */
	public function setUserAgent($UserAgent){
		$this->UserAgent = $UserAgent;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getLanguage(){
		return $this->Language;
	}

	/**
	 * @param string $Language
	 *
	 * @return Browser
	 */
	public function setLanguage($Language){
		$this->Language = $Language;

		return $this;
	}
}