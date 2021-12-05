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
                    title:this.title,
                    order:this.order
                }).then(res => {
                    this.loading = false
                    if(res.data.success == true){

                        swal({
                            order: this.order,
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

            },

            isNumber(evt) {
                evt = (evt) ? evt : window.event;
                var charCode = (evt.which) ? evt.which : evt.keyCode;
                if ((charCode > 31 && (charCode < 48 || charCode > 57))) {
                    evt.preventDefault();;
                } else {
                    return true;
                }
            },

        },
        mounted(){

            CKEDITOR.replace( 'editor1' );
            this.getCategories()

        }

    })

</script>