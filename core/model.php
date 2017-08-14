<?php

class EcwidDashboard {

	public function __construct() {
		$this->blueprints = dir::read(kirby()->roots()->blueprints());
		$this->templates = dir::read(kirby()->roots()->templates());
		$this->snippets = dir::read(kirby()->roots()->snippets());
	}

	public function topbar($topbar) {
		$topbar->append(purl('ecwid'), 'Ecwid');
	}
}
