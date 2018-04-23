<?php

/*** 学内・学外ネットワーク判定スクリプト ***/

$ip 	= $_SERVER['REMOTE_ADDR'];

//$ip = "127.223.160.216"; //検証。
$ipnum	= ip2long($ip);

// IPv4 or IPv6のチェック IPv4しか対応していないのでv6は除外
if($ipnum == false){
	$a = "無効なIPアドレス";
	$b = false;
}else{

	$ipex = explode(".", $ip);
	
	// プライベートネットワーク 10.0.0.0/8, 192.168.0.0/16 は許可。172.16.0.0/12は使われていないので必要なら追記してください
	if($ipex[0] == "10" || ( $ipex[0] == "192" && $ipex[1] == "168" ) ){
		$a = "学内LAN経由";
		$b = true;
		
	// 今回は，学内グローバルIPのネットワークが127.223.160.0/20である場合を想定している。
	}else if($ipex[0] == "127" && $ipex[1] == "223"){
		if($ipex[2] >= 160 && $ipex[2] <= 175){ 
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
