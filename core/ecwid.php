<?php

class Ecwid
{
	static $instance = null;
	protected $config = null;
	
	protected function __construct()
	{
		$this->config = data::read($this->configFile());
	}
	
	protected static function getInstance()
	{
		if (self::$instance == null) {
			self::$instance = new Ecwid();
		}	
		
		return self::$instance;
	}
	
	
	public static function set($name, $value)
	{
		$that = self::getInstance();

		$that->config[$name] = $value;
		
		data::write($that->configFile(), $that->config);
	}
	
	public static function get($name)
	{
		$that = self::getInstance();
		
		return $that->config[$name];
	}
	
	public static function encrypt($value)
	{
		return crypt::encode($value);
	}
	
	public static function decrypt($value)
	{
		return crypt::decode($value);
	}
	
	public static function getBackendUrl()
	{
		$panelUrl = kirby()->urls()->index() . '/' . kirby()->option('plugin.installer.panel.uri', 'panel');

		return $panelUrl;
	}
	
	protected function configFile()
	{
		return kirby()->roots()->config() . '/ecwid.json';
	}
	
}