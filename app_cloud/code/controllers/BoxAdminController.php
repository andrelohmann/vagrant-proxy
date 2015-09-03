<?php
/**
 * Implements a basic Controller
 * @package some config
 * http://doc.silverstripe.org/framework/en/3.1/topics/controller
 */
class BoxAdminController extends Controller {
	
	public static $url_topic = 'administration';
	
	public static $url_segment = 'boxadmin';
	
	private static $allowed_actions = array( 
		'index',
        'boxes',
        'boxAdd',
        'BoxAddForm',
        'boxEdit',
        'BoxEditForm'
	);
	
	public static $template = 'BlankPage';
	
	/**
	 * Template thats used to render the pages.
	 *
	 * @var string
	 */
	public static $template_main = 'Page';

	/**
	 * Returns a link to this controller.  Overload with your own Link rules if they exist.
	 */
	public function Link() {
		return self::$url_segment .'/';
	}
	
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
            $this->redirect('boxadmin/boxes');
	}

	/**
	 * Show members list
	 *
	 * @return string Returns the members page as HTML code.
	 */
	public function boxes(){
		
		return $this->customise(new ArrayData(array(
			"Title" => _t('AdminBoxes.TITLE', 'AdminBoxes.TITLE'),
			"Boxes" => Box::get()
		)))->renderWith(
			array('BoxAdmin_boxes', 'BoxAdmin', $this->stat('template_main'), $this->stat('template'))
        );
	}

	/**
	 * Show the member add page
	 *
	 * @return string Returns the member add page as HTML code.
	 */
	public function boxAdd() {
		
		return $this->customise(new ArrayData(array(
            "Title" => _t('AdminBoxAdd.TITLE', 'AdminBoxAdd.TITLE'),
            "Form" => $this->BoxAddForm()
        )))->renderWith(
            array('BoxAdmin_boxadd', 'BoxAdmin', $this->stat('template_main'), $this->stat('template'))
        );
	}
        
    public function BoxAddForm(){
        return BoxAddForm::create($this, "BoxAddForm");
    }

	/**
	 * Show the member edit page
	 *
	 * @return string Returns the member edit page as HTML code.
	 */
	public function boxEdit() {
            
        if($Box = Box::get()->byID($this->request->param('ID'))) $GLOBALS['BoxID'] = $Box->ID;
            
        return $this->customise(new ArrayData(array(
            "Title" => _t('AdminBoxEdit.TITLE', 'AdminBoxEdit.TITLE'),
            "Form" => $this->BoxEditForm(),
            "Box" => $Box
        )))->renderWith(
            array('BoxAdmin_boxedit', 'BoxAdmin', $this->stat('template_main'), $this->stat('template'))
        );
	}
        
    public function BoxEditForm(){
        return BoxEditForm::create($this, "BoxEditForm");
    }
}
