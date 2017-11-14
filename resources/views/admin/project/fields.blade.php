@section('css')
    @parent
	<style type="text/css">
	#editor {
		width: 100%;
		min-height: 460px;
    }
	</style>
@endsection

<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
		    <div class="box-header with-border">
		    	<i class="fa fa-edit"></i>
		      	<h3 class="box-title"> 项目编辑</h3>
		    </div>
		    <!-- /.box-header -->
		    <div class="box-body">
		      	<div class="row">
					<div class="form-group">
						{!! Form::label('category', '品类',['class'=>'col-sm-2 control-label']) !!}
				        <div class="col-sm-4">
				            {!! Form::text('category', old('category'), ['class' => 'form-control','placeholder' => '不超过64个字符']) !!}
				        </div>
				    </div>
				    <div class="form-group">
				    	{!! Form::label('city', '城市',['class'=>'col-sm-2 control-label']) !!}
				        <div class="col-sm-4 ">
				            {!! Form::text('city', old('city'), ['class' => 'form-control','placeholder' => '如 /about/index.html']) !!}
				        </div>
				    </div>
					<div class="form-group">
						{!! Form::label('name', '项目名称',['class'=>'col-sm-2 control-label']) !!}
				        <div class="col-sm-4">
				            {!! Form::text('name', old('name'), ['class' => 'form-control','placeholder' => '| 不超过200个字符','rows'=>'6']) !!}
				        </div>
				    </div>
                    <div class="form-group">
                        {!! Form::label('business', '项目集成商',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-4">
                            {!! Form::text('business', old('business'), ['class' => 'form-control','placeholder' => '| 不超过200个字符','rows'=>'6']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('manager', '项目负责人',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-4">
                            {!! Form::text('manager', old('manager'), ['class' => 'form-control','placeholder' => '| 不超过200个字符','rows'=>'6']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('model', '型号',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-4">
                            {!! Form::text('model', old('model'), ['class' => 'form-control','placeholder' => '| 不超过200个字符','rows'=>'6']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('num', '数量',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-4">
                            {!! Form::text('num', old('num'), ['class' => 'form-control','placeholder' => '| 不超过200个字符','rows'=>'6']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('camera', '镜头',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-4">
                            {!! Form::text('camera', old('camera'), ['class' => 'form-control','placeholder' => '| 不超过200个字符','rows'=>'6']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('power', '把握度',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-4">
                            {!! Form::text('power', old('power'), ['class' => 'form-control','placeholder' => '| 不超过200个字符','rows'=>'6']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('delivery_time', '预计交货时间',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-4">
                            {!! Form::text('delivery_time', old('delivery_time'), ['class' => 'form-control','placeholder' => '| 不超过200个字符','rows'=>'6']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('remarks', '项目备注',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-4">
                            {!! Form::textarea('content', old('content'), ['class' => 'form-control hidden']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('files', '项目图片',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-4">
                            {!! Form::textarea('files', old('files'), ['class' => 'form-control','placeholder' => '| 不超过200个字符','rows'=>'6']) !!}
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

@section('javascript')
    @parent
    <script type="text/javascript" src="{{ asset('assets/package/ace/ace.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/package/ace/theme-cobalt.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/package/ace/mode-php.js') }}"></script>
    <script type="text/javascript">
    	var editor = ace.edit("editor");
    	editor.setTheme('ace/theme/cobalt');
    	editor.getSession().setMode("ace/mode/php");
    	document.getElementById('editor').style.fontSize='14px';
    	editor.find('needle',{
		    backwards: false,
		    wrap: false,
		    caseSensitive: false,
		    wholeWord: false,
		    regExp: false
		});
		editor.findNext();
		editor.findPrevious();

		var textarea = $('textarea[name="content"]').hide();
		editor.getSession().setValue(textarea.val());

		// copy back to textarea on form submit...
		textarea.closest('form').submit(function () {
			textarea.val(editor.getSession().getValue());
		})
		/*editor.getSession().on('change', function(){
			textarea.val(editor.getSession().getValue());
		});*/
        var url = $("input[name='url']").val();

        @if(isset($page->id))
            $('#preview-btn').attr('href',"{{ url($page->url) }}");
            $('#publish-btn').click(function(){
                Rbac.ajax.request({
                    successTitle: "发布成功!",
                    href: "{{ route('admin.publish') }}",
                    data: {url:url},
                    successFnc: function () {
                        window.location.href="{{ route('admin.page.index') }}";
                    }
                });
            })
        @else
           $('#publish-btn').attr('disabled','disabled');
            $('#preview-btn').attr('disabled','disabled');
        @endif


    </script>
@endsection