<?php
require_once('classes/api_connection.php');

try {
	$sku = $_POST['sku'];
	$action_type = $_POST['action_type'];

	//create connection object
	$api_connection = new classes_api_connection(
		"http://lab.magento2.caupo.se/index.php/rest/V1/integration/admin/token",
		"demo",
		"demo123"
	);

	//Check if sku exists
	$product_exists = $api_connection->get_product($sku);

	//If Update/add is clicked
	if ($action_type == "add_product") {
		$name = $_POST['name'];
		$price = $_POST['price'];
		if (isset($product_exists->sku)) {
			$api_connection->save_product($sku, $name, $price);
		}
		else {
			$api_connection->create_new_product($sku, $name, $price);
		}
	}

	//If delete is clicked
	if ($action_type == "delete_product") {
		if (isset($product_exists->sku)) {
			$api_connection->delete_product($sku);
		}
		else {
			echo json_encode(
				array(
					"Error" => true,
					"info" => "Product with sku <b>" . $sku . "</b> doesn't exist",
				)
			);
		}
	}
//Through error if there's no access to the server
} catch(Exception $e) {
	echo json_encode(
		array(
			"Error" => true,
			"info" => "Can't retrieve API data",
		)
	);
}

?>