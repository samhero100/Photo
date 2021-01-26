@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Photos</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p>{{ $gallary->description }}</p>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($photos as $photo)
                            <div class="col-md-3">
                                <a href="{{ route('photoShow', $photo->id) }}">
                                    <img src="{{ asset('gallaries/photos/' . $photo->photo) }}" alt="Photo" width="100%">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">{{ $gallary->title }}</div>
                <div class="card-body text-center">
                    <img src="{{ asset('gallaries/' . $gallary->cover) }}" alt="Cover" width="100%">
                    <br><br>
                    <a href="{{ route('photoCreate', $gallary->id) }}" class="btn btn-primary btn-block">Upload Photo</a>
                    <a href="{{ route('gallaryEdit', $gallary->id) }}" class="btn btn-success btn-block">Edit Gallary</a>
                    <a @click="gallaryDelete" class="btn btn-danger btn-block">Delete Gallary</a>
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
                gallary: {!! $gallary !!}
            },
            methods: {
                gallaryDelete(gallary){
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
                            axios.get('http://gallery.test/user/gallaries/delete/' + this.gallary.id).then(() => {
                                window.location.href = 'http://gallery.test/home';
                            })
                        }
                    })
                }
            },
        });
    </script>
@endsection
