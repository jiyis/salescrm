<?php
/**
 * Created by PhpStorm.
 * User: Gary.F.Dong
 * Date: 17-11-17
 * Time: 下午1:57
 * Desc:
 */

namespace App\Http\Controllers\Index;


use App\Http\Controllers\Controller;
use Breadcrumbs;

class HomeController extends Controller
{

    public function __construct()
    {
        parent::__construct();


        Breadcrumbs::register('index-home', function ($breadcrumbs) {
            $breadcrumbs->push('管理中心', route('home'));
        });
    }

    public function index()
    {
        Breadcrumbs::register('index-home-index', function ($breadcrumbs) {
            $breadcrumbs->parent('index-home');
            $breadcrumbs->push('首页', route('home'));
        });

        return view("index.home");
    }


}