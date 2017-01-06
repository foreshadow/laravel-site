@extends('layouts.app')

@section('title', $article->title)

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8">
      <div id="content">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3>{{ $article->title }}</h3>
            <a href="{{ url('admin/article/'.$article->id . '/edit') }}" class="btn btn-sm btn-success pull-right">编辑</a>
            <p>{{ $article->info() }}</p>
          </div>
          <div class="panel-body">
            @if ($article->renderer == 'markdown')
            <?php $toc = new App\Utilities\TOC($article->gfm(), $article->label); echo $toc->html(); ?>
            @else
            <?php $toc = new App\Utilities\TOC($article->body, $article->label); echo $toc->html(); ?>
            @endif
          </div>
        </div>
      </div>
    </div>
    @if ($article->toc)
    <div class="col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4>目录</h4>
        </div>
        <div class="panel-body">
          <?php echo $toc->toc(); ?>
        </div>
      </div>
    </div>
    @endif
  </div>
</div>
@endsection
