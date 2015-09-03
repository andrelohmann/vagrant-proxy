<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class SlugableDataObject extends DataExtension {

	/**
	 * @config
	 * @var Array See {@link setReplacements()}.
	 */
	private static $default_replacements = array(
		'/&amp;/u' => '-', // ampersands to dashes
		'/&/u' => '-', // ampersands to dashes
		'/\s|\+/u' => '-', // remove whitespace/plus
		'/[_.]+/u' => '-', // underscores and dots to dashes
		'/[^A-Za-z0-9\-]+/u' => '', // remove non-ASCII chars, only allow alphanumeric and dashes
		'/[\-]{2,}/u' => '-', // remove duplicate dashes
		'/^[\-]+/u' => '', // Remove all leading dashes
		'/[\-]+$/u' => '' // Remove all trailing dashes
	);
	
	private static $db = array(
		"Slug" => "Varchar(255)"
	);
	
	public function onBeforeWrite() {
		parent::onBeforeWrite();
		
		$this->owner->Slug = self::Slugify($this->owner->Title);
	}

	/**
	 * Note: Depending on the applied replacement rules, this method might result in an empty string.
	 *
	 * @param String URL path (without domain or query parameters), in utf8 encoding
	 * @return String A filtered path compatible with RFC 3986
	 */
	protected static function Slugify($name) {
		$name = SS_Transliterator::create()->toASCII($name);

		$name = mb_strtolower($name);
		
		foreach(self::$default_replacements as $regex => $replace) {
			$name = preg_replace($regex, $replace, $name);
		}

		return $name;
	}
}