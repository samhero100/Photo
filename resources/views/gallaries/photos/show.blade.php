@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">Actions</div>
                <div class="card-body text-center">
                    <a href="{{ route('photoEdit', $photo->id) }}" class="btn btn-success btn-block">Edit Photo</a>
                    <a @click="photoDelete" class="btn btn-danger btn-block">Delete Photo</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{$photo->title }}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">{{ $photo->description }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <img src="{{ asset('gallaries/photos/' . $photo->photo) }}" alt="photo" width="100%">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <script>
        const app = new Vue({
            el: '#app',
            data: {
                photo: {!! $photo !!}
            },
            methods: {
                photoDelete(photo){
                    swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                        if (result.isConfirmed) {
                            var gallary_id = this.photo.gallary_id;
                            axios.get('http://gallery.test/user/gallaries/photos/delete/' + this.photo.id).then(() => {
                                window.location.href = 'http://gallery.test/user/gallaries/show/' + gallary_id;
                            })
                        }
                    })
                }
            },
        });
    </script>

@endsection
