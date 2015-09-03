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
		'json'
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
			
			$json = array(
				"name" => $Box->Slug,
				"description" => $Box->Description,
				"versions" => array()
			);
			
			foreach($Box->Versions()->sort('Version') as $Version){
				$providers = array();
				foreach($Version->Providers() as $Provider){
					$providers[] = array(
						"name" => $Provider->Name,
						"url" => $Provider->File()->getAbsoluteURL(),
						"checksum_type" => $Provider->ChecksumType,
						"checksum" => $Provider->Checksum
					);
				}
				$json['versions'][] = array(
					"version" => $Version->Version,
					"providers" => $providers
				);
			}
			
			
			return $this->jsonResponse($json);
		}else{
			return $this->jsonResponse(array('error' => 'invalid box id'));
		}
            
		
	}
}
