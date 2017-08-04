<?php
require_once('classes/api_connection.php');
require_once('classes/field_validation.php');

$api_connection = new classes_api_connection();
$field_validation = new classes_field_validation();

$api_connection->get_product();

?>