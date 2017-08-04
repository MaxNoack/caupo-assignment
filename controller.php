<?php
require_once('classes/api_connection.php');
require_once('classes/field_validation.php');

$api_connection = new classes_api_connection(
	"http://lab.magento2.caupo.se/index.php/rest/V1/integration/admin/token",
	"demo",
	"demo123"
);
$field_validation = new classes_field_validation();

$api_connection->get_product();

?>