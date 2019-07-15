@extends('layouts.dashboard')

@section('content')

    <div class="container">
        @include('partials.message')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                </tr>
                            </thead>
                                
                                <tbody>
                                    @foreach(App\Asset::all() as $asset)
                                        <tr>
                                            <th scope="row">{{ $loop->index + 1 }}</th>
                                            <td>{{ $asset->name }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection