@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Photo</div>
                <div class="card-body">
                    <form action="{{ route('photoUpdate', $photo->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label for="title">Photo Title</label>
                                <input type="text" name="title" value="{{ $photo->title }}" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="photo">Photo</label>
                                <input type="file" name="photo" class="form-control">
                                <input type="hidden" name="photo" value="old_photo" value="{{ $photo->photo }}">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="description">Photo Description</label>
                                <textarea name="description" class="form-control" rows="3">{{ $photo->description }}</textarea>
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
