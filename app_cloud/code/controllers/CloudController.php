<?php
/**
 * Implements a basic Controller
 * @package some config
 * http://doc.silverstripe.org/framework/en/3.1/topics/controller
 */
class CloudController extends Controller {
	
	public static $url_topic = 'cloud';
	
	public static $url_segment = 'cloud';
	
	private static $allowed_actions = array( 
		'index'
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
                
        if(!Member::currentUser()) $this->redirect('Security/login?BackURL=cloud/index');
 	}

	/**
	 * Show the "login" page
	 *
	 * @return string Returns the "login" page as HTML code.
	 */
	public function index() {
		
        // Vorerst keine Seite erstellt
        return $this->customise(new ArrayData(array(
            "Title" => _t('Cloud.TITLE', 'Cloud.TITLE'),
			"Content" => _t('Cloud.CONTENT', 'Cloud.CONTENT'),
            "PublicBoxes" => Box::get()->filter(array('Public' => true)),
			"MyBoxes" => Member::currentUser()->Boxes()
        )))->renderWith(
            array('Cloud_index', 'Home', $this->stat('template_main'), $this->stat('template'))
        );
	}
}
