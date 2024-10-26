<?php
file_put_contents("k0513.json", "[]");
include "../password.php";
function searchAndMoveValue($jsonFile1, $jsonFile2, $key, $value) {
	$arr1 = json_decode(file_get_contents($jsonFile1), true);
	$arr2 = json_decode(file_get_contents($jsonFile2), true);

	foreach($arr1 as $index => $array) {
		if(isset($array[$key]) && $array[$key] == $value) {
			$movedArray = array_splice($arr1, $index, 1);
			array_push($arr2, $movedArray[0]);
			file_put_contents($jsonFile1, json_encode($arr1));
			file_put_contents($jsonFile2, json_encode($arr2));
			return true;
		}
	}
	return false;
}

function searchAndMoveValue2(string $sourceFile, string $targetFile, $value) {
	$sourceJson = file_get_contents($sourceFile);
	$sourceArray = json_decode($sourceJson, true);
	$targetJson = file_get_contents($targetFile);
	$targetArray = json_decode($targetJson, true);
	$key = array_search($value, $sourceArray);
	if($key !== false) {
		unset($sourceArray[$key]);
	}
	$targetArray[] = $value;
	file_put_contents($sourceFile, json_encode($sourceArray));
	file_put_contents($targetFile, json_encode($targetArray));
}

if(!empty($_GET["password"]) && $_GET["password"] == $password) {
	if(!empty($_GET["k0513"])) {
		searchAndMoveValue("../idinfo.json", "k0513.json", "id", $_GET["k0513"]);
		searchAndMoveValue2("../id.json", "k0513.json", $_GET["k0513"]);
	}
	echo "<html><head><meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\"><title>列表</title><link href=\"https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css\" rel=\"stylesheet\"><link href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.min.css\" rel=\"stylesheet\"><style>body {font-family: Arial, sans-serif; background-color: #f2f2f2;} .container {max-width: 50%; margin: 0 auto; padding: 20px;} .item {background-color: #fff; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 20px; padding: 20px;} .item h3 {margin-top: 0;} .item p {margin-bottom: 10px;} .item a:hover {text-decoration: underline;} .delete-btn {color: #f00;} </style></head><body><div class=\"container\">";
	$data = json_decode(file_get_contents("../idinfo.json"), true);
	foreach($data as $item) {
		echo "<div class=\"item\"><h3>{$item["domain"]}</h3><p>备案编号：{$item["id"]}</p><p>主体类型：{$item["type"]}</p><p>网站名称：{$item["webname"]}</p><p>网站介绍：{$item["description"]}</p><p>网站站长：<span class='label label-primary'>{$item["master"]}</span></p><p>联系邮箱：{$item["email"]}</p><p><a href=\"?k0513={$item["id"]}&password={$_GET["password"]}\" class=\"btn btn-sm btn-danger\" style=\"text-decoration: none;\"><i class=\"fas fa-trash-alt\"></i> 删除</a></p></div>";
	}
} else {
echo "<center><p style=\"font-size: 10vw;\">你想登录后台?</p><p style=\"font-size: 50vw;color: #f00;\">6</p></center>";
}
