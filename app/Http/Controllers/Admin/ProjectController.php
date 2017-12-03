<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateProjectRequest;
use App\Http\Requests\Admin\UpdateProjectRequest;
use Illuminate\Http\Request;
use App\Repository\ProjectRepository;
use Breadcrumbs, Toastr;
use Maatwebsite\Excel\Facades\Excel;

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

        $projects = $this->project->all();
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
        Breadcrumbs::register('admin-project-edit', function ($breadcrumbs) use ($id) {
            $breadcrumbs->parent('admin-project');
            $breadcrumbs->push('审核项目', route('admin.project.check', ['id' => $id]));
        });

        $project = $this->project->find($id);

        return view('admin.project.show');
    }

    public function checkEdit($id)
    {
        Breadcrumbs::register('admin-project-check', function ($breadcrumbs) use ($id) {
            $breadcrumbs->parent('admin-project');
            $breadcrumbs->push('审核项目', route('admin.project.check', ['id' => $id]));
        });

        $project = $this->project->find($id);

        return view('admin.project.check', compact('project'));
    }

    public function check(Request $request, $id)
    {

        $project = $this->project->findWithoutFail($id);

        if (empty($project)) {
            Toastr::error('项目未找到');

            return redirect(route('admin.project.index'));
        }
        
        $project->review_status = $request->input('review_status', 0);
        $project->review_time = date('Y-m-d', time());
        $project->save();

        Toastr::success('项目审核成功.');

        return redirect(route('admin.project.index'));
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

        $project = $this->project->find($id);

        return view('admin.project.edit', compact('project', 'roles'));
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

            return redirect(route('admin.project.index'));
        }
        if($request->get('password') == ''){
            $data = $request->except('password');
        }else{
            $data = $request->all();
        }
        $project = $this->project->update($data, $id);

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
     * 下载附件
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download(Request $request, $id) {

        $project = $this->project->findWithoutFail($id);

        if (empty($project)) {
            Toastr::error('项目未找到');

            return redirect(route('admin.project.index'));
        }

        $file = storage_path('app/public/'.$project->files);
        if(file_exists($file)){
            return response()->download($file,date('Y',time()).'项目'.$project->name.'.'.pathinfo($file)['extension']);
        }
        Toastr::error('项目未找到');

        return redirect(route('admin.project.index'));
    }

    /**
     * 导出项目
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function export(Request $request)
    {

        $cellData = [
            ['品类','城市','项目名称','集成商','负责人','型号/数量','镜头/数量','把握度','预计交货日期','审核状态','审核日期','项目备注'],
        ];
        if(!($ids = $request->get('ids'))) {
            return response()->json(['status' => 0, 'msg' => '请求参数错误']);
        }
        $ids = explode(',',trim($ids,','));
        $projects = $this->project->findWhereIn('id', $ids);

        $projects->map(function ($item) use (&$cellData) {
            if (is_null($item->review_status)) {
                $review_status = '未审核';
            } elseif ($item->review_status == 1) {
                $review_status = '审核通过';
            } else {
                $review_status = '审核未通过';
            }
            $cellData[] = [
                config('custom.category')[$item->category],
                $item->city,
                $item->name,
                $item->business,
                $item->manager,
                $item->model,
                $item->camera,
                config('custom.power')[$item->power],
                $item->delivery_time,
                $review_status,
                $item->review_time,
                $item->remarks,
            ];
        });

        return Excel::create('项目列表',function($excel) use ($cellData){
            $excel->sheet('报备项目', function($sheet) use ($cellData){
                $sheet->rows($cellData);
            });
        })->download('xlsx');
    }
}
