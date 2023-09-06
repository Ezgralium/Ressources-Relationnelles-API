<?php

class User{

	public $id;
	public $mail;
	public $nom;
	public $prenom;
	public $alias;
	public $salt;
	public $account_confirmed;
	public $profile_picture_path;
	public $id_role;

	public function __construct(){

	}


	public function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}
	
}











?>