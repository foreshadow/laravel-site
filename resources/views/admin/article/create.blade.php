@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">写文章</div>
                <div class="panel-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>发布失败</strong> 输入不符合要求<br><br>
                            {!! implode('<br>', $errors->all()) !!}
                        </div>
                    @endif
                    <form action="{{ url('admin/article') }}" method="POST">
                        {!! csrf_field() !!}
                        <input type="text" name="title" class="form-control" required="required" placeholder="标题">
                        <br>
                        <textarea name="body" rows="10" class="form-control" required="required" placeholder="内容"></textarea>
                        <br>
                        <div class="col-md-6">
                            {{ Form::label('', '内容格式') }}          
                            {{ Form::select('renderer', array('markdown' => 'markdown', 'html' => 'html'), 'markdown', ['class' => 'form-control']) }}
                            <span class="help-block">如果你没有使用HTML，建议选择markdown</span>
                        </div>
                        <div class="col-md-6">
                            {{ Form::checkbox('toc', '1', true) }}
                            {{ Form::label('', '目录') }}                   
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     
                            {{ Form::checkbox('label', '1', false) }}
                            {{ Form::label('', '数字节标题') }}
                            <br>
                            <button class="btn btn-primary pull-right">发布</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection