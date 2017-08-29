<?php


namespace Ecwid\Core;
use Panel;
use Remote;
use Ecwid;

class OAuth
{
	public function getConnectUrl()
	{
		$api = new API;
		
		$base = 'https://my.ecwid.com/api/oauth/authorize';
		
		$params = array(
			'client_id' => $api->getClientID(),
			'redirect_uri' => urlencode($this->getRedirectUrl()),
			'response_type' => 'code',
			'scope' => $this->getScope(),
			'partner' => 'kirby'
		);
		
		return $base . '?' . http_build_query($params);
	}
	
	public function processAuthorization()
	{

		if (isset($_REQUEST['error']) || !isset($_REQUEST['code'])) {
			return $this->redirectOnOauthError('request_error');
		}

		$api = new API;
		
		$params = array();
		$params['code'] = $_REQUEST['code'];
		$params['client_id'] = $api->getClientId();
		$params['client_secret'] = $api->getClientSecret();
		$params['redirect_uri'] = $this->getRedirectUrl();
		$params['grant_type'] = 'authorization_code';

		$result = remote::post($this->getTokenUrl(), array('data' => $params));

		$response_object = null;
		if ($result->code == 200) {
			$response_object = json_decode($result->content);
		}
		
		if (!$response_object) {
			return $this->redirectOnOauthError('token_response_object_error');
		}

		if (
			!isset($response_object->store_id)
			|| !isset($response_object->scope)
			|| !isset($response_object->access_token)
			|| ($response_object->token_type != 'Bearer')
		) {
			return $this->redirectOnOauthError('token_response_contents_error');
		}
		
		$api->setToken($response_object->access_token);
		$api->setScope($response_object->scope);
		
		Ecwid::set('storeID', $response_object->store_id);
		
		return true;
	}
	
	protected function getScope()
	{
		return 'read_catalog read_store_profile allow_sso';
	}
	
	protected function redirectOnOauthError($error)
	{
		$backUrl = Ecwid::getBackendUrl();
		panel()->notify($error);
		return go($backUrl);
	}
	
	protected function getTokenUrl()
	{
		return 'https://my.ecwid.com/api/oauth/token';
	}


	protected function getRedirectUrl()
	{
		$panelUrl = Ecwid::getBackendUrl();

		$panelUrl .= '/ecwid/auth';

		return $panelUrl;
	}
}