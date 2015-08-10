<?php

/**
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Box extends DataObject {
	
	private static $db = array(
		'Name' => 'Varchar(255)',
		'NameSlug' => 'Varchar(255)',
		'Description' => 'Varchar(255)'
	);
	
	private static $has_many = array(
		'Versions' => 'BoxVersion'
	);
	
}