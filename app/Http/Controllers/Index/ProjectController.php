<?php

namespace App\Http\Controllers\Index;

use App\Http\Requests\Admin\CreateProjectRequest;
use App\Http\Requests\Admin\UpdateProjectRequest;
use Illuminate\Http\Request;
use App\Repository\ProjectRepository;
use Breadcrumbs, Toastr;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    protected $project;

    public function __construct(ProjectRepository $project)
    {
        parent::__construct();
        $this->project = $project;

        Breadcrumbs::register('index-project', function ($breadcrumbs) {
            $breadcrumbs->push('项目管理', route('project.index'));
        });
    }

    public function index()
    {
        Breadcrumbs::register('index-project-index', function ($breadcrumbs) {
            $breadcrumbs->parent('index-project');
            $breadcrumbs->push('项目列表', route('project.index'));
        });

        $projects = $this->project->all();
        return view('index.project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Breadcrumbs::register('index-project-create', function ($breadcrumbs) {
            $breadcrumbs->parent('index-project');
            $breadcrumbs->push('添加项目', route('project.create'));
        });

        return view('index.project.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProjectRequest $request)
    {
        $result = $this->project->create($request->all(), 'web');

        if(!$result) {
            Toastr::error('新项目添加失败!');
            return redirect(route('project.create'));
        }
        Toastr::success('新项目添加成功!');
        return redirect('project');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Breadcrumbs::register('index-project-edit', function ($breadcrumbs) use ($id) {
            $breadcrumbs->parent('index-project');
            $breadcrumbs->push('编辑项目', route('project.edit', ['id' => $id]));
        });

        $project = $this->project->find($id);

        if($project->report == 1) {
            Toastr::error('项目不存在');

            return redirect(route('admin.project.index'));
        }

        return view('index.project.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, $id)
    {
        $project = $this->project->findWithoutFail($id);

        if (empty($project)) {
            Toastr::error('项目未找到');

            return redirect(route('project.index'));
        }
        if($project->report == 1) {
            Toastr::error('项目不存在');

            return redirect(route('admin.project.index'));
        }
        $data = $request->all();
        $project = $this->project->update($data, $id);

        Toastr::success('项目更新成功.');

        return redirect(route('project.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = $this->project->findWithoutFail($id);
        if (empty($project)) {
            Toastr::error('项目未找到');

            return response()->json(['status' => 0]);
        }
        $result = $this->project->delete($id);
        //Toastr::success('项目删除成功');

        return response()->json($result ? ['status' => 1] : ['status' => 0]);
    }

    /**
     * Delete multi projects
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroyAll(Request $request)
    {
        if(!($ids = $request->get('ids', []))) {
            return response()->json(['status' => 0, 'msg' => '请求参数错误']);
        }

        foreach($ids as $id){
            $result = $this->project->delete($id);
        }
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
    }

    /**
     * 报备项目
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function publish(Request $request, $id)
    {
        $project = $this->project->findWithoutFail($id);

        if(empty($project)) {
            Toastr::error('项目未找到');
            return response()->json(['status' => 0]);
        }
        $res = $this->project->update(['report' => 1, 'report_time' => time()], $id);

        return response()->json($res ? ['status' => 1] : ['status' => 0]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function uploadEdit(Request $request, $id)
    {
        Breadcrumbs::register('index-project-upload', function ($breadcrumbs) use ($id) {
            $breadcrumbs->parent('index-project');
            $breadcrumbs->push('编辑项目', route('project.upload', ['id' => $id]));
        });

        $project = $this->project->find($id);

        return view('index.project.upload', compact('project'));
    }

    /**
     * 项目审核成功后上传图片
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(Request $request, $id)
    {
        $project = $this->project->findWithoutFail($id);

        if(empty($project)) {
            Toastr::error('项目未找到');
            return redirect(route('project.index'));
        }

        $project->files = $request->input('files');
        $project->save();
        Toastr::success('项目图片上传成功.');

        return redirect(route('project.index'));

    }
}
