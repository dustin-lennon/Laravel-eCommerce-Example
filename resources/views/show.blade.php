@extends('layouts.master')

@section('content')
<div class="main-content mt-5">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h4>Show Posts</h4>
                </div>

                <div class="col-md-6 d-flex justify-content-end">
                    <a class="btn btn-sm btn-success mx-1" href="{{ route('posts.create') }}">Create</a>
                    <a class="btn btn-sm btn-warning mx-1" href="{{ route('posts.trashed') }}">Trashed</a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <table class="table table-striped table-bordered border-dark">
                <tbody>
                    <tr>
                        <td>Id</td>
                        <td>{{ $post->id }}</td>
                    </tr>
                    <tr>
                        <td>Image</td>
                        <td><img src="{{ asset($post->image) }}" alt="" width="300" /></td>
                    </tr>
                    <tr>
                        <td>Title</td>
                        <td>{{ $post->title }}</td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td>{{ $post->description }}</td>
                    </tr>
                    <tr>
                        <td>Category</td>
                        <td>{{ $post->category->name }}</td>
                    </tr>
                    <tr>
                        <td>Publish Date</td>
                        <td>{{ date('d-m-Y', strtotime($post->created_at)) }}</td>
                    </tr>
                </tbody>
              </table>
        </div>
    </div>
</div>
@endsection
