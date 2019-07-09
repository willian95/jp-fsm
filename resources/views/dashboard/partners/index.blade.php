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
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(partner, index) in partners">
                                    <th scope="row">@{{ index + 1 }}</th>
                                    <td>@{{ partner.name }}</td>
                                    <td>@{{ partner.phone }}</td>
                                    <td>@{{ partner.address }}</td>
                                    <td>
                                        <button class="btn btn-info" data-toggle="modal" data-target="#infoModal" @click="getStatesCovered(partner.id)">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">States Covered</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p v-for="state in statesCovered">
                            @{{ state.state_name }}
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
                    statesCovered:[]
                }
            },
           
            methods: {

                getAll(){

                    axios.get("{{ route('dashboard.partners.get.all') }}").then(response => {

                        this.partners = response.data.partners
                    })

                },
                getStatesCovered(id){

                    axios.get("{{ url('/dashboard/partners/statesCovered/') }}"+"/"+id).then(response => {

                        this.statesCovered = response.data.statesCovered
                    
                    })

                }

            },
            mounted(){
               this.getAll()
            }
        });
    </script>

@endpush