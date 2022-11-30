<?php
include_once("config.php");
include "mycurl.php";
if(isset ($_GET['callback']))
{
	$product_id = $_GET['id'];
	$client_id = '9ny18tskg7zu1jizrc1ull67avg13va';
	$store_hash = 'sligwemgi';
	$file_name = $store_hash."_app_crdential.json";
	$str = file_get_contents($file_name);
	$result = json_decode($str, true);
	$authToken = $result['access_token'];
	$product_array = getProduct($authToken, $client_id, $store_hash, $product_id);
    header("Content-Type: application/json");
    echo $_GET['callback']."(".json_encode($product_array,true).")";die;
	//echo json_encode($product_array,true);

}
function getProduct($authToken, $client_id, $store_hash, $product_id)
{
	$headers = array(
	    "Accept:application/json",
	    "Content-Type:application/json",
	    'X-Auth-Client: '.$client_id,
	    'X-Auth-Token: '.$authToken
	);
	$url = "https://api.bigcommerce.com/stores/".$store_hash."/v3/catalog/products/".$product_id;
	return myCurlGetRequest($url, $headers);
}
?>