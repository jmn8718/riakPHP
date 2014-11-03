<?php
require_once('Riak/Riak.php');
require_once('Riak/Bucket.php');
require_once('Riak/Exception.php');
require_once('Riak/Link.php');
require_once('Riak/Link/Phase.php');
require_once('Riak/MapReduce.php');
require_once('Riak/MapReduce/Phase.php');
require_once('Riak/Object.php');
require_once('Riak/StringIO.php');
require_once('Riak/Utils.php');

require_once('clases.php');

define('BUCKET_TEST', 'tests');
define('BUCKET_USUARIOS', 'usuarios');
define('BUCKET_RTWITS', 'rtwits');
define('HOST', '172.31.10.175');
define('PORT', 8098);

function getBucket($bucket){
	$client = new Basho\Riak\Riak(HOST, PORT);
	$myBucket = $client->bucket($bucket);
	return $myBucket;
}

function crearBucket($bucket,$multi){
	$myBucket = getBucket($bucket);
	$myBucket->setAllowMultiples($multi);
	return $myBucket->getAllowMultiples();
}

function hasKey($bucket,$key){
	$myBucket = getBucket($bucket);
	if($myBucket->hasKey($key)){
		return true;
	} else {
		return false;
	}
}

function setKValue($bucket,$key,$value,$allow_m = null){
	$myBucket = getBucket($bucket);
	if($allow_m !== null){
		$myBucket->setAllowMultiples($allow_m);
	}
	$obj = $myBucket->newObject($key, $value);
	$obj->store();
	$http_code = $obj->headers['http_code'];
	if ($http_code==200) {
		//print('HIJO UNICO<br>');
	} elseif ($http_code==300) {
		//print('SIBLINGS<br>');
	} else {		
		//print('ERROR<br>');
		return false;
	}
	return true;
}

function getKValue($bucket,$key){
	$myBucket = getBucket($bucket);
	$fetched = $myBucket->get($key);
	$http_code = $fetched->headers['http_code'];
	if ($http_code==200) {
		//print('HIJO UNICOss<br>');
		$item = new KValue($fetched->getKey(),$fetched->getData());
		$resul[] = $item;
		return $resul;
	} elseif ($http_code==300) {
		//print('SIBLINGS<br>');
		$siblings;
		$sib = $fetched->getSiblingCount();
		for ($i=0; $i < $sib; $i++) { 
			$sibling = $fetched->getSibling($i);
			$item = new KValue($sibling->getKey(),$sibling->getData());
			$siblings[] = $item;
		}
		return $siblings;
	} else {		
		//print('ERROR '.$key.' '.$http_code.'<br>');
		return null;
	}
}

function printBucket($bucket){
	$myBucket = getBucket($bucket);
	$keys = $myBucket->getKeys();
	if (count($keys)==0) {
		print('Bucket vacio<br>');
	} else {
		print('Hay '.count($keys).' claves<br>');
			foreach ($keys as $key) {
			$obj = $myBucket->get($key);
			print('-----'.$obj->getKey().'-----<br>');
			if ($obj->headers['http_code']==200) {
				//print('HIJO UNICO<br>');
				print($key.' : '.$obj->getData().'<br>');
			} elseif ($obj->headers['http_code']==300) {
				//print('SIBLINGS<br>');
				$sib = $obj->getSiblingCount();
				print('key: '.$obj->getKey().'<br>');
				for ($i=0; $i < $sib; $i++) { 
					$f = $obj->getSibling($i);
					print(' | value: ');print_r($f->getData());print('<br>');
				}
			} else {		
				//print('ERROR<br>');
			}
		}
	}
}

function printBuckets(){
	$client = new Basho\Riak\Riak(HOST, PORT);
	$keys = $client->buckets();
	foreach ($keys as $key) {
		print('Name: '.$key->getName().'--------<br>');
		printBucket($key->getName());
	}
}

function vaciarBucket($bucket){
	$myBucket = getBucket($bucket);
	$keys = $myBucket->getKeys();
	foreach ($keys as $key) {
		$obj = $myBucket->get($key);
		$obj->delete();
	}
}

?>