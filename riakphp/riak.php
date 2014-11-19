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

define('BUCKET_USUARIOS', 'usuariosR');
define('BUCKET_RTWITS', 'rtwitsR');
define('HOST', 'localhost');
define('PORT', 10018);

function getBucket($bucket){
	$client = new Basho\Riak\Riak(HOST, PORT);
	$myBucket = $client->bucket($bucket);
	return $myBucket;
}

function hasKey($bucket,$key){
	$myBucket = getBucket($bucket);
	if($myBucket->hasKey($key)){
		return true;
	} else {
		return false;
	}
}

function setKValue($bucket,$key,$value){
	$myBucket = getBucket($bucket);
	$obj = $myBucket->newObject($key, $value);
	$obj->store();
	$http_code = $obj->status();
	if ($http_code==200) {
		//print('creado<br>');
	} elseif ($http_code==201) {
		//print('Creado sin clave<br>');
	} elseif ($http_code==204) {
		//print('no content<br>');
	} elseif ($http_code==300) {
		//print('Creado con hijos<br>');
	} else {		
		//print('ERROR<br>');
		return false;
	}
	return true;
}

function getKValue($bucket,$key){
	$myBucket = getBucket($bucket);
	$fetched = $myBucket->get($key);
	$http_code = $fetched->status();
	if ($http_code==200) {
		//print('HIJO UNICOss<br>');
		/*$resul[] = new KValue($fetched->getKey(),$fetched->getData());
		return $resul;*/
		return new KValue($fetched->getKey(),$fetched->getData());
	} elseif ($http_code==300) {
		//print('SIBLINGS<br>');
		$siblings;
		$sib = $fetched->getSiblingCount();
		$siblingsKeys = $fetched->siblings;
		for ($i=0; $i < $sib; $i++) { 
			$sibling = $fetched->getSibling($i);
			$siblings[] = new KValue($siblingsKeys[$i],$sibling->getData());
		}
		return $siblings;
	}
	return null;
}

function getKeys($bucket){
	$myBucket = getBucket($bucket);
	$keys = $myBucket->getKeys();
	return $keys;
}

function getNumberOfValues($key){
	$keys = getKeys($key);
	return count($keys);
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
			print('-----'.$obj->status().'-----<br>');
			if ($obj->status()==200) {
				//print('HIJO UNICO<br>');
				print('key: '.$key.' : '.$obj->getData().'<br>');
			} elseif ($obj->status()==300) {
				//print('SIBLINGS<br>');
				$sib = $obj->getSiblingCount();
				print('key: '.$obj->getKey().'<br>');
				for ($i=0; $i < $sib; $i++) { 
					$f = $obj->getSibling($i);
					print(' | value: ');print_r($f->getData());print('<br>');
				}
			} else {		
				print('ERROR<br>');
			}
		}
	}
}

function printBuckets(){
	$client = new Basho\Riak\Riak(HOST, PORT);
	$keys = $client->buckets();
	foreach ($keys as $key) {
		print('Name: '.$key->getName().'--------<br>');
		//printBucket($key->getName());
	}
}



function removeKey($bucket,$key){
	$myBucket = getBucket($bucket);
	$fetched = $myBucket->get($key);
	$fetched->delete();
	$status = $fetched->status();
	//print('Name: '.$fetched->getKey().' | ');
	if($status===204){
		//print('Borrado con exito--------<br>');
		return true;
	}/* elseif ($status===404) {
		print('Not found--------<br>');
	} elseif ($status===400) {
		print('ERROR----------------------<br>');
	}*/
	return false;
}

function vaciarBucket($bucket){
	$myBucket = getBucket($bucket);
	$keys = $myBucket->getKeys();
	foreach ($keys as $key) {
		removeKey($bucket,$key);
	}
}
?>