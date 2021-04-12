<?php

namespace App\Http\Controllers;

use App\Services\EnvyRestApi;
use App\Services\EnvyApi\Stats as StatsApi;

class HomeController extends Controller {

	public function home(EnvyRestApi $api, StatsApi $stats) {
		if ( ! $api->hasApiToken()) return redirect('/login');
		$stats = $stats->getOverview();

		return view('home', compact('stats'));
	}

}