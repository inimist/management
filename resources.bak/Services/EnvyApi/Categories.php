<?php

namespace App\Services\EnvyApi;

use App\Services\EnvyRestApi;
use Httpful\Request as ApiRequest;
use Illuminate\Auth\AuthenticationException;

class Categories extends EnvyRestApi
{
	const FEED_CATEGORIES = 'categories';

	public function getCategories()
	{
		$response = $this->apiGetWithAuth('/categories');

		return $response->body->categories;
	}

	public function getPopularCategories()
	{
		return $this->apiGetWithAuth('/categories/popular')->body->categories;
	}

	public function searchCategories($keyword, $includeDisabled=false)
	{
		$query = array('q' => $keyword);
		if ($includeDisabled) $query['disabled'] = 'true';
		$response = $this->apiGetWithAuth('/categories/search', $query);

		return $response->body->categories;
	}

	public function getCategoriesByType($type)
	{
		$endpoint = '/categories';
		$endpoint .= '?type=' . $type;
		$endpoint .= '&disabled=true';

		$response = $this->apiGetWithAuth($endpoint);

		return $response->body->categories;
	}

	public function browseCategories($parent_id=null, $includeDisabled=false)
	{
		$endpoint = '/categories/browse';
		if (null !== $parent_id) $endpoint .= '/'.$parent_id;

		if ($includeDisabled) $endpoint .= '?disabled=true';

		$response = $this->apiGetWithAuth($endpoint);

		return $response->body->categories;
	}

	public function createCategory(array $category)
	{
		$response = $this->apiPostWithAuth('/categories/', $category);

		return $response->body->category;
	}

	public function getCategory($id)
	{
		$response = $this->apiGetWithAuth('/categories/' . $id);

		return $response->body;
	}

	public function getCategoryWithFilters($id)
	{
		$response = $this->apiGetWithAuth('/categories/' . $id, array('filters' => 'true', 'values' => 'true'));

		return $response->body;

	}

	public function updateCategory($id, array $category)
	{
		$this->apiPutWithAuth('/categories/' . $id, $category);

		return true;
	}

	public function deleteCategory($id)
	{
		$this->apiDeleteWithAuth('/categories/' . $id);

		return true;
	}

	public function addFilter($category_id, $filter_id)
	{
		$response = $this->apiPostWithAuth('/categories/' . $category_id . '/filters/' . $filter_id);

		return $response->body;
	}

	public function removeFilter($category_id, $filter_id)
	{
		$response = $this->apiDeleteWithAuth('/categories/' . $category_id . '/filters/' . $filter_id);

		return $response->body;
	}

	public function setFilterValue($category_id, $filter_id, $values)
	{
		$response = $this->apiPutWithAuth('/categories/' . $category_id . '/filters/' . $filter_id . '/values', array('values' => $values));

		return array('success' => true);
	}

	public function getPostsByCategoryId($category_id)
	{
		$response = $this->apiGetWithAuth('/feeds/' . self::FEED_CATEGORIES . '/' . $category_id);

		return $response->body->results;
	}
}