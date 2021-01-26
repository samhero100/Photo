@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Galleries</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        @foreach ($gallaries as $gallary)
                            <div class="col-md-3">

                                <article class="white-panel">
                                    <a href="{{ route('gallaryShow', $gallary->id) }}">
                                        <img src="{{ asset('gallaries/' . $gallary->cover) }}" alt="Cover" width="150">
                                        <h4 class="text-center"><a href="#">{{ $gallary->title }}</a></h4>
                                        <p>{{ $gallary->description }}</p>
                                    </a>
                                  </article>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-header">Create New Gallary</div>
                <div class="card-body">
                    <a href="{{ route('gallaryCreate') }}" class="btn btn-success btn-block">Create New Gallary</a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
