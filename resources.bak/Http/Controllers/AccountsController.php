<?php

namespace App\Http\Controllers;

use App\Services\EnvyApi\Accounts as AccountsApi;
use Illuminate\Http\Request;

class AccountsController extends Controller
{
	const VIEW_INDEX = 'accounts.index';
	const VIEW_SHOW = 'accounts.show';
	const VIEW_POSTS = 'accounts.posts';
	const VIEW_HOMEFEED = 'accounts.homefeed';
	const VIEW_FOLLOWING = 'accounts.followers';
	const VIEW_FOLLOWERS = 'accounts.followers';

	public function index(Request $request, AccountsApi $api)
	{
		$keyword = $request->q;
		$offset = $request->offset;

		$accounts = array();
		if ($keyword !== null) {
			$accounts = $api->search($keyword, $offset);
		}

		return view(self::VIEW_INDEX, compact('accounts', 'keyword'));
	}

	public function show(AccountsApi $api, $id)
	{
		$account = $api->getAccount($id);
		$available_badges = $api->getAvailableBadges();


		return view(self::VIEW_SHOW, compact('account', 'available_badges'));
	}

	public function destroy(AccountsApi $api, $id)
	{
		$response = $api->deleteAccount($id);

		return redirect()->route('accounts.index')->with('message', 'User deleted');
	}

	public function posts(AccountsApi $api, $id)
	{
		$feed = $api->getPostsByUserId($id);

		return view(self::VIEW_POSTS, compact('feed'));
	}

	public function homeFeed(AccountsApi $api, $id)
	{
		$feed = $api->getHomeFeedForUserId($id);

		return view(self::VIEW_HOMEFEED, ['feed' => $feed->results]);
	}

	public function followers(AccountsApi $api, $id)
	{
		$account = $api->getAccount($id);
		$follows = $api->getFollowers($id);

		$title = sprintf('Users following %s', $account->name);

		return view(self::VIEW_FOLLOWERS, compact('account', 'follows', 'title'));
	}

	public function following(AccountsApi $api, $id)
	{
		$account = $api->getAccount($id);
		$follows = $api->getFollowing($id);
		$title = sprintf('%s follows', $account->name);

		return view(self::VIEW_FOLLOWING, compact('account', 'follows', 'title'));
	}

	public function addBadge(Request $request, AccountsApi $api, $id)
	{
		$badge = $request->badge;
		$api->addBadges($id, [$badge]);

		return array('success' => true);
	}

	public function removeBadge(Request $request, AccountsApi $api, $id)
	{
		$badge = $request->badge;
		$api->removeBadges($id, [$badge]);

		return array('success' => true);
	}
}