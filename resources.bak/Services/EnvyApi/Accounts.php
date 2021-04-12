<?php

namespace App\Services\EnvyApi;

use App\Services\EnvyRestApi;
use Httpful\Request as ApiRequest;
use Illuminate\Auth\AuthenticationException;

class Accounts extends EnvyRestApi {
	const FEED_USERS = 'users';

//	public function getRecentAccounts()
//	{
//		$response = $this->apiGetWithAuth('/accounts/recent');
//
//		return $response->body->accounts;
//	}

	public function search($keyword, $offset=0)
	{
		$query = array('q' => $keyword);
		if (is_numeric($offset) && $offset > 0) $query['offset'] = $offset;
		$response = $this->apiGetWithAuth('/accounts/search', $query);

		return $response->body->accounts;
	}

	public function getAccount($id)
	{
		$response = $this->apiGetWithAuth('/accounts/' . $id);

		return $response->body->account;
	}

	public function getAccountBadges($account_id)
	{
		$response = $this->apiGetWithAuth('/accounts/' . $account_id . '/badges');

		return $response->body->account;
	}

	public function getAvailableBadges()
	{
		$response = $this->apiGetWithAuth('/accounts/badges');

		return $response->body->badges;
	}

	public function deleteAccount($id)
	{
		$response = $this->apiDeleteWithAuth('/accounts/' . $id, ['confirm' => true]);

		return $response->body;
	}

	public function getPostsByUserId($user_id)
	{
		$response = $this->apiGetWithAuth('/feeds/' . self::FEED_USERS . '/' . $user_id);

		return $response->body->results;
	}

	public function getHomeFeedForUserId($user_id)
	{
		$response = $this->apiGetWithAuth('/feeds/users/' . $user_id . '/home');

		return $response->body;
	}

	public function getFollowers($user_id)
	{
		$response = $this->apiGetWithAuth('/profiles/' . $user_id . '/followers');

		return $response->body->followers;
	}

	public function getFollowing($user_id)
	{
		$response = $this->apiGetWithAuth('/profiles/' . $user_id . '/following');

		return $response->body->following;
	}

	public function addBadges($user_id, array $badge_keys)
	{
		$response = $this->apiPostWithAuth('/accounts/' . $user_id . '/badges', ['badges' => $badge_keys]);

		return;
	}

	public function removeBadges($user_id, $badge_keys)
	{
		$response = $this->apiDeleteWithAuth('/accounts/' . $user_id . '/badges', ['badges' => $badge_keys]);

		return;
	}
}