<?php
require_once 'riak.php';

/*echo '--------------------------------------<br>';
$variable = getKeys(BUCKET_USUARIOS);
foreach ($variable as $key) {
	$a = '<a href="selectRtwits.php?usuario='.$key.'">'.$key.'</a>';
	echo $a.'<br>';
}*/
printBucket("testNull");
/*echo '/////////////////********-----------**********\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\';
vaciarBucket('test');
echo '/////////////////********-----------**********\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\';
/*sleep(3);
printBuckets();*/
$myBucket = getBucket("testNull");
$obj = $myBucket->newObject(null, $value);
$obj->store();
print_r($obj);
echo '--------------------------------------<br>';
printBucket("testNull");
?>