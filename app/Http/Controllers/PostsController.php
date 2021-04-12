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

    public function create(Request $request) {
        $post = $this->getPostFromRequest($request);
        return view('posts.create', ['post' => $post]);
    }

    public function store(Request $request, PostsApi $api) {
        $data = $this->getPostFromRequest($request, true);
        $response = $api->createPost($data);

        // upload media for a post
        $file = $request->file('file');
        $api->uploadMedia($response->fileUploadEndpoint . '/0/original', $file);
        for ($i = 0, $len = count($response->variations); $i < $len; ++$i) {
            $variation = $response->variations[$i];
            $url = $response->fileUploadEndpoint . '/' . $i . '/' .$variation->key;
            $api->uploadMedia($url, $file, $variation->width, $variation->height);
        }

        $api->finalizeUpload($response->id);

        return redirect()->route('posts.show', ['id' => $response->id]);
    }

    public function getPostFromRequest($request, $validate=false) {
	    if ($validate) {
            $this->validate($request, [
                'description' => 'required',
                'placeId' => 'required',
                'file' => 'required',
                'categoryId' => 'required'
            ]);
        }

        $post = [
            'description' => $request->description ? $request->description : '',
            'placeId' => $request->placeId ? $request->placeId : '',
            'userId' => $request->userId ? $request->userId : '',
            'categoryId' => $request->categoryId ? $request->categoryId : '',
        ];
        return $post;
    }
}
