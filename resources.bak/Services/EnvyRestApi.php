<?php

/**
 * Wraps Httpful
 **/
namespace App\Services;

use App\Services\EnvyApi\InvalidResponseException;
use Httpful\Request as ApiRequest;
use Httpful\Request;
use call_user_func;
use Config;

class EnvyRestApi extends Request {

	public function __construct()
	{
		if (session_status() == PHP_SESSION_NONE) session_start();
	}

	/**
	 * Whether an API token has been set
	 * @return bool
	 */
	public function hasApiToken() {
		return (null !== $this->getApiToken());
	}

	/**
	 * Get the API token
	 * @return null
	 */
	public function getApiToken() {
		return (isset($_SESSION['api_token'])) ? $_SESSION['api_token'] : null;
	}

	/**
	 * Set the API token
	 * @param $token
	 */
	public function setApiToken($token) {
		$_SESSION['api_token'] = $token;
	}
	/**
	 * Return the base URL for API requests
	 **/
	private function getApiUrlBase() {
		return Config::get('app.api_url');
	}
	protected function getApiUrl($path, array $query=array()) {
		$query_str = http_build_query($query);
		$url = $this->getApiUrlBase() . $path;
		if (!empty($query_str)) $url .= '?' . $query_str;
		return $url;
	}
	/**
	 * Perform a GET request to the API
	 **/
	protected function apiGet($path, array $vars=array(), callable $modify_request=null) {

		$url = $this->getApiUrl($path, $vars);

		$request = ApiRequest::get($url)
			->expectsJson();

		return $this->response($request, $modify_request);
	}
	/**
	 * Perform a POST request to the API
	 */
	protected function apiPost($path, array $json, callable $modify_request=null) {

		$url = $this->getApiUrl($path);

		$request = ApiRequest::post($url)
			->sendsJson()
			->body(json_encode($json));

		return $this->response($request, $modify_request);
	}
	/**
	 * Perform a PUT request to the API
	 **/
	protected function apiPut($path, array $json, callable $modify_request=null) {

		$url = $this->getApiUrl($path);

		$request = ApiRequest::put($url)
			->sendsJson()
			->body(json_encode($json));

		return $this->response($request, $modify_request);
	}
	/**
	 * Perform a DELETE request to the API
	 **/
	protected function apiDelete($path, callable $modify_request=null) {

		$url = $this->getApiUrl($path);

		$request = ApiRequest::delete($url);

		return $this->response($request, $modify_request);
	}
	/**
	 * Modifies the request, as necessary, and returns response
	 **/
	protected function response(ApiRequest $request, callable $modify_request=null) {

		if (null !== $modify_request) call_user_func($modify_request, $request);

		return $request->send();
	}
	/**
	 * Methods are build up in the format "api{method}" or "api{method}WithAuth"
	 */
	public function __call($method, $args) {
		$api_len = 3;
		$with_auth = 'WithAuth';
		$with_auth_len = strlen($with_auth);

		if (substr($method, 0, $api_len) == 'api') {

			$method = substr($method, $api_len);

			if (substr($method, -$with_auth_len) == $with_auth) {

				$method = strtolower(substr($method, 0, -$with_auth_len));

				/** @var \Illuminate\Http\Request $request */
				$path = array_shift($args);
				$url = $this->getApiUrl($path);
				$body = null;

				if (count($args) > 0) {
					if (strtoupper($method) == 'GET') {
						$q_or_amp = (false === strpos($url, '?')) ? '?' : '&';
						$url .= $q_or_amp . http_build_query($args[0]);
					} else {
						$body = $args[0];
					}
				}

				$request = call_user_func(array('Httpful\Request', $method), $url);
				$request->addHeader('x-access-token', $this->getApiToken());
				$request->expectsJson();

				if (null !== $body) {
					if (is_array($body)) {
						$request->sendsJson();
						$body = json_encode($body);
					}
					$request->body($body);
				}

				$response = $this->response($request);

				if ($response->code != '200') {

					$message = $response->body->message;

					if (false !== stripos($message, 'authorized')) {

						throw new \Illuminate\Auth\AuthenticationException($message);

					} else {

						throw new InvalidResponseException($message);

					}
				}

				return $response;
			}
		}
	}
}