@extends('layouts.app') 

@section('content')
<div class="bing-background"></div>
<div class="container">
  <div class="row">
    <div class="col-md-3">

    </div>
    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading">最近更新</div>
        <div class="panel-body">
          @forelse ($articles as $article)
          <h4>
            <a href="{{ url('article/' . $article->id) }}">{{ $article->title }}</a>
          </h4>
          <p><?php echo $article->info(); ?></p>
          <p><?php echo $article->text(3); ?></p>
          <hr>
          @empty
          <p>No articles</p>
          @endforelse
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="panel panel-default">
        <div class="panel-body">
          <p>{{ Auth::user()->name }}</p>
          <small>{{ Auth::user()->email }}</small>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
