<?php
// https://getkirby.com/docs/developer-guide/advanced/models

class EcwidStorePage extends Page {
	protected $widgets;
	
	public function __construct() 
	{
		parent::_construct();
	}
	
	
	public function getStoreId()
	{
		return \Ecwid::get('storeID');
	}
}
