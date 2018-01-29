<?php
function nojurnal($nomor){
	$panjang = strlen($nomor);
	switch ($panjang){
		case "1" :
			return "00".$nomor;	
		break;
		case "2" :
			return "0".$nomor;	
		break;
		default :
			return $nomor;	
		break;
	}
}
?>