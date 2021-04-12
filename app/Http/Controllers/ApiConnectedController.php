<?php

/**
 * Helper base class to handle API requests
 **/
namespace App\Http\Controllers;

use Httpful\Exception\ConnectionErrorException;
use Httpful\Request as ApiRequest;
use Illuminate\Http\Request;
use App\Http\Requests;
use Config;

class ApiConnectedController extends Controller
{
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
	private function response(ApiRequest $request, callable $modify_request=null) {

		if (null !== $modify_request) call_user_func($modify_request, $request);

		return $request->send();
	}
}