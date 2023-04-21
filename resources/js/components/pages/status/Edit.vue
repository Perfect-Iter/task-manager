<template>
    <div class="container h-100" >
        <Base />

        <h6 class="m-b-20 p-b-5 b-b-default f-w-600 mt-4 text-center ">Edit Task Status</h6>

        <div class="row container-fluid d-flex justify-content-center  mt-3 " style=" height: 600px;">
            <div class="col-xl">
                <div class="card h-100 " >
                    <div class="row m-l-0 m-r-0">
                        <div class="col">
                            <form action="#" method="post" class="p-4">
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600"> Name</p>
                                            <input type="text"
                                            class="form-control mb-2" v-model="name" >
                                        </div>
                                    </div>

                                    <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600"></h6>
                                    <div class="row">
                                        <button type="submit" class="btn btn-info">Update Changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </template>

    <script>
    import Base from '../../../components/layouts/Base.vue'

    export default {
        name: 'EditTaskStatus',

        data(){
        return {
            name: '',
            error: ''
        }
        },
        methods: {
            async status_edit(){
                    const res = await axios.post('api/status/edit', {
                        name: this.name,

                    });
                if(res.data.success){
                    console.log(res.data)

                    router.push({ name: 'TaskStatus' })
                }else{
                    this.error = res.data.message;
                }
            }
        },
        created() {
            if ("id" in this.$route.params) {
                const id = this.$route.params.id
                const res = axios.get('api/task',{ params: { id: id } })
                .then((response) => {
                    console.log(response)

                })
                console.log("id");
            } else {
            console.log("ups");
            // this
            }
        },
        components: {
            Base: Base,

        },
    }
    </script>

    <style>


    </style>
