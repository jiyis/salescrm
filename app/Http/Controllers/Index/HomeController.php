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
use App\Repository\MemberRepository;
use App\Repository\ProjectRepository;
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

        $data['project_numbers'] = app(ProjectRepository::class)->get()->count();

        $data['project_uncheck_numbers'] = app(ProjectRepository::class)->findWhere(['report' => 0])->count();

        $data['project_check_numbers'] = app(ProjectRepository::class)->findWhere(['review_status' => 1])->count();

        $data['project_uncheck_numbers'] = app(ProjectRepository::class)->findWhere(['review_status' => 0])->count();


        return view("index.home", compact('data'));
    }


}