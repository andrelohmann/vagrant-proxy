<?php

/**
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Box extends DataObject {
	
	private static $db = array(
		'Title' => 'Varchar(255)',
		'Description' => 'Text',
		'Public' => 'Boolean'
	);
	
	private static $has_many = array(
		'Versions' => 'BoxVersion'
	);
	
	private static $belongs_many_many = array(
		'Members' => 'Member'
	);
	
	public function onBeforeDelete() {
		parent::onBeforeDelete();
		
		foreach($this->Versions() as $Version){
			$Version->delete();
		}
	}
	
	public function Link(){
		return Director::absoluteBaseURL()."box/json/".$this->ID."/".$this->Slug;
	}
	
	public function json(){
		
		$json = array(
			"name" => $this->Slug,
			"description" => $this->Description,
			"versions" => array()
		);
		
		foreach($this->Versions()->sort('Version') as $Version){
			$providers = array();
			foreach($Version->Providers() as $Provider){
				$providers[] = array(
					"name" => $Provider->Name,
					"url" => $Provider->File()->getAbsoluteURL(),
					"checksum_type" => $Provider->ChecksumType,
					"checksum" => $Provider->Checksum
				);
			}
			$json['versions'][] = array(
				"version" => $Version->Version,
				"providers" => $providers
			);
		}
		
		return $json;
	}
	
}