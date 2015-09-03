<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class BoxAddForm extends BootstrapHorizontalForm {
    
    public function __construct($controller, $name, $fields = null, $actions = null) {
        
        $fields = new FieldList(
            TextField::create('Title')->setTitle(_t('Box.TITLE', 'Box.TITLE')),
            TextareaField::create('Description')->setTitle(_t('Box.DESCRIPTION', 'Box.DESCRIPTION')),
            CheckboxField::create("Public")->setTitle(_t('Box.PUBLIC', 'Box.PUBLIC')),
			$Members = CheckboxSetField::create('Members')->setTitle(_t('Box.MEMBERS', 'Box.MEMBERS'))->setSource(Member::get()->map('ID', 'Name'))
        );
        
        $actions = new FieldList(
            $Submit = BootstrapLoadingFormAction::create('doAdd')->setTitle(_t('BoxAddForm.DOADD', 'BoxAddForm.DOADD'))
        );
         
        parent::__construct(
            $controller,
            $name,
            $fields,
            $actions,
            new RequiredFields(
                "Title",
                "Description"
            )
        );
    }
    
    public function doAdd(array $data) {
            
        if($Box = Box::get()->filter(array("Title" => $data['Title']))->first()){
            $this->addErrorMessage('Title', _t('BoxAddForm.TITLEEXISTS', 'BoxAddForm.TITLEEXISTS'), 'bad');
            $this->controller->redirectBack();
            return false;
        }
        
        $Box = Member::create();
        
        $this->saveInto($Box);
        
        $Box->write();
        
        $this->controller->redirect('boxadmin/boxes');
    }
}

