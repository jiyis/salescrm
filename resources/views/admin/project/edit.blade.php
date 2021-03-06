@extends('admin.layouts.layout')

@section('content')
    <section class="content-header">
        {!! Breadcrumbs::render('admin-project-edit') !!}
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-md-12">

                {!! Form::model($project, ['route' => ['admin.project.update', $project],'class' => '', 'method' => 'patch', 'files' => true ]) !!}

                @include('admin.project.fields')

                {!! Form::close() !!}
            </div>
        </div>
    </section>
@endsection