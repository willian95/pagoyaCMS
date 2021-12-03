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
                        <h3 class="card-label">Actualizar header
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body">
                    <div class="row">
                        
                        <div class="loader-cover-custom" v-if="loading == true">
                            <div class="loader-custom"></div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="title">Imágen o vídeo</label>
                                <input type="file" class="form-control" ref="file" @change="onImageChange" accept="image/* | video/*" style="overflow: hidden;">

                                <img id="blah" :src="imagePreview" class="full-image" style="margin-top: 10px; width: 40%" v-if="mainImageFileType == 'image'">
                                
                                <video class="w-100" controls v-if="mainImageFileType == 'video'">
                                    <source :src="imagePreview+'#t=0.1'" type="video/mp4">
                                    <source :src="imagePreview+'#t=0.1'" type="video/ogg">
                                    Your browser does not support the video tag.
                                </video>

                                <div v-if="pictureStatus == 'subiendo'" class="progress-bar progress-bar-striped" role="progressbar" aria-valuemin="0" aria-valuemax="100" :style="{'width': `${imageProgress}%`}">
                                    @{{ imageProgress }}%
                                </div>
                                
                                <p v-if="pictureStatus == 'subiendo' && imageProgress < 100">Subiendo</p>
                                <p v-if="pictureStatus == 'subiendo' && imageProgress == 100">Espere un momento</p>
                                <p v-if="pictureStatus == 'listo' && imageProgress == 100">Imágen lista</p>

                                <small v-if="errors.hasOwnProperty('image')">@{{ errors['image'][0] }}</small>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-12">
                            <p class="text-center">
                                <button class="btn btn-success" @click="uploadMainImage()">Actualizar</button>
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
                    pictureStatus:"",
                    imageProgress:"",
                    finalPictureName:"",
                    mainImageFileType:"{{ App\Models\Header::orderBy('id', 'desc')->first()->type }}",
                    picture:"",
                    imagePreview:"{{ App\Models\Header::orderBy('id', 'desc')->first()->image }}"
                }
            },
            methods:{
                
                async store(){

                    this.errors = []
                    this.loading = true
                    axios.post("{{ url('/header/update') }}", {image: this.finalPictureName, type: this.mainImageFileType}).then(res => {
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

                },
                onImageChange(e){
                    this.picture = e.target.files[0];

                    this.imagePreview = URL.createObjectURL(this.picture);
                    let files = e.target.files || e.dataTransfer.files;
                    if (!files.length)
                        return;
                    this.view_image = false
                    this.createImage(files[0]);
                },
                createImage(file) {
                    this.file = file
                    this.mainImageFileType = file['type'].split('/')[0]

                  
                    if(this.mainImageFileType == "image" || this.mainImageFileType == 'video'){
                        
                        let reader = new FileReader();
                        let vm = this;
                        reader.onload = (e) => {
                            vm.picture = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    }else{

                        swal({
                            text:"Formato no permitido",
                            "icon": "error"
                        })

                    }

                   
                },
                uploadMainImage(){
                    if(this.picture){

                        this.imageProgress = 0;
                        let formData = new FormData()
                        formData.append("file", this.file)
                        formData.append("upload_preset", this.cloudinaryPreset)

                        var _this = this
                        var fileName = this.fileName
                        this.pictureStatus = "subiendo";

                        var config = {
                            headers: { "X-Requested-With": "XMLHttpRequest" },
                            onUploadProgress: function(progressEvent) {
                                
                                var progressPercent = Math.round((progressEvent.loaded * 100.0) / progressEvent.total);
                            
                                _this.imageProgress = progressPercent
                                
                            }
                        }

                        axios.post(
                            "{{ url('/upload/picture') }}",
                            formData,
                            config                        
                        ).then(res => {
                            
                            this.pictureStatus = "listo";
                            this.finalPictureName = res.data.fileRoute

                            this.store()

                        }).catch(err => {
                            console.log(err)
                        })

                    }else{

                        swal({
                            text:"No hay imagen para subir",
                            "icon": "error"
                        })


                    }

                },
            }
        })
    
    </script>

@endpush