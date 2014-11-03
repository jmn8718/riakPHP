<?php

class Usuario{
	public function __construct($user, $pass){
		$this->usuario = $user;
		$this->password = $pass;
	}
	var $usuario;
	var $password;
}


class Rtwit{
	public function __construct($user, $text, $date = null){
		$this->usuario = $user;
		$this->texto = $text;
		if($date!= null)
			$this->fecha = $date;
		else {
			$this->fecha = date('Y-m-d H:i:s');
			$this->timestamp = time();
		}
	}
	var $usuario;
	var $texto;
	var $fecha;
	var $timestamp;

	public function toJSON(){
	$arr = array('texto'=> $this->texto , 'fecha'=> $this->fecha , 'timestamp' => $this->timestamp );
		return json_encode($arr);
	}

	public function toArray(){
		$a = array('texto'=> $this->texto , 'fecha'=> $this->fecha , 'timestamp' => $this->timestamp );
		return $a;
	}
}

class KValue{
	public function __construct($key, $value){
		$this->key = $key;
		$this->value = $value;
	}

	var $key;
	var $value;
}

?>