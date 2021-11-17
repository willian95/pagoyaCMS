<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>

    var app = new Vue({
        el: '#dev-products',
        data(){
            return{

                categories:[],
                selectedCategory:"0",
                title:"",
                errors:[],
                loading:false

            }
        },
        methods:{

            store(){

                this.loading = true
                axios.post("{{ route('docs.store') }}", {
                    category: this.selectedCategory,
                    description: CKEDITOR.instances.editor1.getData(),
                    title:this.title
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

            CKEDITOR.replace( 'editor1' );
            this.getCategories()

        }

    })

</script>