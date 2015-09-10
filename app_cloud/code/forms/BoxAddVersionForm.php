<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class BoxAddVersionForm extends BootstrapHorizontalForm {
    
    public function __construct($controller, $name, $fields = null, $actions = null) {
        
        $fields = new FieldList(
            $Version = BootstrapSemVerField::create('Version')->setTitle(_t('BoxVersion.VERSION', 'BoxVersion.VERSION')),
            $Description = TextareaField::create('Description')->setTitle(_t('Box.DESCRIPTION', 'Box.DESCRIPTION')),
			$File = new BootstrapUploadField('File', _t('Box.FILE', 'Box.FILE')),
			$BoxID = HiddenField::create('BoxID')
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
                "Version",
                "Description",
				"File",
				"BoxID"
            )
        );
        
        if(isset($GLOBALS['BoxID'])){
            $Box = Box::get()->byID($GLOBALS['BoxID']);
			$BoxID->setValue($Box->ID);
			$Description->setValue($Box->Description);
		
			$File->setFolderName("Uploads/Boxes/".$Box->Slug);
		}
			
		// Upload Parameters
		$exts = array('box');
		$validator = new Upload_Validator();
		$validator->setAllowedExtensions($exts);
		//$validator->setAllowedMaxFileSize(5000000);
		$upload = Upload::create();
		$upload->setValidator($validator);
		
		$File->setUpload($upload);
		
		$this->loadDataFrom(singleton('BoxProvider'));
    }
    
    public function doAdd(array $data) {
		
		//print_r($data, true); die();
            
        if($Box = Box::get()->byID($data['BoxID'])){
			
			$Box->Description = $data['Description']; // Update Description
			$Box->write();
			
			$Version = new BoxVersion();
			$Version->Version = $data['Version'];
			$Version->BoxID = $Box->ID;
			$Version->write();
			
			$Provider = new BoxProvider();
			$Provider->Name = 'virtualbox';
			$Provider->VersionID = $Version->ID;
			$Provider->ChecksumType = 'sha1';
			
			$this->saveInto($Provider);
			//$Provider->write();
			
			$Provider->Checksum = sha1_file($Provider->File()->getFullPath());
			$Provider->write();
        }else{
			$this->sessionMessage(_t('BoxAddVersionForm.INVALIDBOX', 'BoxAddVersionForm.INVALIDBOX'), 'bad');
            return $this->controller->redirectBack();
		}
        
        $this->controller->redirect('cloud/index');
    }
}