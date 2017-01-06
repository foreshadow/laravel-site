@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">修改文章</div>
                <div class="panel-body">

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>发布失败</strong> 输入不符合要求<br><br>
                            {!! implode('<br>', $errors->all()) !!}
                        </div>
                    @endif

                    <form action="{{ url('admin/article/' . $article->id) }}" method="POST">
                        {!! csrf_field() !!}
                        {{ method_field('PUT') }}
                        <input type="text" name="title" class="form-control" required="required" placeholder="标题" value="{{ $article->title }}">
                        <br>
                        <textarea name="body" rows="18" class="form-control" required="required" placeholder="内容">{{ $article->body }}</textarea>
                        <br>
                        <div class="col-md-6">
                            {{ Form::label('', '内容格式') }}          
                            {{ Form::select('renderer', array('markdown' => 'markdown', 'html' => 'html'), $article->renderer, ['class' => 'form-control']) }}
                            <span class="help-block">如果你没有使用HTML，建议选择markdown</span>
                        </div>
                        <div class="col-md-6">
                            {{ Form::checkbox('toc', '1', $article->toc) }}
                            {{ Form::label('', '目录') }}                   
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     
                            {{ Form::checkbox('label', '1', $article->label) }}
                            {{ Form::label('', '数字节标题') }}
                            <br>
                            <button class="btn btn-primary pull-right">修改并发布</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection