<?php

namespace App\Services\EnvyApi;

use App\Services\EnvyRestApi;
use Httpful\Request as ApiRequest;
use Illuminate\Auth\AuthenticationException;

class Places extends EnvyRestApi {

	const FEED_PLACES = 'places';

	public function search($keyword)
	{
		$response = $this->apiGetWithAuth('/places/search', ['q' => $keyword]);

		return $response->body->places;
	}

	public function createPlace(array $place)
	{
		$response = $this->apiPostWithAuth('/places', $place);

		return $response->body->place;
	}

	public function getPlace($id)
	{
		$response = $this->apiGetWithAuth('/places/' . $id);

		return $response->body->place;
	}

	public function updatePlace($id, array $place)
	{
		$this->apiPutWithAuth('/places/' . $id, $place);

		return true;
	}

	public function getAddress($id, $address_id)
	{
		$endpoint = sprintf('/places/%s/addresses/%s', $id, $address_id);
		$response = $this->apiGetWithAuth($endpoint);

		return $response->body->address;
	}

	public function updateAddress($id, $address_id, $address)
	{
		$endpoint = sprintf('/places/%s/addresses/%s', $id, $address_id);
		$this->apiPutWithAuth($endpoint, $address);

		return true;
	}

	public function getTypes()
	{
		$response = $this->apiGetWithAuth('/places/types');

		return $response->body->types;
	}

	public function getPostsByPlaceId($place_id)
	{
		$response = $this->apiGetWithAuth('/feeds/' . self::FEED_PLACES . '/' . $place_id);

		return $response->body->results;
	}
}