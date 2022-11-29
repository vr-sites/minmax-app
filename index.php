<?php
include_once("config.php");
$authToken = '';
if($_GET['code'] && $_GET['context'] && $_GET['scope']){
	$object = new \stdClass();
	$object->client_id = '9ny18tskg7zu1jizrc1ull67avg13va';
	$object->client_secret = '0c097784e915af68ae1e499478a4df6c8d36c7f4afe140f510e910076f9812de';
	$object->redirect_uri = 'https://danielnunney.com/bigapp2/';
	$object->code = $_GET['code'];
	$object->scope = $_GET['scope'];
	$object->context = $_GET['context'];
	$context_array = explode("/", $_GET['context']);
	$store_hash = $context_array["1"];
	$object->grant_type = 'authorization_code';
	//print_r($object);
	$make_call = callAPI('POST', 'https://login.bigcommerce.com/oauth2/token', $object);
	//print_r($make_call);
	$response = json_decode($make_call, true);
	$authToken = $response['access_token'];
	//print_r($response);
	$file_name = $store_hash."_app_crdential.json";
	file_put_contents($file_name, json_encode($response));
}else{
	$response = $_GET;
	$make_array = explode("=",$response['signed_payload']);
	//$make_array2 = explode(".",$result['signed_payload_jwt']);
	$payload_array = json_decode(base64_decode($make_array['0']),true);
	// print_r($payload_array);
	$store_hash = $payload_array['store_hash'];
	//print_r(base64_decode($_GET['signed_payload_jwt']));
	file_put_contents('test.json', json_encode($response));
	$file_name = $store_hash."_app_crdential.json";
	$str = file_get_contents($file_name);
	$result = json_decode($str, true);
	$authToken = $result['access_token'];
	
}
if($authToken){
	$file_name2 = $store_hash."_script.json";
	
	if(empty(file_get_contents($file_name2))){
		//$url1 = 'https://api.bigcommerce.com/stores/'.$store_hash.'/v3/content/scripts/';
		$data2 = array(
				"name"=> "javascriptadd",
				"description"=> "test",
				"src"=> "https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js",
				"auto_uninstall"=> true,
				"load_method"=> "default",
				"location"=> "head",
				"visibility"=> "all_pages",
				"kind"=> "src",
				"api_client_id"=> "",
				"consent_category"=> "essential",
				"enabled"=> true,
				"channel_id"=> 1
		);
		$method1 = "POST";
		$script2 = add_script($method1, $store_hash, $data2, $authToken);
		$script_response2 = json_decode($script, true);
		file_put_contents('jQueryjs.json', json_encode($script_response2));
		$data1 = array(
				"name"=> "appscript",
				"description"=> "test",
				"src"=> "https://danielnunney.com/bigapp2/js/appScript.js",
				"auto_uninstall"=> true,
				"load_method"=> "default",
				"location"=> "head",
				"visibility"=> "all_pages",
				"kind"=> "src",
				"api_client_id"=> "",
				"consent_category"=> "essential",
				"enabled"=> true,
				"channel_id"=> 1
		);
		$script = add_script($method1, $store_hash, $data1, $authToken);
		$script_response = json_decode($script, true);
		
		file_put_contents($file_name2, json_encode($script_response));
	}else{
		
		$str2 = file_get_contents($file_name2);
		$result2 = json_decode($str2, true);
		//print_r($result2);8928b1ca-4812-4d56-8f62-3859f8f11cc9
	}
	
	//echo $object->client_id;die;
	include "mycurl.php";
	// API details
	$bc_products = [];
	$page = 1;
	while (true) {
	    $bc_data = getProducts($authToken, '9ny18tskg7zu1jizrc1ull67avg13va', $store_hash, $page);

	    $bc_products = array_merge($bc_products, $bc_data->data);
	    if ($page >= $bc_data->meta->pagination->total_pages) {
	        break;
	    }
	    $page++;
	}
 	$brand_product_array = array();
    foreach ($bc_products as $bc_key1 => $brand) {
		$bc_products_by_brand = [];
		$page1 = 1;
		while (true) {
		    $bc_data1 = getProductsByBrand($authToken, '9ny18tskg7zu1jizrc1ull67avg13va', $store_hash, $page1, $brand->id);

		    $bc_products_by_brand = array_merge($bc_products_by_brand, $bc_data1->data);
		    if ($page1 >= $bc_data1->meta->pagination->total_pages) {
		        break;
		    }
		    $page1++;
		}
		foreach ($bc_products_by_brand as $bcb_key => $B_product) {
			$brand_product_array[$brand->id][] = $B_product->id;
		}
	}
	// echo "<pre>";
	// print_r($brand_product_array);
	$jsObj = [];
	//$jsObj['brand']=$brand_product_array;
	$empQuery1 = "select * from  bigapp WHERE 1=1";
	//var_dump( $empQuery);die;
	$empRecords1 = mysqli_query($con, $empQuery1);
	while ($order1 = mysqli_fetch_assoc($empRecords1)) {
	 $brand_ids = explode(",",$order1['brand_id']);
	 $brand_name_array = array();
	 foreach($brand_ids as $brandID){
	    $brand_name_array[] = $brand_array[$brandID]; 
	 }
	 $jsObj[$order1['brand_id']] = [$order1['brand_id'],$order1['min_number'],$order1['max_number'],$order1['min_amount'],$order1['max_amount']];
	}
	
	$data3 = array(
				"name"=> "javascriptadd2",
				"description"=> "test2",
				"html"=> "<script>var settingObj = ".json_encode($jsObj,true).";var brandObj = ".json_encode($brand_product_array,true)."</script>",
				"auto_uninstall"=> true,
				"load_method"=> "default",
				"location"=> "head",
				"visibility"=> "all_pages",
				"kind"=> "script_tag",
				"api_client_id"=> "",
				"consent_category"=> "essential",
				"enabled"=> true,
				"channel_id"=> 1
		);
	$method3 = "PUT";
	$script3 = update_script($method3, $store_hash, $data3, $authToken);
	$script_response3 = json_decode($script3, true);
	file_put_contents('jQueryjs2.json', json_encode($script_response3));
	include_once('tabs.php');
}else{
	echo "some error found!";
}
// if(isset($_POST['fname'])){
// 	echo "<pre>";
// 	print_r($_POST);
// }
function callAPI($method, $url, $data){

	$curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
	$err = curl_error($curl);
    curl_close($curl);
    if(!empty($err)){
    	return $err;
    }else{
    	return $response;
    }
    

}
function add_script($method, $storehase, $data, $authToken){
	$curl = curl_init();

	curl_setopt_array($curl, [
	  CURLOPT_URL => "https://api.bigcommerce.com/stores/".$storehase."/v3/content/scripts",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => json_encode($data),
	  CURLOPT_HTTPHEADER => [
	    "Accept: application/json",
	    "Content-Type: application/json",
	    "X-Auth-Token: ".$authToken
	  ],
	]);
	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);
	return $response;
}
function update_script($method, $storehase, $data, $authToken){
	$curl = curl_init();

	curl_setopt_array($curl, [
	  CURLOPT_URL => "https://api.bigcommerce.com/stores/".$storehase."/v3/content/scripts/8928b1ca-4812-4d56-8f62-3859f8f11cc9",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "PUT",
	  CURLOPT_POSTFIELDS => json_encode($data),
	  CURLOPT_HTTPHEADER => [
	    "Accept: application/json",
	    "Content-Type: application/json",
	    "X-Auth-Token: ".$authToken
	  ],
	]);
	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);
	return $response;
}
function getProducts($authToken, $client_id, $store_hash, $page)
{
	$headers = array(
	    "Accept:application/json",
	    "Content-Type:application/json",
	    'X-Auth-Client: '.$client_id,
	    'X-Auth-Token: '.$authToken
	);
    //$url = "https://api.bigcommerce.com/stores/".$store_hash."/v3/catalog/products?limit=250&page=$page&include_fields=name,id,sku,inventory_tracking&include=variants";
    $url = "https://api.bigcommerce.com/stores/".$store_hash."/v3/catalog/brands";
    return myCurlGetRequest($url, $headers);
}
function getProductsByBrand($authToken, $client_id, $store_hash, $page, $brand_id)
{
	$headers = array(
	    "Accept:application/json",
	    "Content-Type:application/json",
	    'X-Auth-Client: '.$client_id,
	    'X-Auth-Token: '.$authToken
	);
    //$url = "https://api.bigcommerce.com/stores/".$store_hash."/v3/catalog/products?limit=250&page=$page&include_fields=name,id,sku,inventory_tracking&include=variants";
    $url = "https://api.bigcommerce.com/stores/".$store_hash."/v3/catalog/products/?brand_id=".$brand_id;
    return myCurlGetRequest($url, $headers);
}

?>
