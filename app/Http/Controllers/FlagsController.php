<?php

namespace App\Http\Controllers;

use App\Services\EnvyApi\Flags as FlagsApi;
use Illuminate\Http\Request;
use App\Http\Requests;

class FlagsController extends Controller
{
	public function index(FlagsApi $api, Request $request)
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
		$flags = $api->getFlags($limit, $offset);

		return view('flags.index', get_object_vars($flags));
	}

	public function show(FlagsApi $api, $id) {

		$flag = $api->getFlag($id);

	}
}
