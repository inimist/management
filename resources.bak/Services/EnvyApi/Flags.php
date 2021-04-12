<?php

namespace App\Services\EnvyApi;

use App\Services\EnvyRestApi;

class Flags extends EnvyRestApi
{
	public function getFlags($limit=null, $offset=null)
	{
		$endpoint = '/flags';
		$query = array();

		if ( ! empty($limit)) {
			$query['limit'] = $limit;
			if ( ! empty($offset)) $query['offset'] = $offset;
			$endpoint .= '?' . http_build_query($query);
		}

		$response = $this->apiGetWithAuth($endpoint);

		return $response->body;
	}
}