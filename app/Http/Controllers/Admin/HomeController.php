<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $pdo     = \DB::connection()->getPdo();

        $version = $pdo->query('select version()')->fetchColumn();

        $data = [
            'server'          => $_SERVER['SERVER_SOFTWARE'],
            'http_host'       => $_SERVER['HTTP_HOST'],
            'remote_host'     => isset($_SERVER['REMOTE_HOST']) ? $_SERVER['REMOTE_HOST'] : $_SERVER['REMOTE_ADDR'],
            'user_agent'      => $_SERVER['HTTP_USER_AGENT'],
            'php'             => phpversion(),
            'sapi_name'       => php_sapi_name(),
            'extensions'      => implode(", ", get_loaded_extensions()),
            'db_connection'   => isset($_SERVER['DB_CONNECTION']) ? $_SERVER['DB_CONNECTION'] : 'Secret',
            'db_database'     => isset($_SERVER['DB_DATABASE']) ? $_SERVER['DB_DATABASE'] : 'Secret',
            'db_version'      => $version,
        ];

        return view('admin.home', compact('data'));
    }
}
