<?php

namespace App\Http\Controllers;

use App\Services\EnvyApi\Categories as CategoriesApi;
use App\Services\EnvyApi\Filters as FiltersApi;
use Illuminate\Http\Request;
use App\Http\Requests;

//class CategoriesController extends ApiConnectedController
class CategoriesController extends Controller
{
	const TYPE_PRIMARY = 'Primary';
	const TYPE_VIRTUAL = 'Virtual';
	const TYPE_NOUN = 'Noun';

	public function index(CategoriesApi $api, Request $request)
	{
		$popular = $api->getPopularCategories();

		return view('categories.index', ['message' => $request->message, 'popular' => $popular]);
	}

	/**
	 * JSON response for autocompleting category searches
	 */
	public function autocomplete(CategoriesApi $api, Request $request)
	{
		$keyword = $request->q;
		$include_disabled = true;
		$results = $api->searchCategories($keyword, $include_disabled);
		return $results;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function browse(CategoriesApi $api, Request $request)
	{
		$category_id = $request->category;

		$category = $category_id ? $api->getCategory($request->category) : null;
		$include_disabled = true;
		$categories = $api->browseCategories($category_id, $include_disabled);

		return view('categories.browse', compact('categories', 'category'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(Request $request, CategoriesApi $api)
	{
		$types = $this->getTypeOptions();
		$categories = $this->getCategoryOptions($api);
		$type_grid = $this->getTypeDescriptionGrid();
		$parent_id = $request->parentid;
		$enabled = true;
		$featured = ($request->featured !== null);
		$exclude_feed_search = ($request->excludeFeedSearch !== null);

		return view('categories.create', compact('types', 'categories', 'type_grid', 'parent_id', 'enabled', 'featured', 'exclude_feed_search'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request, CategoriesApi $api)
	{
		$this->validate($request, $this->getCategoryValidationFields());

		$enable = ($request->enable !== null);
		$featured = ($request->featured !== null);
		$exclude_feed_search = ($request->excludeFeedSearch !== null);

		$category = array(
			'enable' => $enable,
			'name' => $request->name,
			'type' => $request->type,
			'parentId' => $request->parentId,
			'displayName' => $request->displayName,
			'pluralName' => $request->pluralName,
			'aliases' => preg_split('/\r?\n/', $request->aliases),
            'searchMetaData' => $request->searchMetaData,
			'flags' => array(
				'featured' => $featured,
				'excludeFeedSearch' => $exclude_feed_search
			)
		);

		$errors = $this->checkTypeIssues($category);

		if (count($errors)) {
			return redirect()->back()->withErrors($errors);
		}

		$new_category = $api->createCategory($category);

//		return redirect()->route('categories.index', ['category' => $new_category->id]);
		return redirect()->route('categories.show', ['id' => $new_category->id]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show(CategoriesApi $api, $id)
	{
		$category = $api->getCategoryWithFilters($id);

		return view('categories.show', compact('category'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(CategoriesApi $api, $id)
	{
		$category = $api->getCategory($id);
		$types = $this->getTypeOptions();
		$categories = $this->getCategoryOptions($api, $id);
		$type_grid = $this->getTypeDescriptionGrid();
		$aliases = implode("\n", $category->aliases);
		$featured = false;
		$exclude_feed_search = false;

		if (isset($category->flags)) {
			$flags = $category->flags;
			if (isset($flags->featured)) $featured = $flags->featured;
			if (isset($flags->excludeFeedSearch)) $exclude_feed_search = $flags->excludeFeedSearch;
		}

		

		return view('categories.edit', compact('category', 'types', 'categories', 'type_grid', 'aliases', 'featured', 'exclude_feed_search'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, CategoriesApi $api, $id)
	{
		$this->validate($request, $this->getCategoryValidationFields());

		$enable = ($request->enable !== null);
		$featured = ($request->featured !== null);
		$exclude_feed_search = ($request->excludeFeedSearch !== null);

		$category = array(
			'enable' => $enable,
			'name' => $request->name,
			'type' => $request->type,
			'parentId' => $request->parentId,
			'displayName' => $request->displayName,
			'pluralName' => $request->pluralName,
			'aliases' => preg_split('/\r?\n/', $request->aliases),
			'searchMetaData' => $request->searchMetaData,
			'flags' => array(
				'featured' => $featured,
				'excludeFeedSearch' => $exclude_feed_search
			)
		);

		$errors = $this->checkTypeIssues($category);

		if (count($errors)) {
			return redirect()->back()->withErrors($errors);
		}

		$api->updateCategory($id, $category);

//		return redirect()->route('categories.index', ['category' => $id]);
		return redirect()->route('categories.show', ['id' => $id]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(CategoriesApi $api, $id)
	{
		$api->deleteCategory($id);

		return redirect()->route('categories.index', ['message' => 'Category deleted']);
	}

	public function filtersIndex(CategoriesApi $api, FiltersApi $filtersApi, $category_id)
	{
		$category = $api->getCategoryWithFilters($category_id);
		$available_filters = $filtersApi->getFilters();

		$filters = isset($category->filters) ? $category->filters : array();
		$in_filter_ids = array_map(function($filter) {
			return $filter->id;
		}, $filters);

		$available_filters = array_filter($available_filters, function($filter) use ($in_filter_ids) {
			return ( ! in_array($filter->id, $in_filter_ids));
		});

		return view('categories.filtersindex', compact('category', 'filters', 'available_filters'));
	}

	public function addFilter(CategoriesApi $api, $category_id, $filter_id)
	{
		$api->addFilter($category_id, $filter_id);

		return redirect()->route('categories.filtersIndex', ['categoryId' => $category_id]);
	}

	public function removeFilter(CategoriesApi $api, $category_id, $filter_id)
	{
		$response = $api->removeFilter($category_id, $filter_id);

		return redirect()->route('categories.filtersIndex', ['categoryId' => $category_id]);
	}

	public function setFilterValue(CategoriesApi $api, Request $request, $category_id, $filter_id)
	{
		$values = $request->values;
		if (!is_array($values)) $values = [];

		$api->setFilterValue($category_id, $filter_id, $values);

		return redirect()->route('categories.show', ['id' => $category_id]);
	}

	public function posts(CategoriesApi $api, $id)
	{
		$category = $api->getCategory($id);
		$feed = $api->getPostsByCategoryId($id);

		return view('categories.posts', compact('feed', 'category'));
	}

	public function getTypeOptions()
	{
		$options = array('' => '-- Select --');
		$types = $this->getTypes();
		foreach($types as $type) {
			$options[$type] = $type;
		}

		return $options;
	}

	public function getTypes()
	{
		return array(self::TYPE_PRIMARY, self::TYPE_VIRTUAL, self::TYPE_NOUN);
	}

	private function getCategoryValidationFields() {
		return array(
			'name' => 'required',
			'type' => 'required'
		);
	}

	private function checkTypeIssues(array $category)
	{
		$errors = array();

		$name = $category['name'];
		$type = $category['type'];
		$parentId = $category['parentId'];

		if ($type == self::TYPE_PRIMARY) {
			// No issues
		} else if ($type == self::TYPE_VIRTUAL) {
			if (empty($parentId)) $errors[] = 'Virtual categories cannot be root';
		} else if ($type == self::TYPE_NOUN) {
			if (empty($parentId)) $errors[] = 'Noun categories cannot be root';
		}

		return $errors;
	}

	private function getCategoryOptions(CategoriesApi $api, $exclude_id=null) {

		$api_categories = $api->getCategoriesByType(self::TYPE_PRIMARY);

		/**
		 * Break categories out into parents
		 */
		$by_parent = array();
		foreach($api_categories as $cat) {
			$parent_id = isset($cat->parentId) ? $cat->parentId : 0;
			if (!isset($by_parent[$parent_id])) $by_parent[$parent_id] = array();
			$by_parent[$parent_id][] = $cat;
		}

		$categories = array('' => '-- Root --');

		foreach($this->generateCategoryList($by_parent) as $category_id => $category_name) {
			if ($category_id == $exclude_id) continue;
			$categories[$category_id] = $category_name;
		}

		return $categories;
	}

	private function generateCategoryList($by_parent, $parent_id = '0', $depth = 0)
	{
		$children = (isset($by_parent[$parent_id])) ? $by_parent[$parent_id] : array();
		$results = array();
		foreach($children as $child) {
			$results[$child->id] = str_repeat('&nbsp;', 2*$depth) . $child->name;
			$results = array_merge($results, $this->generateCategoryList($by_parent, $child->id, $depth+1));
		}

		return $results;
	}

	private function getTypeDescriptionGrid()
	{
		return array(
			'headers' => array('Primary', 'Virtual', 'Noun'),
			'rows' => array(
				'Description' => array(
					'Container category for noun and virtual categories',
					'Pre-packaged filters (e.g. a virtual Breakfast category could specify Food &amp; Meal=Breakfast',
					'The most specific category that describes an object'
				),
				'Can be top-level?' => array(
					'Yes',
					'No',
					'No'
				),
				'Can have children?' => array(
					'Yes',
					'No',
					'No'
				),
				'Assigned to post?' => array(
					'No',
					'No',
					'Yes'
				),
				'Has filters (e.g. Meal)?' => array(
					'Yes',
					'Yes',
					'No'
				),
				'Has filter values (e.g. Meal=Breakfast)?' => array(
					'No',
					'Yes',
					'Yes'
				),
				'Use can assign filters?' => array(
					'Yes',
					'Yes',
					'No'
				)
			)
		);

	}
}