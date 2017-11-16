<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateProjectRequest;
use App\Http\Requests\Admin\UpdateProjectRequest;
use Illuminate\Http\Request;
use App\Repository\ProjectRepository;
use Breadcrumbs, Toastr;

class ProjectController extends Controller
{
    protected $project;

    public function __construct(ProjectRepository $project)
    {
        parent::__construct();
        $this->project = $project;

        Breadcrumbs::register('admin-project', function ($breadcrumbs) {
            $breadcrumbs->parent('控制台');
            $breadcrumbs->push('项目管理', route('admin.project.index'));
        });
    }

    public function index()
    {
        Breadcrumbs::register('admin-project-index', function ($breadcrumbs) {
            $breadcrumbs->parent('admin-project');
            $breadcrumbs->push('项目列表', route('admin.project.index'));
        });

        $projects = $this->project->paginate(10);
        return view('admin.project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Breadcrumbs::register('admin-project-create', function ($breadcrumbs) {
            $breadcrumbs->parent('admin-project');
            $breadcrumbs->push('添加项目', route('admin.project.create'));
        });

        return view('admin.project.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProjectRequest $request)
    {
        $result = $this->project->create($request->all());

        if(!$result) {
            Toastr::error('新项目添加失败!');
            return redirect(route('admin.project.create'));
        }
        Toastr::success('新项目添加成功!');
        return redirect('admin/project');
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
        Breadcrumbs::register('admin-project-edit', function ($breadcrumbs) use ($id) {
            $breadcrumbs->parent('admin-project');
            $breadcrumbs->push('编辑项目', route('admin.project.edit', ['id' => $id]));
        });

        $user = $this->project->find($id);

        return view('admin.project.edit', compact('user', 'roles'));
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
        $user = $this->project->findWithoutFail($id);

        if (empty($user)) {
            Toastr::error('项目未找到');

            return redirect(route('admin.project.index'));
        }
        if($request->get('password') == ''){
            $data = $request->except('password');
        }else{
            $data = $request->all();
        }
        $user = $this->project->update($data, $id);

        Toastr::success('项目更新成功.');

        return redirect(route('admin.project.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->project->findWithoutFail($id);
        if (empty($user)) {
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
}
