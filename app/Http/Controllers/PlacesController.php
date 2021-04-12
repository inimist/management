<?php

namespace App\Http\Controllers;

use App\Services\EnvyApi\Places as PlacesApi;
use Illuminate\Http\Request;
use App\Http\Requests;

class PlacesController extends ApiConnectedController
{
	public function index(Request $request, PlacesApi $api) {

		if (!empty($request->q)) {
			$places = $api->search($request->q);
            $view = 'search';
		}
		else {
            // display places in review by default
            $places = $api->review();
            $view = 'review';
        }

		return view('places.index', [
			'model' => ['q' => $request->q],
			'view' => $view,
			'places' => $places
		]);
	}
	
	public function show(PlacesApi $api, $id) {
		$place = $api->getPlace($id);
		
		return view('places.show', ['place' => $place]);
	}
	
	public function create(PlacesApi $api) {
		$types = $this->getTypes($api);
        $reviewStatuses = $this->getReviewStatuses($api);

		return view('places.create', ['types' => $types, 'reviewStatuses' => $reviewStatuses]);
	}
	
	public function store(Request $request, PlacesApi $api) {

		$place = $this->getPlaceFromRequest($request);

		$response = $api->createPlace($place);

		return redirect()->route('places.show', ['id' => $response->id]);
	}

	public function update(Request $request, PlacesApi $api, $id) {

		$place = $this->getPlaceFromRequest($request);

		$api->updatePlace($id, $place);

		return redirect()->route('places.show', ['id' => $id]);
	}
		/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(PlacesApi $api, $id)
	{
		$api->deletePlace($id);

		return redirect()->route('places.index', ['message' => 'Place deleted']);
	}
	public function edit(PlacesApi $api, $id=null) {
		
		$place = $api->getPlace($id);
		$types = $this->getTypes($api);
        $reviewStatuses = $this->getReviewStatuses($api);

		return view('places.edit', [
		    'place' => $place,
            'types' => $types,
            'reviewStatuses' => $reviewStatuses
        ]);
	}
	
	public function editAddress($id, $addressId) {}

	public function posts(PlacesApi $api, $id)
	{
		$place = $api->getPlace($id);
		$feed = $api->getPostsByPlaceId($id);

		return view('places.posts', compact('place', 'feed'));
	}

	private function getPlaceFromRequest($request) {
		$this->validate($request, [
			'name' => 'required',
			// 'street1' => 'required',
			'type' => 'required',
			'city' => 'required',
			'state' => 'required',
			// 'zip' => 'required|numeric',
			'latitude' => 'numeric',
			'longitude' => 'numeric',
            'reviewStatus' => 'required'
		]);

		$website = $request->website;
		$reservation_website = $request->reservationWebsite;

		if (substr($website, 0, 4) == 'www.') $website = 'http://' . $website;
		if (substr($reservation_website, 0, 4) == 'www.') $reservation_website = 'http://' . $reservation_website;

		$place = array(
			'name' => $request->name,
			'street1' => $request->street1,
			'street2' => $request->street2,
			'city' => $request->city,
			'state' => $request->state,
			'zip' => $request->zip,
			'phone' => $request->phone,
			'website' => $website,
			'reservationWebsite' => $reservation_website,
			'type' => $request->type,
			'searchMetaData' => $request->searchMetaData,
			'reviewStatus' => $request->reviewStatus,
			'categoryId' => $request->categoryId ? $request->categoryId : null
		);

		if ( ! empty($request->latitude) && ! empty($request->longitude)) {
			$place['coordinates'] = array(
				'latitude' => $request->latitude,
				'longitude' => $request->longitude
			);
		}

		return $place;
	}

	private function getTypes($api) {

		$types = array();

		$api_types = $api->getTypes();
		foreach($api_types as $type) {
			$types[$type->name] = $type->name;
		}

		return $types;
	}

	private function getReviewStatuses($api) {

		$types = array();

		$api_statuses = $api->getReviewStatuses();
		foreach($api_statuses as $type) {
			$types[$type->name] = $type->name;
		}

		return $types;
	}

}
