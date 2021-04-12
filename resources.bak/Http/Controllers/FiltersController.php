<?php

namespace App\Http\Controllers;

use App\Services\EnvyApi\Filters as FiltersApi;
use Illuminate\Http\Request;
use App\Http\Requests;

class FiltersController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(FiltersApi $api)
	{
		$filters = $api->getFilters();
		
		return view('filters.index', compact('filters'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('filters.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request, FiltersApi $api)
	{

		$this->validate($request, [
			'name' => 'required',
			'fullName' => 'required',
			'values' => 'required'
		]);

		$new_filter = $api->createFilter([
			'name' => $request->name,
			'fullName' => $request->fullName,
			'values' => $this->valuesForSaving($request->values)
		]);

		return redirect()->route('filters.show', ['id' => $new_filter->id]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show(FiltersApi $api, $id)
	{
		$filter = $api->getFilter($id);

		return view('filters.show', compact('filter'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(FiltersApi $api, $id)
	{
		$filter = $api->getFilter($id);
		$filter->values = $this->valuesForTextarea($filter);

		return view('filters.edit', compact('filter'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, FiltersApi $api, $id)
	{
		$this->validate($request, [
			'name' => 'required',
			'fullName' => 'required',
			'values' => 'required'
		]);

		$api->updateFilter($id, [
			'name' => $request->name,
			'fullName' => $request->fullName,
			'values' => $this->valuesForSaving($request->values)
		]);

		return redirect()->route('filters.show', ['id' => $id]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(FiltersApi $api, $id)
	{
		$api->deleteFilter($id);

		return redirect()->route('filters.index');
	}

	private function valuesForTextArea($filter) {
		return isset($filter->values) && is_array($filter->values) ? implode("\n", $filter->values) : '';
	}

	private function valuesForSaving($filters_text) {
		return preg_split("#\r?\n#", trim($filters_text));
	}
}