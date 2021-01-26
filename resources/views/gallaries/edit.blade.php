@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Gallary</div>
                <div class="card-body">
                    <form action="{{ route('gallaryUpdate', $gallary->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label for="title">Gallary Title</label>
                                <input type="text" name="title" value="{{ $gallary->title }}" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="cover">Gallary Cover</label>
                                <input type="file" name="cover" class="form-control">
                                <input type="hidden" value="{{ $gallary->cover }}" name="old_cover">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="description">Gallary Description</label>
                                <textarea name="description" class="form-control" rows="3">{{ $gallary->description }}</textarea>
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Update Gallary</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
