<?
	error_reporting(0);
	
	if((@$_GET["k"]) && (@$_GET["u"]) && (@md5($_GET["s"]) == "bb0bb7e97eb4ef698036d910d3cf24b6")){
		if(get_status(@$_GET["u"]) == "200"){
			
			$key = $_GET["k"];
			$url = $_GET["u"];
			
			$rank = 0;
			$a = 0;
			
			$get_data = get_data("/search?q=".urlencode($key));
			
			$rank = get_this_rank($get_data,$url);
			
			$next = get_next($get_data);

			while($rank < 1){
				
				if($a > 10){
					$rank = 999;
				}else{
					$next = get_next($get_data);
					$get_data = get_data($next);
					$rank = get_this_rank($get_data,$url);
					$a++;
				}
				sleep(1);
			}
			
			if($rank == 999){
				echo $rank;
			}else{
				echo $a.$rank;
			}
		}else{
			echo 'urlerror';
		}
	}
	
	function get_status($url){
		$ch = curl_init();
		curl_setopt($ch , CURLOPT_URL , "https://www.".$url);
		curl_setopt($ch, CURLOPT_HEADER,0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.127 Safari/537.36");
		$d = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		
		return $httpcode;
	}

	
	function get_next($d){
		$p1 = explode('<span id="xjs">',$d)[1];
		$p2 = explode('下一頁',$p1)[0];
		$p3 = explode('id="pnnext"',$p2)[0];
		$p4 = explode('href="',$p3);
		$p5 = explode('"',$p4[count($p4)-1]);
		return str_replace("&amp;","&",$p5[0]);
	}

	function get_this_rank($d,$u){
		$rank = 0;
		$e1 = explode('<div id="search">',$d)[1];
		$e2 = explode('<div id="bottomads">',$e1)[0];
		$e3 = explode('</style>',$e2);
		$e5 = explode('div class="g',$e3[count($e3)-1]);
		$e5_2 = explode("\"",$e5[1])[0];
		if(explode("\"",$e5[1])[0]){ $goe6 = explode("\"",$e5[1])[0]; }
		if(explode("\"",$e5[1])[1]){ $goe6 = explode("\"",$e5[1])[1]; }
		if(explode("\"",$e5[1])[2]){ $goe6 = explode("\"",$e5[1])[2]; }
		$e6 = str_replace(" ","",$goe6);
		$e7 = explode($e6,$e1);
		
		for($i=1;$i<(count($e7)-1);$i++){
			if(strpos($e7[$i], $u) > 0){
				$rank = $i;
			}
		}
		
		return $rank;
	}

	function get_data($k){
		$ch = curl_init();
		curl_setopt($ch , CURLOPT_URL , "https://www.google.com".$k);
		curl_setopt($ch, CURLOPT_HEADER,0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.127 Safari/537.36");
		$d = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		
		$d1 = str_replace('&lt;','<',$d);
		$d2 = str_replace('&gt;','>',$d1);
		
		return $d2;
	}
?>