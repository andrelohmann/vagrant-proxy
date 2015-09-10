<?php
/**
 * Implements a basic Controller
 * @package some config
 * http://doc.silverstripe.org/framework/en/3.1/topics/controller
 */
class BoxController extends Controller {
	
	public static $url_topic = 'box';
	
	public static $url_segment = 'box';
	
	private static $allowed_actions = array( 
		'index',
		'json',
		'addVersion',
		'BoxAddVersionForm',
		'editVersion',
		'editVersions'
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
 	}

	/**
	 * Show the "login" page
	 *
	 * @return string Returns the "login" page as HTML code.
	 */
	public function index() {
		
		$this->redirect('home/index');
		
	}

	/**
	 * Show the "login" page
	 *
	 * @return string Returns the "login" page as HTML code.
	 */
	public function json(){
		
		if($Box = Box::get()->byID($this->request->param('ID'))){
			
			
			return $this->jsonResponse($Box->json());
		}else{
			return $this->jsonResponse(array('error' => 'invalid box id'));
		}
	}

	/**
	 * Show the member edit page
	 *
	 * @return string Returns the member edit page as HTML code.
	 */
	public function addVersion() {
            
        if($Box = Box::get()->byID($this->request->param('ID'))) $GLOBALS['BoxID'] = $Box->ID;
            
        return $this->customise(new ArrayData(array(
            "Title" => _t('BoxAddVersion.TITLE', 'BoxAddVersion.TITLE'),
            "Form" => $this->BoxAddVersionForm(),
            "Box" => $Box
        )))->renderWith(
            array('Box_addversion', 'Box', $this->stat('template_main'), $this->stat('template'))
        );
	}
        
    public function BoxAddVersionForm(){
        return BoxAddVersionForm::create($this, "BoxAddVersionForm");
    }
}
