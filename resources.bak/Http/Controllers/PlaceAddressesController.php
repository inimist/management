<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Services\EnvyApi\Places as PlacesApi;

class PlaceAddressesController extends ApiConnectedController
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		throw new \Exception(__METHOD__ . ' not implemented');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$address = [];
		$route = 'placeaddresses.store';
		$form_info = [
			'method' => 'post',
			'route' => $route
		];
		
		return view('placeaddresses.edit', ['address' => $address, 'form_info' => $form_info]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		throw new \Exception(__METHOD__ . ' not implemented');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		throw new \Exception(__METHOD__ . ' not implemented');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(PlacesApi $api, $id, $addressId)
	{	
		$route = 'placeaddresses.update';
		
		$form_info = [
			'route' => [$route, $id, $addressId],
			'method' => 'put',
		];

		$place_address = $api->getAddress($id, $addressId);

		$address = [
			'street1' => $place_address->street1,
			'street2' => $place_address->street2,
			'city' => $place_address->city,
			'state' => $place_address->state,
			'zip' => (isset($place_address->zip)) ? $place_address->zip : '',
			'latitude' => isset($place_address->coordinates) ? $place_address->coordinates->latitude : '',
			'longitude' => isset($place_address->coordinates) ? $place_address->coordinates->longitude : '',
		];
		
		return view('placeaddresses.edit', ['address' => $address, 'form_info' => $form_info]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(PlacesApi $api, Request $request, $id, $addressId)
	{
		$address = array(
			'street1' => $request->street1,
			'street2' => $request->street2,
			'city' => $request->city,
			'state' => $request->state,
			'zip' => $request->zip,
			'coordinates' => array(
				'latitude' => $request->latitude,
				'longitude' => $request->longitude
			)
		);

		$api->updateAddress($id, $addressId, $address);
		
		return redirect()->route('places.show', ['id' => $id]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		throw new \Exception(__METHOD__ . ' not implemented');
	}
	
}