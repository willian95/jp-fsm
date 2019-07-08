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
            <div class="col-md-10 offset-md-1">
                <div class="card">
                    <div class="card-body">
                        
                        <h3 class="text-center">Partners</h3>
                        <div class="form-group">
                            <label for="asset">Name</label>
                            <input type="text" class="form-control" id="asset" placeholder="name" v-model="name">
                        </div>
                        <div class="form-group">
                            <label for="phone">States Covered</label>
                            <select class="form-control" @change="selectStatesCovered" v-model="stateCovered">
                                <option :value="0">Seleccione</option>
                                <option v-for="state in states" :value="state.id">@{{ state.nombre }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4" v-for="stateCovered in statesCovered">
                                    <div class="chips" @click="deleteStatesCovered(stateCovered)">
                                        <div class="card">
                                            <div class="card-body">
                                                @{{ stateCovered.nombre }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" placeholder="phone" v-model="phone">
                        </div>
                        <div class="form-group">
                            <label for="phone">Address</label>
                            <input type="text" class="form-control" id="phone" placeholder="address" v-model="address">
                        </div>
                        <div class="form-group">
                            <label for="phone">States</label>
                            <select class="form-control" v-model="state" @change="selectState">
                                <option :value="0">Seleccione</option>
                                <option v-for="state in states" :value="state.id">@{{ state.nombre }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="phone">Counties</label>
                            <select class="form-control" v-model="county" @change="selectCounty">
                                <option :value="0">Seleccione</option>
                                <option v-for="county in counties" :value="county.id">@{{ county.nombre }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="phone">Cities</label>
                            <select class="form-control" v-model="city">
                                <option :value="0">Seleccione</option>
                                <option v-for="city in cities" :value="city.id">@{{ city.nombre }}</option>
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

@endsection

@push('scripts')
    
     <script>
        const app = new Vue({
            el: '#app2',
            data(){
                return {
                    states:[],
                    stateCovered:'0',
                    statesCovered:[],
                    state:0,
                    county:0,
                    city:0,
                    cities:[],
                    counties:[],
                    name:'',
                    address:'',
                    phone:''

                }
            },
           
            methods: {

                getAllStates(){

                    axios.get("{{ url('/api/states/all') }}").then(response => {

                        this.states = response.data.states

                    });

                },
                selectStatesCovered(){

                    let _this = this

                    if(this.stateCovered > 0){
                        let flag = false
                        this.statesCovered.forEach(function(element){
                                
                            if(element.id == _this.stateCovered){
                                flag = true
                            }

                        })

                        if(!flag){
                            this.statesCovered.push(this.states[this.stateCovered - 1])
                        }
                        
                    }
                },
                deleteStatesCovered(stateCovered){
                    let _this = this
                    let i = 0
                    this.statesCovered.forEach(function(element){
                        console.log(element)
                        if(element.id == stateCovered.id){
                            _this.statesCovered.splice(i, 1)
                        }

                        i++

                    })

                },
                selectState(){

                    axios.get("{{ url('/api/counties/state_id/') }}"+"/"+this.state).then(response => {
                        this.counties = response.data.counties
                    })

                },
                selectCounty(){

                    axios.get("{{ url('/api/cities/county_id/') }}"+"/"+this.county).then(response => {

                        this.cities = response.data.cities

                    })

                },
                store(){

                    axios.post("{{ route('dashboard.partners.store') }}", {name: this.name, phone: this.phone, address: this.address, city: this.city, statesCovered: this.statesCovered}).then(response => {
                        
                        if(response.data.success == true){

                            alert(response.message)

                        }else{

                            alert('Error en el servidor')

                        }

                    })

                }

            },
            mounted(){
                this.getAllStates()
            }
        });
    </script>

@endpush