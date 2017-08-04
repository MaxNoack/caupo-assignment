<?php

/**
 * Controller for LSPF admin page
 */
class classes_api_connection {
	/**
	 * @var Admin_Agent_CompanyInfoRepository
	 */
	private $something;

	/**
	 * Constructor
	 *
	 * @param Net_Http_Request|null $request
	 * @param prisjakt_mysqli|null  $db
	 * @param string				$wrapper
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
	public function get_product() {
		echo("this is the api connection talking: ");
		$curl = curl_init();
		$url = 'http://lab.magento2.caupo.se/index.php/rest/V1/integration/admin/token';
		//curl_setopt($curl, CURLOPT_GET, true);
		//curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		//curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($curl, CURLOPT_USERPWD, "demo:demo123");

		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		$result = curl_exec($curl);

		curl_close($curl);

		echo $result;
	}

	/**
	 * Saves a product
	 *
	 * @param int $store_id
	 * @return array
	 */
	public function save_product() {

	}

	/**
	 * Deletes a product
	 *
	 * @param int $store_id
	 * @return array
	 */
	public function delete_product() {
		return true;
	}
}

?>