<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CloudMember extends DataExtension {
	
	private static $many_many = array(
		'Boxes' => 'Box'
	);
    
    public function IsAdmin(){
        return Permission::check('ADMIN', "any", $this->owner);
    }
	
	public function IsContentAuthor(){
		return $this->owner->inGroup('content-authors') || Permission::check('ADMIN', "any", $this->owner);
	}
    
}