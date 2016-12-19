<?php

class User extends ActiveRecord{
	protected function initialize(){
    	$this->validates_uniqueness_of("username");
   	}
}