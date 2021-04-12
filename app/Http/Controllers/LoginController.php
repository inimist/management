<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends ApiConnectedController {

    public function login() {
        return view('login');
    }

    public function handleLogin(Request $request) {

        $email = $request->email;
        $password = $request->password;

		error_log("Trying to post to accounts" . PHP_EOL);

        $response = $this->apiPost('/accounts', compact('email', 'password'));

        if ($response->code == 200 && $response->body->success) {
            $api = new \App\Services\EnvyRestApi();
            $api->setApiToken($response->body->token);
            return redirect()->to('/?login=success');
        } else {
            return $this->login()->with('login_error', $response->body->message);
        }
    }
}