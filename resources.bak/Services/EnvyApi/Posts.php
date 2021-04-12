<?php

namespace App\Services\EnvyApi;

use App\Services\EnvyRestApi;

class Posts extends EnvyRestApi
{
	public function getPosts($status=null, $limit=null, $offset=null)
	{
		$endpoint = '/status';
		$query = array();


//		if ($status) $query['status']

		if ( ! empty($limit)) {
			$query['limit'] = $limit;
			if ( ! empty($offset)) $query['offset'] = $offset;
			$endpoint .= '?' . http_build_query($query);
		}

		$response = $this->apiGetWithAuth($endpoint);

		return $response->body;
	}

	public function getPost($id)
	{
		$response = $this->apiGetWithAuth('/posts/' . $id);

		return $response->body->post;
	}

	public function getFlagsForPost($post_id)
	{
		$endpoint = sprintf('/posts/%s/flag', $post_id);

		return $this->apiGetWithAuth($endpoint)->body;
	}
	/**
	 * Approves a post flag, effectively deleting the post
	 * @param $post_id
	 * @param $flag_id
	 * @return mixedA
	 */
	public function approveFlag($post_id, $flag_id)
	{
		$endpoint = sprintf('/posts/%s/flag/%s/approve', $post_id, $flag_id);

		return $this->apiPutWithAuth($endpoint);
	}
	/**
	 * Disapproves a post flag (removes the flag)
	 * @param $post_id
	 * @param $flag_id
	 * @return mixedA
	 */
	public function disapproveFlag($post_id, $flag_id)
	{
		$endpoint = sprintf('/posts/%s/flag/%s/disapprove', $post_id, $flag_id);

		return $this->apiPutWithAuth($endpoint);
	}
}