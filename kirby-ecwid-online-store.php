<?php

load([
	'ecwid\\core\\api'    => __DIR__ . DS . 'core' . DS . 'api.php',
	'ecwid\\core\\oauth'    => __DIR__ . DS . 'core' . DS . 'oauth.php',
	'ecwid' => __DIR__ . DS . 'core' . DS . 'ecwid.php',
	'ecwiddashboard' => __DIR__ . DS . 'core' . DS . 'model.php',
	'ecwidstorepage' => __DIR__ . DS . 'models' . DS . 'ecwid-store.php'
]);

$kirby->set('template', 'ecwid-store',     __DIR__ . '/templates/ecwid-store.php');

$kirby->set('blueprint', 'ecwid-store',     __DIR__ . '/blueprints/ecwid-store.yml');

// Register widgets
$kirby->set('widget',  'ecwid-widget', __DIR__ . DS . 'widgets' . DS . 'ecwid-widget');

kirby()->set('option', 'panel.stylesheet', array(
	kirby()->urls()->index() . '/assets/plugins/kirby-ecwid-online-store/css/panel.css',
));
$stores = $kirby->site()->pages()->filterBy('ecwid', '==', 'true');

foreach ($stores as $store) {
	
	$page = page($store);

	$abc = function() {
		return page('/ecwid');
	};
	kirby()->routes(array(
		array(
			'pattern' => $store . '/(:any)',
			'action' => function($arg) {
				preg_match('!' . preg_quote(Url::index()) . '(.*)' . preg_quote($arg) . '!', Url::current(), $matches);
				return page($matches[1]);
			}
		)
	));
}


if(function_exists('panel') && ($panel = panel()) && site()->user() && site()->user()->hasPanelAccess()) {

	$panel->routes = array_merge([
		[
			'pattern' => 'ecwid/connect',
			'action'  => function() {
				require 'core/oauth.php';
				
				$oauth = new Ecwid\Core\Oauth;
				
				// go() changes urls like "abc.com/def?param=value" making them abc.com/def/?param=value
				header('Location: ' . $oauth->getConnectUrl());
				exit();
			},
			'method'  => 'GET|POST'
		],
		[
			'pattern' => 'ecwid/auth',
			'action'  => function() {
				require 'core/oauth.php';

				$oauth = new Ecwid\Core\Oauth;

				if ($oauth->processAuthorization()) {
					$created = false;
					
					try {
						Page::create('/shop', 'ecwid-store', array('title' => 'Shop', 'ecwid' => true));
						$created = true;
					} catch (Exception $e) {
						
					}
					
					if ($created) {
						panel()->page('/shop')->toggle('last');
					}
				}

				panel()->notify(':)');
				echo '<script>window.close();</script>';
			},
			'method'  => 'GET|POST'
		],
		[
			'pattern' => 'ecwid',
			'action' => function() {
				require 'core/dashboard.php';

				$dashboard = new DashboardController();
				echo $dashboard->index();
			}
		]
	], $panel->routes);
}
