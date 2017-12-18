@extends('admin.layouts.layout')

@section('content')
    <section class="content-header">
        {!! Breadcrumbs::render('admin-project-check') !!}
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-md-12">

                {!! Form::model($project, ['route' => ['admin.project.result', $project->id],'class' => '', 'method' => 'post' ]) !!}

                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <i class="fa fa-edit"></i>
                                <h3 class="box-title"> 项目审核</h3>
                                <a class="btn btn-info tooltips multiexport" style="float: right; margin-left: 15px;"><i class="fa fa-share"></i>批量导出</a>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="row">
                                    <div class="form-group">
                                        {!! Form::label('category', '品类',['class'=>'col-sm-2 control-label']) !!}
                                        <div class="col-sm-4">
                                           {{ config('custom.category')[$project->category] }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('city', '城市',['class'=>'col-sm-2 control-label']) !!}
                                        <div class="col-sm-4 ">
                                            {{ $project->city }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('name', '项目名称',['class'=>'col-sm-2 control-label']) !!}
                                        <div class="col-sm-4">
                                            {{ $project->name }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('business', '项目集成商',['class'=>'col-sm-2 control-label']) !!}
                                        <div class="col-sm-4">
                                            {{ $project->business }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('manager', '项目负责人',['class'=>'col-sm-2 control-label']) !!}
                                        <div class="col-sm-4">
                                            {{ $project->manager }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('model', '型号/数量',['class'=>'col-sm-2 control-label']) !!}
                                        <div class="col-sm-4">
                                            {{ $project->model }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('camera', '镜头',['class'=>'col-sm-2 control-label']) !!}
                                        <div class="col-sm-4">
                                            {{ $project->camera }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('num', '镜头数量',['class'=>'col-sm-2 control-label']) !!}
                                        <div class="col-sm-4">
                                            {{ $project->num }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('power', '把握度',['class'=>'col-sm-2 control-label']) !!}
                                        <div class="col-sm-4">
                                            {{ config('custom.power')[$project->power] }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('delivery_time', '预计交货时间',['class'=>'col-sm-2 control-label']) !!}
                                        <div class="col-sm-4">
                                            {{ $project->delivery_time }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('remarks', '项目备注',['class'=>'col-sm-2 control-label']) !!}
                                        <div class="col-sm-6">
                                            {{ $project->remarks }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('report_time', '报备时间',['class'=>'col-sm-2 control-label']) !!}
                                        <div class="col-sm-6">
                                            {{ date('Y-m-d', $project->report_time) }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('review_status', '审核结果',['class'=>'col-sm-2 control-label']) !!}
                                        <div class="col-sm-2">
                                            {!! Form::select('review_status', [0=> '审核不通过', 1=>'审核通过'], null, ['class' => 'form-control select2']) !!}
                                        </div>
                                    </div>
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.box-body -->

                            <div class="panel-footer">
                                <div class="row">
                                    <div class="col-sm-4 col-sm-offset-10">
                                        <button class="btn bg-blue">保存</button>
                                        &nbsp;
                                        <a href="{{ route('admin.project.index') }}" class="btn btn-default">取消</a>
                                    </div>
                                </div>
                            </div><!-- panel-footer -->
                        </div>
                    </div>
                </div>


                {!! Form::close() !!}
            </div>
        </div>
    </section>
@endsection