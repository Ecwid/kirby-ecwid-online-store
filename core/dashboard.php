<?php

use Kirby\Panel\View;
use Kirby\Panel\Topbar;
use Kirby\Panel\Models;

class DashboardController extends Kirby\Panel\Controllers\Base {

	public function index() {

		$model = new EcwidDashboard;
		
		$content = new View('core/dashboard-template', array('iframeSrc' => $this->getIframeSrc()));
		$content->_root = dirname(__DIR__);
		return $this->layout('app', [
			'topbar' => new Topbar('ecwid', $model),
			'content' => $content
		]);
	}


	public function getIframeSrc() {
		$api = new \Ecwid\Core\API();
		$time = time();

		return sprintf(
			'https://my.ecwid.com/api/v3/%s/sso?token=%s&timestamp=%s&signature=%s&place=%s&inline&&min-height=700',
			Ecwid::get('storeID'),
			$api->getToken(),
			$time,
			hash( 'sha256', Ecwid::get('storeID') . $api->getToken() . $time . $api->getClientSecret() ),
			'dashboard'
		);
	}
}
