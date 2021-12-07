<script>

    var app = new Vue({
        el: '#dev-list',
        data(){
            return{

                users:[],
                links:[],
                clientText:"",
                currentPage:"",
                totalPages:"",
                linkClass:"page-link",
                activeLinkClass:"page-link active-link bg-main",


            }
        },
        methods:{

            async fetch(link = "{{ route('prospects.fetch') }}"){

                let res = await axios.get(link)
                this.users = res.data.data
                this.links = res.data.links
                this.currentPage = res.data.current_page
                this.totalPages = res.data.last_page

            },

            showText(user){
                console.log(user)
                this.clientText = user.question

            }


        },
        mounted(){

           this.fetch()

        }

    })

</script>