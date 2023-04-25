<?php
namespace PayGate\PayHost\types;

class Redirect {
	/**
	 * @var string
	 */
	public $NotifyUrl;
	/**
	 * @var string
	 */
	public $ReturnUrl;
	/**
	 * @var string
	 */
	public $Target;

	/**
	 * @return string
	 */
	public function getNotifyUrl(){
		return $this->NotifyUrl;
	}

	/**
	 * @param string $NotifyUrl
	 *
	 * @return Redirect
	 */
	public function setNotifyUrl($NotifyUrl){
		$this->NotifyUrl = $NotifyUrl;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getReturnUrl(){
		return $this->ReturnUrl;
	}

	/**
	 * @param string $ReturnUrl
	 *
	 * @return Redirect
	 */
	public function setReturnUrl($ReturnUrl){
		$this->ReturnUrl = $ReturnUrl;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getTarget(){
		return $this->Target;
	}

	/**
	 * @param string $Target
	 *
	 * @return Redirect
	 */
	public function setTarget($Target){
		$this->Target = $Target;

		return $this;
	}

}