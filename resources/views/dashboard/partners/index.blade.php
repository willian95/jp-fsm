@extends('layouts.dashboard')

@push('styles')
    
    <style type="text/css">
        .chips{
            margin-top: 10px;
            ,margin-bottom: 10px;
        }
    </style>

@endpush

@section('content')
    
    <div class="container" id="app2">

        @include('partials.message')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        
                        <h3 class="text-center">Partners</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Address</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(partner, index) in partners">
                                    <th scope="row">@{{ index + 1 }}</th>
                                    <td>@{{ partner.name }}</td>
                                    <td>@{{ partner.phone }}</td>
                                    <td>@{{ partner.address }}</td>
                                </tr>
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    
     <script>
        const app = new Vue({
            el: '#app2',
            data(){
                return {
                    partners:[],
                }
            },
           
            methods: {

                getAll(){

                    axios.get("{{ route('dashboard.partners.get.all') }}").then(response => {

                        this.partners = response.data.partners
                    })

                }

            },
            mounted(){
               this.getAll()
            }
        });
    </script>

@endpush