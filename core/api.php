<?php

namespace Ecwid\Core;
use Ecwid;

class API
{
	const CLIENT_ID = 'kirby';
	const CLIENT_SECRET = 'RuLJzobVyCkWqZVxnzMABkFpdMQeKN8C';
	
	const TOKEN_OPTION_NAME = 'token';
	const SCOPE_OPTION_NAME = 'scope';
	
	public function getClientID()
	{
		return self::CLIENT_ID;
	}
	
	public function getClientSecret()
	{
		return self::CLIENT_SECRET;
	}
	
	public function setToken($token)
	{
		Ecwid::set(
			self::TOKEN_OPTION_NAME,
			base64_encode(Ecwid::encrypt($token))
		);
	}
	
	public function getToken()
	{
		$value = Ecwid::get(self::TOKEN_OPTION_NAME);
		$value = base64_decode($value);
		$value = Ecwid::decrypt($value);
		
		return $value;
	}
	
	public function setScope($scope)
	{
		Ecwid::set(
			self::SCOPE_OPTION_NAME,
			$scope
		);
	}
}
