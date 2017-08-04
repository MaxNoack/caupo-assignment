<?php

/**
 * Controller for LSPF admin page
 */
class classes_api_connection {
	/**
	 * @var Admin_Agent_CompanyInfoRepository
	 */
	protected $admin_url;
	protected $user_name;
	protected $password;

	/**
	 * Constructor
	 *
	 * @param Net_Http_Request|null $request
	 * @param prisjakt_mysqli|null  $db
	 * @param string				$wrapper
	 */
	public function __construct($admin_url, $user_name, $password) {
		$this->admin_url = $admin_url;
		$this->user_name = $user_name;
		$this->password = $password;
	}

	/**
	 * Retrieves a product
	 *
	 * @param int $store_id
	 * @return string
	 */
	public function get_product() {
		$data = array("username" => $this->user_name, "password" => $this->password);
		$data_string = json_encode($data);
		$ch = curl_init($this->admin_url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json',
		'Content-Length: ' . strlen($data_string))
		);
		$token = curl_exec($ch);
		$token = json_decode($token);

		$requestUrl = 'http://lab.magento2.caupo.se/index.php/rest/V1/products/trollet-1337';
		$ch = curl_init($requestUrl);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$headers = array(
			'Content-Type: application/json',
			'Authorization: Bearer ' . $token
		);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
		print_r(json_decode($result));
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