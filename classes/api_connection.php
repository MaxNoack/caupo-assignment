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
	public function get_product($sku) {
		$token = "";
		try {
			$token = $this->get_api_token();
		} catch(Exception $e) {
			echo "Can't retrieve api token. Curl error: " . $e->getMessage();
		}
		$requestUrl = 'http://lab.magento2.caupo.se/index.php/rest/V1/products/' . $sku;
		$ch = curl_init($requestUrl);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$headers = array(
			'Content-Type: application/json',
			'Authorization: Bearer ' . $token
		);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
		if(curl_errno($ch)){
			throw new Exception(curl_error($ch));
		}
		print_r(json_decode($result));
		return json_decode($result);
	}

	/**
	 * Saves a product. If it doesn't exist, create it.
	 *
	 * @param int $sku
	 * @param int $name
	 * @param int $price
	 * @return array
	 */
	public function create_new_product($sku, $name, $price) {
		$token = "";
		try {
			$token = $this->get_api_token();
		} catch(Exception $e) {
			echo "Can't retrieve api token. Curl error: " . $e->getMessage();
		}

		$requestUrl = 'http://lab.magento2.caupo.se/index.php/rest/V1/products';
		$ch = curl_init($requestUrl);
		$post = array(
			"product" => array(
				"sku" => $sku,
				"name" => $name,
				"price" => $price
			)
		);
		$post_string = json_encode($post);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers = array(
			'Content-Type: application/json',
			'Authorization: Bearer ' . $token,
			'Content-Length: ' . strlen($post_string))
		);

		$result = curl_exec($ch);
		if(curl_errno($ch)){
			throw new Exception(curl_error($ch));
		}
		else {
			echo "New product has been created";
		}
		print_r(json_decode($result));
	}

	/**
	 * Saves an existing product.
	 *
	 * @param int $sku
	 * @param int $name
	 * @param int $price
	 * @return array
	 */
	public function save_product($sku, $name, $price) {
		$token = "";
		try {
			$token = $this->get_api_token();
		} catch(Exception $e) {
			echo "Can't retrieve api token. Curl error: " . $e->getMessage();
		}

		$requestUrl = 'http://lab.magento2.caupo.se/index.php/rest/V1/products/' . $sku;
		$ch = curl_init($requestUrl);
		$post = array(
			"product" => array(
				"sku" => $sku,
				"name" => $name,
				"price" => $price
			)
		);
		$post_string = json_encode($post);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers = array(
			'Content-Type: application/json',
			'Authorization: Bearer ' . $token,
			'Content-Length: ' . strlen($post_string))
		);

		json_decode(curl_exec($ch));
		if(curl_error($ch)){
			throw new Exception(curl_error($ch));
		}
		else {
			echo "Product with sku: " . $sku . " has been updated";
		}
	}

	/**
	 * Deletes a product
	 *
	 * @param int $store_id
	 * @return array
	 */
	public function delete_product($sku) {
		$token = "";
		try {
			$token = $this->get_api_token();
		} catch(Exception $e) {
			echo "Can't retrieve api token. Curl error: " . $e->getMessage();
		}

		$requestUrl = 'http://lab.magento2.caupo.se/index.php/rest/V1/products/' . $sku;
		$ch = curl_init($requestUrl);

		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Authorization: Bearer ' . $token
		));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		json_decode(curl_exec($ch));
		// Something with the request crashed, return error to the browser
		if(curl_error($ch))
		{
			throw new Exception(curl_error($ch));
		}
		else {
			echo "Product with sku: " . $sku . " has been deleted";
		}
	}

	/**
	 * Retrieve API token
	 *
	 * @param int $store_id
	 * @return array
	 */
	public function get_api_token() {
		$data = array(
			"username" => $this->user_name,
			"password" => $this->password
		);
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
		if(curl_errno($ch)){
			throw new Exception(curl_error($ch));
		}
		return json_decode($token);
	}
}

?>