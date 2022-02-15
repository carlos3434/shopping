<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

/**
 * Class HomeController
 * @package App\Http\Controllers\Frontend
 */
class BaseController extends Controller
{
    /** @var string */
    protected $userToken;

    /**
     * Just in case of authentication
     *
     * BaseController constructor
     */
    //public function __construct() {
        // $this->middleware('auth');
    //}

    /**
     * Load user token based on login status
     */
    protected function loadUserToken() {
        if(!\Auth::check()) {
            if(empty( \Cookie::get('user_token') )) {
                \Cookie::queue('user_token',  \Illuminate\Support\Str::random(60),  time() + (10 * 365 * 24 * 60 * 60), '/' );
            }
        }
    }

}