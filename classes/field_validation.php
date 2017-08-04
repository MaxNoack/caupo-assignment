<?php

/**
 * Controller for LSPF admin page
 */
class classes_field_validation {
	/**
	 * @var Admin_Agent_CompanyInfoRepository
	 */
	private $something;

	/**
     * Constructor
     *
	 * @param Net_Http_Request|null $request
	 * @param prisjakt_mysqli|null  $db
	 * @param string                $wrapper
	 */
	public function __construct() {
		//some code
	}

	/**
	 * Retrieves a product
	 *
	 * @param int $store_id
	 * @return string
	 */
	public function validate_sku() {
		return true;
	}

	/**
	 * Saves a product
	 *
	 * @param int $store_id
	 * @return array
	 */
	public function validate_price() {
		return true;
	}

}

?>