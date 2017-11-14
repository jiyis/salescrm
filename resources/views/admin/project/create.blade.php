@extends('admin.layouts.layout')

@section('content')
    <section class="content-header">
        {!! Breadcrumbs::render('admin-project-create') !!}
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-md-12">

                {!! Form::open(['route' => 'admin.project.store','class' => '']) !!}

                @include('admin.project.fields')

                {!! Form::close() !!}

            </div>
        </div>
    </section>
@endsection

