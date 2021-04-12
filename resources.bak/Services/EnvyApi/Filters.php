<?php

namespace App\Services\EnvyApi;

use App\Services\EnvyRestApi;

class Filters extends EnvyRestApi {

	public function getFilters()
	{
		$response = $this->apiGetWithAuth('/categories/filters');

		return $response->body->results;
	}

	public function createFilter(array $filter)
	{
		$response = $this->apiPostWithAuth('/categories/filters', $filter);

		return $response->body->categoryFilter;
	}

	public function getFilter($id)
	{
		$response = $this->apiGetWithAuth('/categories/filters/' . $id);

		return $response->body;
	}

	public function updateFilter($id, array $filter)
	{
		$this->apiPutWithAuth('/categories/filters/' . $id, $filter);

		return true;
	}
}