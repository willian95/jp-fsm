@extends('layouts.login')

@section('title', 'Login')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card" style="margin-top: 2rem;">
                    <div class="card-body">
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <h3 class="text-center">Login</h3>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="email" name="email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="password" name="password">
                            </div>
                            <div class="text-center">
                                <button class="btn btn-success">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection