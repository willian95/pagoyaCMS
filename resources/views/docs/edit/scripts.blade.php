<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>

    var app = new Vue({
        el: '#dev-products',
        data(){
            return{

                id:"{{ $doc->id }}",
                categories:[],
                selectedCategory:"{{ $doc->category_id }}",
                title:"{{ $doc->title }}",
                errors:[],
                loading:false,
                order:"{{ $doc->order }}"

            }
        },
        methods:{

            update(){

                this.loading = true
                axios.post("{{ route('docs.update') }}", {
                    id:this.id,
                    category: this.selectedCategory,
                    title: this.title,
                    description: CKEDITOR.instances.editor1.getData(),
                    order:this.order
                }).then(res => {
                    this.loading = false
                    if(res.data.success == true){

                        swal({
                            title: "Excelente!",
                            text: res.data.msg,
                            icon: "success"
                        }).then(function() {
                            window.location.href = "{{ route('docs.list') }}";
                        });


                    }else{

                        alert(res.data.msg)
                    }

                }).catch(err => {

                    this.loading = false
                    this.errors = err.response.data.errors

                    swal({
                        text: "Hay campos que debes verificar!",
                        icon: "warning"
                    })

                })

            },

            async getCategories(){

                let categories = await axios.get("{{ route('categories.fetch') }}")
                this.categories = categories.data

            }

        },
        mounted(){

            let options = {
                filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form',
                language: "es"
            }

            CKEDITOR.replace( 'editor1', options );
            this.getCategories()

        }

    })

</script>