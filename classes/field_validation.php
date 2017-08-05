<?php

/**
 * Controller for LSPF admin page
 */
class classes_field_validation {

	/**
	 * Retrieves a product
	 *
	 * @param int $store_id
	 * @return string
	 */
	public function validate_name($name) {
		return !empty($name);
	}

	/**
	 * Retrieves a product
	 *
	 * @param int $store_id
	 * @return string
	 */
	public function validate_sku($sku) {
		return !empty($sku);
	}

	/**
	 * Saves a product
	 *
	 * @param int $store_id
	 * @return array
	 */
	public function validate_price($price) {
		if (!empty($price)) {
			return preg_match('%^[+]?(?:[.]\d+|\d+(?:[.]\d+)?)$%', $price);
		}
		return false;
	}

}

?>