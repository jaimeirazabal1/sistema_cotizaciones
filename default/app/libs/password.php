<?php

class Password{
	public static function encriptar($password){
		return md5($password);
	}
}