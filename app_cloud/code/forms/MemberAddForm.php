<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class MemberAddForm extends BootstrapHorizontalForm {
    
    public function __construct($controller, $name, $fields = null, $actions = null) {
        
        $fields = new FieldList(
            TextField::create('FirstName')->setTitle('Vorname'),
            TextField::create('Surname')->setTitle('Nachname'),
            EmailField::create('Email')->setTitle('Email'),
            BootstrapConfirmedPasswordField::create('Password')->setTitle('Passwort'),
            CheckboxField::create("Author")->setTitle("Content Author"),
            CheckboxField::create("Admin")->setTitle("Administrator")
        );
        
        $actions = new FieldList(
            $Submit = BootstrapLoadingFormAction::create('doAdd')->setTitle('Benutzer hinzufügen')
        );
         
        parent::__construct(
            $controller,
            $name,
            $fields,
            $actions,
            new RequiredFields(
                "FirstName",
                "Surname",
                "Email",
                "Password"
            )
        );
    }
    
    public function doAdd(array $data) {
            
        if($Member = Member::get()->filter(array("Email" => $data['Email']))->first()){
            $this->addErrorMessage('Email', 'Die Emailadresse ist bereits vergeben.', 'bad');
            $this->controller->redirectBack();
            return false;
        }
        
        $Member = new Member();
        
        $this->saveInto($Member);
        
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
        
        $this->controller->redirect('administration/members');
    }
}

