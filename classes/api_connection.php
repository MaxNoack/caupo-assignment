<?php

/**
 * Controller for Magento API calls
 */
class classes_api_connection {
	/**
	 * @var Classes_Api_Connection
	 */
	protected $admin_url;
	protected $user_name;
	protected $password;

	/**
	 * Constructor
	 *
	 * @param string $admin_url
	 * @param string $user_name
	 * @param string $password
	 */
	public function __construct($admin_url, $user_name, $password) {
		$this->admin_url = $admin_url;
		$this->user_name = $user_name;
		$this->password = $password;
	}

	/**
	 * Retrieves a product
	 *
	 * @param string $sku
	 * @return array
	 */
	public function get_product($sku) {
		$token = "";
		$token = $this->get_api_token();
		
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
		//If curl didn't succed, send error
		if(curl_errno($ch)){
			throw new Exception(curl_error($ch));
		}
		return json_decode($result);
	}

	/**
	 * Create new product
	 *
	 * @param string $sku
	 * @param string $name
	 * @param float $price
	 */
	public function create_new_product($sku, $name, $price) {
		$token = "";
		$token = $this->get_api_token();

		$requestUrl = 'http://lab.magento2.caupo.se/index.php/rest/V1/products';
		$ch = curl_init($requestUrl);
		$post = array(
			"product" => array(
				"sku" => $sku,
				"name" => $name,
				"price" => $price,
				'visibility' => 4,
				'type_id' => 'simple',
				'attribute_set_id' => 4,
			)
		);
		$post_string = json_encode($post);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers = array(
			'Content-Type: application/json',
			'Authorization: Bearer ' . $token,
			'Content-Length: ' . strlen($post_string))
		);

		$result = curl_exec($ch);
		//If curl didn't succed, send error
		if(curl_errno($ch)){
			throw new Exception(curl_error($ch));
		}
		//Everything went fine, inform the user
		else {
			echo json_encode(
				array(
					"Error" => false,
					"info" => "New product has been created",
				)
			);
		}
	}

	/**
	 * Saves an existing product.
	 *
	 * @param string $sku
	 * @param string $name
	 * @param float $price
	 */
	public function save_product($sku, $name, $price) {
		$token = "";
		$token = $this->get_api_token();

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
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers = array(
			'Content-Type: application/json',
			'Authorization: Bearer ' . $token,
			'Content-Length: ' . strlen($post_string))
		);

		json_decode(curl_exec($ch));
		//If curl didn't succed, send error
		if(curl_error($ch)){
			throw new Exception(curl_error($ch));
		}
		//Everything went fine, inform the user
		else {
			echo json_encode(
				array(
					"Error" => false,
					"info" => "Product with sku <b>" . $sku . "</b> has been updated",
				)
			);
		}
	}

	/**
	 * Deletes a product
	 *
	 * @param string $sku
	 */
	public function delete_product($sku) {
		$token = "";
		$token = $this->get_api_token();

		$requestUrl = 'http://lab.magento2.caupo.se/index.php/rest/V1/products/' . $sku;
		$ch = curl_init($requestUrl);

		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Authorization: Bearer ' . $token
		));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		json_decode(curl_exec($ch));
		//If curl didn't succed, send error
		if(curl_error($ch))
		{
			throw new Exception(curl_error($ch));
		}
		//Everything went fine, inform the user
		else {
			echo json_encode(
				array(
					"Error" => false,
					"info" => "Product with sku <b>" . $sku . "</b> has been deleted",
				)
			);
		}
	}

	/**
	 * Retrieve API token
	 *
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