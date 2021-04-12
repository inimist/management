<?php

namespace App\Services\EnvyApi;

use App\Services\EnvyRestApi;
use Httpful\Request as ApiRequest;
use Illuminate\Auth\AuthenticationException;

class Stats extends EnvyRestApi {
	public function getOverview()
	{
		$response = $this->apiGetWithAuth('/stats/overview');

		return $response->body;
	}
}