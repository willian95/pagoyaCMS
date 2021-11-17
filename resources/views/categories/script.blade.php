<script>
        
    const app = new Vue({
        el: '#dev-category',
        data(){
            return{
                modalTitle:"Nueva categoría",
                order:"",
                name:"",
                categoryId:"",
                action:"create",
                categories:[],
                errors:[],
                pages:0,
                page:1,
                showMenu:false,
                loading:false,
            }
        },
        methods:{
            
            create(){
                this.modalTitle = "Crear categoría"
                this.action = "create"
                this.name = ""
                this.categoryId = ""
                this.order = ""
            },
            store(){

                this.loading = true
                axios.post("{{ route('categories.store') }}", {name: this.name, order: this.order})
                .then(res => {
                    this.loading = false
                    if(res.data.success == true){

                        swal({
                            title: "Perfecto!",
                            text: res.data.msg,
                            icon: "success"
                        });
                        this.name = ""
                        this.order = ""
                        this.fetch()

                        $('#categoryModal').modal('hide')
                        $('.modal-backdrop').remove()
                    }else{

                        swal({
                            title: "Lo sentimos!",
                            text: res.data.msg,
                            icon: "error"
                        });

                    }

                })
                .catch(err => {
                    this.loading = false
                    this.errors = err.response.data.errors
                })

            },
            update(){

                this.loading = true
                axios.post("{{ route('categories.update') }}", {id: this.categoryId, name: this.name, order:this.order})
                .then(res => {
                    this.loading = false
                    if(res.data.success == true){

                        swal({
                            title: "Excelente!",
                            text: res.data.msg,
                            icon: "success"
                        });
                        this.name = ""
                        this.categoryId = ""
                        this.order = ""
                        $('#categoryModal').modal('hide')
                        $('.modal-backdrop').remove()
                        this.fetch()
                        
                    }else{

                        swal({
                            title: "Lo sentimos!",
                            text: res.data.msg,
                            icon: "error"
                        });

                    }

                })
                .catch(err => {
                    this.loading = false
                    this.errors = err.response.data.errors
                })

            },
            edit(category){
                this.modalTitle = "Editar categoría"
                this.action = "edit"
                this.order = category.order
                this.name = category.name
                this.categoryId = category.id

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
            fetch(){

                axios.get("{{ route('categories.fetch') }}")
                .then(res => {

                    this.categories = res.data

                })

            },
            erase(id){
                
                swal({
                    title: "¿Estás seguro?",
                    text: "Eliminarás esta categoría!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        this.loading = true
                        axios.post("{{ route('categories.delete') }}", {id: id}).then(res => {
                            this.loading = false
                            if(res.data.success == true){
                                swal({
                                    title: "Genial!",
                                    text: res.data.msg,
                                    icon: "success"
                                });
                                this.fetch()
                            }else{

                                swal({
                                    title: "Lo sentimos!",
                                    text: res.data.msg,
                                    icon: "error"
                                });

                            }

                        }).catch(err => {
                            this.loading = false
                            $.each(err.response.data.errors, function(key, value){
                                alert(value)
                            });
                        })

                    }
                });

            },
            toggleMenu(){

                if(this.showMenu == false){
                    $("#menu").addClass("show")
                    this.showMenu = true
                }else{
                    $("#menu").removeClass("show")
                    this.showMenu = false
                }

            }


        },
        mounted(){
            
            this.fetch()

        }

    })

</script>