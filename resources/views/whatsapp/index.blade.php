@extends("layouts.main")

@section("content")

    <div class="d-flex flex-column-fluid" id="dev-products">
        
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            <div class="card card-custom">
                <!--begin::Header-->
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">Actualizar número de whatsapp
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body">
                    <div class="row">
                        
                        <div class="loader-cover-custom" v-if="loading == true">
                            <div class="loader-custom"></div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="title">Número</label>
                                <input type="text" class="form-control" v-model="number">
                            </div>
                        </div>

                        {{--<div class="col-md-4">
                            <div class="form-group">
                                <label for="title">Número formulario registro</label>
                                <input type="text" class="form-control" v-model="registerNumber">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="title">Número formulario contacto</label>
                                <input type="text" class="form-control" v-model="contactNumber">
                            </div>
                        </div>--}}

                    </div>

                    <div class="row">
                        <div class="col-12">
                            <p class="text-center">
                                <button class="btn btn-success" @click="store()">Actualizar</button>
                            </p>
                        </div>
                    </div>


                </div>
                <!--end::Body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->


    </div>

@endsection

@push("scripts")

    <script>
        
        const app = new Vue({
            el: '#dev-products',
            data(){
                return{
                    errors:[],
                    loading:false,
                    number:"{{ App\Models\WhatsappPhoneNumber::first() ? App\Models\WhatsappPhoneNumber::first()->number : '' }}",
                    registerNumber:"{{ App\Models\WhatsappPhoneNumber::first() ? App\Models\WhatsappPhoneNumber::first()->register_number : '' }}",
                    contactNumber:"{{ App\Models\WhatsappPhoneNumber::first() ? App\Models\WhatsappPhoneNumber::first()->contact_number : '' }}"
                }
            },
            methods:{
                
                async store(){

                    if(this.number == ""){
                        swal({
                            text: "Número es requerido",
                            icon: "error"
                        })

                        return
                    }

                    /*if(this.registerNumber == ""){
                        swal({
                            text: "Número de registro es requerido",
                            icon: "error"
                        })

                        return
                    }

                    if(this.registerNumber == ""){
                        swal({
                            text: "Número de contacto es requerido",
                            icon: "error"
                        })

                        return
                    }*/

                    this.errors = []
                    this.loading = true
                    axios.post("{{ url('/whatsapp/update') }}", {number: this.number}).then(res => {
                    this.loading = false
                        if(res.data.success == true){

                            swal({
                                title: "Excelente!",
                                text: res.data.msg,
                                icon: "success"
                            })

                        }else{
                            
                            swal({
                                title: "Lo sentimos!",
                                text: "Hubo un problema!",
                                icon: "error"
                            })

                        }

                    }).catch(err => {
                        this.loading = false
                        this.errors = err.response.data.errors
                    }) 

                }
            }
        })
    
    </script>

@endpush