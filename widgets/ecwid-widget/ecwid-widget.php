<?php
// https://getkirby.com/docs/developer-guide/panel/widgets

return array(
	'title' => array(
		'text' => 'Ecwid Online Store',
		'target' => '_blank',
		'compressed' => false
	),
/*	'options' => array(
		array(
			'text' => 'Boiler option',
			'icon' => 'pencil',
			'key'  => 'e',
			'modal' => false,
			'link' => 'link/to/option',
			'target' => '_blank'
		)
	),
*/	'html' => function() {
		return tpl::load( __DIR__ . DS . 'template.php', array(
		));
	}
);