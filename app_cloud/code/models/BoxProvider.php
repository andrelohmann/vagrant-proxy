<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class BoxProvider extends DataObject {
	
	private static $db = array(
		'Name' => "Enum('virtualbox')",
		'ChacksumType' => "Enum('sha1')",
		'Checksum' => 'Varchar(255)'
	);
	
	private static $has_one = array(
		'Version' => 'BoxVersion',
		'File' => 'File'
	);
	
	public function onBeforeDelete() {
		parent::onBeforeDelete();
		
		$this->File()->delete();
	}
	
}