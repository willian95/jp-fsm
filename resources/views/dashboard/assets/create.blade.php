@extends('layouts.dashboard')

@section('content')

    <div class="container">
        @include('partials.message')
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('dashboard.assets.store') }}" method="post">
                            @csrf
                            <h3 class="text-center">Assets</h3>
                            <div class="form-group">
                                <label for="asset">Name</label>
                                <input type="text" class="form-control" id="asset" placeholder="asset" name="asset">
                            </div>
                            <div class="text-center">
                                <button class="btn btn-success">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection