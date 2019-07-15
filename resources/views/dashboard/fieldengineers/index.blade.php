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
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
                          Create
                        </button>
                        <h3 class="text-center">Field Engineers</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Partner</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(fe, index) in fieldEngineers">
                                    <th scope="row">@{{ index + 1 }}</th>
                                    <td>@{{ fe.name }}</td>
                                    <td>@{{ fe.phone }}</td>
                                    <td>@{{ fe.address }}</td>
                                    <td>@{{ fe.partner }}</td>
                                    <td>
                                        <button class="btn btn-danger" @click="erase(user.id)"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Create-->
        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
          <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center">Field Engineers</h3>
                        <div class="form-group">
                            <label for="asset">Name</label>
                            <input type="text" class="form-control" id="asset" placeholder="name" v-model="name">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" placeholder="email@example.com" v-model="phone">
                        </div>
                        <div class="form-group">
                            <label for="phone">Address</label>
                            <input type="text" class="form-control" id="phone" placeholder="address" v-model="address">
                        </div>
                        <div class="form-group">
                            <label for="phone">Partners</label>
                            <select class="form-control" v-model="partner_id">
                                <option :value="partner.id" v-for="partner in partners">
                                    @{{ partner.name }}
                                </option>
                            </select>
                        </div>
                        
                        <div class="text-center">
                            <button class="btn btn-success" @click="store">Create</button>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!--<button type="button" class="btn btn-primary">Save changes</button>-->
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
                    fieldEngineers:[],
                    partners:[],
                    name:'',
                    phone:'',
                    address:'',
                    partner_id:''
                }
            },
           
            methods: {

                getFE(){
                    axios.get("{{ route('dashboard.FE.get.fe') }}").then(response => {

                        this.fieldEngineers = response.data.fe

                    })
                },

                getPartners(){

                    axios.get("{{ url('/api/partners/all') }}").then(response => {

                        this.partners = response.data.partners

                    })

                },
                
                store(){

                    axios.post("{{ route('dashboard.FE.store') }}", {name: this.name, phone: this.phone, address: this.address, partner_id: this.partner_id}).then(response => {
                        
                        if(response.data.success == true){

                            alert(response.data.message)
                            this.getFE()

                        }else{

                            alert('Error en el servidor')

                        }

                    })

                },

                erase(id){
                    axios.post("{{ url('/dashboard/users/delete/') }}"+"/"+id).then(response => {

                        if(response.data.success == true){
                            alert(response.data.message)
                            this.getUsers()
                        }

                    })
                }

            },
            mounted(){
               this.getFE()
               this.getPartners()
            }
        });
    </script>

    

@endpush