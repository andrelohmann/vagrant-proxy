<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class DefaultGroups extends DataExtension{
    
    // Set Default Frontend group for new members
    public function requireDefaultRecords() {
        parent::requireDefaultRecords();
    
        // Add default FrontendMember group if none with permission code ADMIN exists
        if(!defined('CreateDefaultGroupsOnce')){
            define('CreateDefaultGroupsOnce', true);
			
			$authorGroup = Group::get_one("Group", "Code='content-authors'");
			if(!$authorGroup){
				$authorGroup = new Group();
				$authorGroup->Code = 'content-authors';
				$authorGroup->Title = _t('Group.DefaultGroupTitleContentAuthors', 'Content Authors');
				$authorGroup->Sort = 1;
				$authorGroup->write();
				Permission::grant($authorGroup->ID, 'CMS_ACCESS_CMSMain');
				Permission::grant($authorGroup->ID, 'CMS_ACCESS_AssetAdmin');
				Permission::grant($authorGroup->ID, 'CMS_ACCESS_ReportAdmin');
				Permission::grant($authorGroup->ID, 'SITETREE_REORGANISE');
			}
			Permission::grant($authorGroup->ID, 'ACCESS_CONTENT');
            DB::alteration_message('Content Authors Group Permissions added',"created");
        }
    }
}