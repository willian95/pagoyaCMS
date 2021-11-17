<script>

    var app = new Vue({
        el: '#dev-list',
        data(){
            return{

                docs:[],
                links:[],
                currentPage:"",
                totalPages:""


            }
        },
        methods:{

            async fetch(link = "{{ route('docs.fetch') }}"){

                let res = await axios.get("{{ route('docs.fetch') }}")
                this.docs = res.data.data
                this.links = res.data.links
                this.currentPage = res.data.current_page
                this.totalPages = res.data.last_page

            }


        },
        mounted(){

           this.fetch()

        }

    })

</script>