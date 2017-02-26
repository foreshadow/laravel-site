@extends('layouts.app')

@section('content')
<div class="bing-background"></div>
<div class="container">
  <div class="row">
    <div class="col-md-3">
      <div class="panel panel-default">
        <div class="panel-heading">比赛</div>
        <ul class="list-group">
          @foreach($contests->sortBy('startTimeSeconds') as $contest)
          <li class="list-group-item">
            <h5 class="inline no-margin text-center">
              <a href="//codeforces.com/contestRegistration/{{ $contest->id }}">
                {{ $contest['name'] }}
              </a>
            </h5>
            <div class="text-center">
              <small>
                {{ date('D M/d/Y H:i', $contest['startTimeSeconds']) }}
                (+{{ sprintf("%s:%02s", $contest['durationSeconds'] / 3600, $contest['durationSeconds'] % 3600 / 60) }})
              </small>
              <!-- <small class="pull-right"> -->
              <small>
                {{ \App\Utilities\Functions::relative_time($contest['startTimeSeconds'] - time()) }}
              </small>
            </div>
          </li>
          @endforeach
        </ul>
      </div>
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
          No articles
          @endforelse
        </div>
      </div>
    </div>
    <div class="col-md-3">
      @if (Auth::check())
      <div class="panel panel-default">
        <div class="panel-body no-margin">
          <p>
            <strong>{{ Auth::user()->name }}</strong>
            <small>{{ Auth::user()->email }}</small>
          </p>
        </div>
      </div>
      @if (Auth::user()->codeforcesHandle)
      <div class="panel panel-default">
        <div class="panel-heading">Codeforces</div>
        <ul class="list-group">
          <li class="list-group-item no-margin {{ Auth::user()->codeforces_user->codeforces_rank_color_class() }}">
            <!-- <img src="{{ Auth::user()->codeforces_user->avatar }}" style="max-width: 46px; max-height: 46px; border-radius: 3px; float: left;"> -->
            <p class="pull-right" style="font-family: verdana; font-weight: bold;">{{ Auth::user()->codeforces_user->rating }}</p>
            <p style="font-family: verdana; font-weight: bold;">{{ ucwords(Auth::user()->codeforces_user->rank) }}</p>
            <p class="rated-user" style="font-size: 2rem;">{{ Auth::user()->codeforces_user->handle }}</p>
          </li>
          @foreach (\App\CodeforcesStatus::where('handle', '=', Auth::user()->codeforcesHandle)->orderBy('creationTimeSeconds', 'desc')->take(6)->get() as $status)
          <li class="list-group-item no-margin">
            <h5 class="inline">{{ $status->contestId }}{{ $status->index }} {{ $status->name }}</h5>
            <small class="pull-right">{{ date('M/d H:i', $status->creationTimeSeconds) }}</small>
            <small class="verdict {{ $status->codeforces_verdict_class() }}">{{ $status->codeforces_verdict(false) }}</small>
          </li>
          @endforeach
        </ul>
      </div>
      @endif
      @endif
    </div>
  </div>
</div>
@endsection
