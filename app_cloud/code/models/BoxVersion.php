<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class BoxVersion extends DataObject {
	
	private static $db = array(
		'Version' => 'Varchar(255)'
	);
	
	private static $has_one = array(
		'Box' => 'Box'
	);
	
	private static $has_many = array(
		'Providers' => 'BoxProvider'
	);
	
}