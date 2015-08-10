<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class MemberEditForm extends BootstrapHorizontalForm {
    
    public function __construct($controller, $name, $fields = null, $actions = null) {
        
        $fields = new FieldList(
            TextField::create('FirstName')->setTitle('Vorname'),
            TextField::create('Surname')->setTitle('Nachname'),
            ReadonlyField::create('Email')->setTitle('Email'),
            BootstrapConfirmedPasswordField::create('Password')->setTitle('Passwort')->setShowOnClick(true),
            $isAuthor = CheckboxField::create("Author")->setTitle("Content Author"),
            $isAdmin = CheckboxField::create("Admin")->setTitle("Administrator"),
            HiddenField::create('ID')
        );
        
        $actions = new FieldList(
            $Submit = BootstrapLoadingFormAction::create('doEdit')->setTitle('Änderungen speichern')
        );
         
        parent::__construct(
            $controller,
            $name,
            $fields,
            $actions,
            new RequiredFields(
                "FirstName",
                "Surname"
            )
        );
        
        if(isset($GLOBALS['MemberID'])){
            $Member = Member::get()->byID($GLOBALS['MemberID']);
            $this->loadDataFrom($Member);
            if($Member->IsAdmin()) $isAdmin->setValue(true);
            if($Member->IsContentAuthor()) $isAuthor->setValue(true);
        }
    }
    
    public function doEdit(array $data) {
        
        if($Member = Member::get()->byID($data['ID'])){
        
            $this->saveInto($Member);
            
            $Member->changePassword($data['Password']['_Password']);

            $Member->Changed = true;

            $Member->write();
        
			// find a group with ADMIN permission
			$adminGroup = Group::get()->where("Code='administrators'")->First();

			// Member noch als Administrator festlegen
			if(isset($data['Admin'])){
				$adminGroup->Members()->add($Member);
			}else{
				$adminGroup->Members()->remove($Member);
			}

			// find a group with ADMIN permission
			$authorGroup = Group::get()->where("Code='content-authors'")->First();

			// Member noch als Administrator festlegen
			if(isset($data['Author'])){
				$authorGroup->Members()->add($Member);
			}else{
				$authorGroup->Members()->remove($Member);
			}
        }
        
        $this->controller->redirect('administration/members');
    }
}
