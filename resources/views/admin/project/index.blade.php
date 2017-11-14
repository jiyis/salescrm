@extends('admin.layouts.layout')

@section('content')
    <section class="content-header">
        {!! Breadcrumbs::render('admin-project-index') !!}
    </section>

    <!-- Main content -->
    <section class="index-content">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <i class="fa fa-bar-chart-o"></i>
                        <h3 class="box-title">项目列表</h3>
                        <a href="{{ route('admin.project.create') }}" class="btn btn-primary header-btn">新增项目</a>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered table-striped datatable">
                            <thead>
                            <tr>
                                <th>
                                    <label>
                                        <input type="checkbox" class="square" id="selectall">
                                    </label>
                                </th>
                                <th>品类</th>
                                <th>城市</th>
                                <th>项目名称</th>
                                <th>集成商</th>
                                <th>负责人</th>
                                <th>型号</th>
                                <th>镜头</th>
                                <th>数量</th>
                                <th>把握度</th>
                                <th>交货日期</th>
                                <th>备注</th>
                                <th>审核状态</th>
                                <th>审核日期</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($projects as $project)
                                <tr>
                                    <td>
                                        <label>
                                            <input type="checkbox" class="square selectall-item" name="id" id="id-{{ $project->id }}" value="{{ $project->id }}" />
                                        </label>
                                    </td>
                                    <td>{{ $project->category }}</td>
                                    <td>{{ $project->city }}</td>
                                    <td>{{ $project->name }}</td>
                                    <td>{{ $project->business }}</td>
                                    <td>{{ $project->manager }}</td>
                                    <td>{{ $project->model }}</td>
                                    <td>{{ $project->num }}</td>
                                    <td>{{ $project->camera }}</td>
                                    <td>{{ $project->power }}</td>
                                    <td>{{ $project->delivery_time }}</td>
                                    <td>{{ $project->remarks }}</td>
                                    <td>{{ $project->review_status }}</td>
                                    <td>{{ $project->review_time }}</td>
                                    <td>
                                        <a class="btn btn-success btn-xs publish-btn" data-url="{{ $project->url }}"><i class="fa fa-paper-plane" aria-hidden="true"></i> 发布</a>
                                        <a href="{{ route('admin.project.edit',['id'=>$project->id]) }}" class="btn btn-white btn-xs"><i class="fa fa-pencil"></i> 编辑</a>

                                        <a class="btn btn-danger btn-xs user-delete" data-href="{{ route('admin.project.destroy',['id'=>$project->id]) }}"><i class="fa fa-trash-o"></i> 删除</a>
                                    </td>                                    
                                </tr>
                            @endforeach
                            </tbody>
                        </table>                          
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('javascript')
    @parent
    <script type="text/javascript">
        $('input[class!="my-switch"]').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
        $(".user-delete").click(function () {
            Rbac.ajax.delete({
                confirmTitle: '确定删除页面?',
                href: $(this).data('href'),
                successTitle: '页面删除成功'
            });
        });
        $('.publish-btn').click(function(){
            Rbac.ajax.request({
                successTitle: "发布成功!",
                close: true,
                href: "#",
                data: {url:$(this).data('url')},
                successFnc: function () {
                    return false;
                    window.location.href="{{ route('admin.project.index') }}";
                }
            });
        })
    </script>
@endsection
