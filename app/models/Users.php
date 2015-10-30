<?php

use Phalcon\Mvc\Model;
use Phalcon\Forms\Element;
class Users extends Model
{
	
	public $id;

	public $account;

	public $email;

	public $password;
	
	public $remember ;
	
	public $name;
	
	public $active;
}
?>