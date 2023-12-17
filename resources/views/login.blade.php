@extends('layouts.master')

@section('content')
    <div class="row mt-5 justify-content-center">
        <div class="col-md-4">
            <h2 class="mb-2">Login</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li class="mb-0">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('login.submit') }}" method="POST">
                        @csrf
                        <div class="mb-2">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" id="username" name="username" class="form-control" />
                        </div>

                        <div class="mb-2">
                            <label for="email" class="form-label">User Email</label>
                            <input type="email" id="email" name="email" class="form-control" />
                        </div>

                        <div class="mb-2">
                            <label for="password" class="form-label">User Password</label>
                            <input type="password" id="password" name="password" class="form-control" />
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
