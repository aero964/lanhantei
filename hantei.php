<?php

/*** 学内・学外ネットワーク判定スクリプト ***/

$ip 	= $_SERVER['REMOTE_ADDR'];

//$ip = "169.254.160.216"; //検証
$ipnum	= ip2long($ip);

// IPv4 or IPv6のチェック IPv4しか対応していないのでv6は除外
if($ipnum == false){
	$a = "無効なIPアドレス";
	$b = false;
}else{

	$ipex = explode(".", $ip);

	if($ipex[0] == "10" || ( $ipex[0] == "192" && $ipex[1] == "168" ) ){
		$a = "学内LAN経由";
		$b = true;
	}else if($ipex[0] == "169" && $ipex[1] == "254"){
		if($ipex[2] >= 160 && $ipex[2] <= 175){ // 学内グローバルIPのネットワークが169.254.160.0/20である場合
			$a = "グローバルIP経由";
			$b = true;
		}else{
			$a = "無効なIPアドレス";
			$b = false;
		}

	}else{
		$a = "無効なIPアドレス";
		$b = false;
	}

}

//煮るなり焼くなり
echo $a."<BR>".$ip;
