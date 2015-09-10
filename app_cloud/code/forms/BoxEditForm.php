<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class BoxEditForm extends BootstrapHorizontalForm {
    
    public function __construct($controller, $name, $fields = null, $actions = null) {
        
        $fields = new FieldList(
			ReadonlyField::create('Title')->setTitle(_t('Box.TITLE', 'Box.TITLE')),
            TextareaField::create('Description')->setTitle(_t('Box.DESCRIPTION', 'Box.DESCRIPTION')),
            CheckboxField::create("Public")->setTitle(_t('Box.PUBLIC', 'Box.PUBLIC')),
			$Members = CheckboxSetField::create('Members')->setTitle(_t('Box.MEMBERS', 'Box.MEMBERS'))->setSource(Member::get()->map('ID', 'Name')),
            HiddenField::create('BoxID')
        );
        
        $actions = new FieldList(
            $Submit = BootstrapLoadingFormAction::create('doEdit')->setTitle(_t('BoxEditForm.DOEDIT', 'BoxEditForm.DOEDIT'))
        );
         
        parent::__construct(
            $controller,
            $name,
            $fields,
            $actions,
            new RequiredFields(
                "Description"
            )
        );
        
        if(isset($GLOBALS['BoxID'])){
            $Box = Box::get()->byID($GLOBALS['BoxID']);
            $this->loadDataFrom($Box);
        }
    }
    
    public function doEdit(array $data) {
        
        if($Box = Box::get()->byID($data['ID'])){
        
            $this->saveInto($Box);
            
            $Box->write();
        }
        
        $this->controller->redirect('boxadmin/boxes');
    }
}

