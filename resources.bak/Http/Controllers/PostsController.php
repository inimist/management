<?php

namespace App\Http\Controllers;

use App\Services\EnvyApi\Posts as PostsApi;
use Illuminate\Http\Request;
use App\Http\Requests;

class PostsController extends Controller
{
	public function index(PostsApi $api, Request $request)
	{
		$offset = $request->offset;
		$limit = $request->limit;

		/**
		 * @var object $flags
		 * - int offset,
		 * - int limit,
		 * - int total,
		 * - boolean hasMore,
		 * - flags[] flags
		 */
		$posts = $api->getPosts($limit, $offset);
		$statuses = $this->getStatusOptions($api);

		return view('posts.index', compact('posts', 'statuses'));
	}

	public function show(PostsApi $api, Request $request, $id) {

		$post = $api->getPost($id);
		$statuses = $this->getStatusOptions($api);
		$flags = array();

		if (isset($post->flagged) && $post->flagged) {
			$flag_data = $api->getFlagsForPost($id);
			$flags = $flag_data->flags;
		}

if (isset($_GET['debugpost'])) {
	echo '<Pre>';
	print_r($flags);
	print_r($post);

	exit;
}
		$message = $request->message;

		return view('posts.show', compact('post', 'statuses', 'flags', 'message'));

	}

	public function approveFlag(PostsApi $api, $post_id, $flag_id) {
		$api->approveFlag($post_id, $flag_id);
		return redirect()->route('posts.show', ['postId' => $post_id, 'message' => 'Flag confirmed']);
	}
	public function disapproveFlag(PostsApi $api, $post_id, $flag_id) {
		$api->disapproveFlag($post_id, $flag_id);
		return redirect()->route('posts.show', ['postId' => $post_id, 'message' => 'Flag cancelled']);
	}

	private function getStatusOptions($api) {
		$statuses = $api->getStatuses();

		return $statuses;
	}
}
