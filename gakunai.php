<?php

$ip 	= $_SERVER['REMOTE_ADDR'];


$ipnum	= ip2long($ip);

// IPv4 or IPv6のチェック
if($ipnum == false){
	$a = "無効なIPアドレス";
}


$ipex = explode(".", $ip);


if($ipex[0] == "10" || ( $ipex[0] == "192" && $ipex[1] == "168" ) ){
	$a = "学内LAN経由";
}else if($ipex[0] == "202" && $ipex[1] == "26"){
	if($ipex[2] >= 160 && $ipex[2] <= 175){
		$a = "グローバルIP経由";
	}else{
		$a = "無効なIPアドレス";
	}

}else{
	$a = "無効なIPアドレス";
}

echo $a."<BR>".$ip;


// 大変申し訳ありませんが，このページは学内限定となります。
// 大学構内のWi-fi(wstation)か，実習室のパソコンからご覧下さい。