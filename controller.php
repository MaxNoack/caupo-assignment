<?php
require_once('classes/api_connection.php');


$name = $_POST['name'];
$sku = $_POST['sku'];
$price = $_POST['price'];
$action_type = $_POST['action_type'];

die("det gick" . $_POST['action_type'];);
try {
	$api_connection = new classes_api_connection(
		"http://lab.magento2.caupo.se/index.php/rest/V1/integration/admin/token",
		"demo",
		"demo123"
	);
	if ($action_type = "add_product") {

		//Check if sku exists
		if ($api_connection->get_product($sku)) {
			die("yeees!");
			$api_connection->save_product($sku, $name, $price);
		}
		else {
			$api_connection->create_new_product($sku, $name, $price);
		}
	}

	if ($action_type = "delete_product") {
		echo "hej";
		$api_connection->delete_product();
	}
} catch(Exception $e) {
	echo json_encode(
		array(
			"Error" => true,
			"error_string" => "Can't retrieve api data. Error: " . $e->getMessage(),
		)
	);
}

?>