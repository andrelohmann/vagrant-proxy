<?php
/**
 * Implements a basic Controller
 * @package some config
 * http://doc.silverstripe.org/framework/en/3.1/topics/controller
 */
class AdministrationController extends Controller {
	
	public static $url_topic = 'administration';
	
	public static $url_segment = 'administration';
	
	private static $allowed_actions = array( 
		'index',
		'members',
        'memberAdd',
        'MemberAddForm',
        'memberEdit',
        'MemberEditForm'
	);
	
	public static $template = 'BlankPage';
	
	/**
	 * Template thats used to render the pages.
	 *
	 * @var string
	 */
	public static $template_main = 'Page';
	
	/**
	 * Initialise the controller
	 */
	public function init() {
		parent::init();
                
        if(!Member::currentUser() || !Member::currentUser()->IsAdmin()) $this->redirect('cloud/index');
 	}

	/**
	 * Show the "login" page
	 *
	 * @return string Returns the "login" page as HTML code.
	 */
	public function index() {
            $this->redirect('administration/members');
	}

	/**
	 * Show members list
	 *
	 * @return string Returns the members page as HTML code.
	 */
	public function members(){
		
		return $this->customise(new ArrayData(array(
			"Title" => _t('AdminMembers.TITLE', 'AdminMembers.TITLE'),
			"Members" => Member::get()
		)))->renderWith(
			array('Administration_members', 'Administration', $this->stat('template_main'), $this->stat('template'))
        );
	}

	/**
	 * Show the member add page
	 *
	 * @return string Returns the member add page as HTML code.
	 */
	public function memberAdd() {
		
		return $this->customise(new ArrayData(array(
            "Title" => _t('AdminMemberAdd.TITLE', 'AdminMemberAdd.TITLE'),
            "Form" => $this->MemberAddForm()
        )))->renderWith(
            array('Administration_memberadd', 'Administration', $this->stat('template_main'), $this->stat('template'))
        );
	}
        
    public function MemberAddForm(){
        return MemberAddForm::create($this, "MemberAddForm");
    }

	/**
	 * Show the member edit page
	 *
	 * @return string Returns the member edit page as HTML code.
	 */
	public function memberEdit() {
            
        if($Member = Member::get()->byID($this->request->param('ID'))) $GLOBALS['MemberID'] = $Member->ID;
            
        return $this->customise(new ArrayData(array(
            "Title" => _t('AdminMemberEdit.TITLE', 'AdminMemberEdit.TITLE'),
            "Form" => $this->MemberEditForm(),
            "Member" => $Member
        )))->renderWith(
            array('Administration_memberedit', 'Administration', $this->stat('template_main'), $this->stat('template'))
        );
	}
        
    public function MemberEditForm(){
        return MemberEditForm::create($this, "MemberEditForm");
    }
}
