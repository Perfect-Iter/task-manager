<template>
<div class="container h-100" >
    <Base />

    <h6 class="m-b-20 p-b-5 b-b-default f-w-600 mt-4 text-center ">Create a New Task</h6>

    <div class="row container-fluid d-flex justify-content-center  mt-3 " style=" height: 600px;">
        <div class="col-xl">
            <div class="card h-100 " >
                <div class="row m-l-0 m-r-0">
                    <div class="col">
                        <form action="#" method="post" class="p-4" @submit.prevent="task_create">
                            <div class="card-block">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600"> Name</p>
                                        <input type="text" class="form-control mb-2" name="name" v-model="name">
                                    </div>

                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Due date</p>
                                        <VueDatePicker v-model="date"  week-numbers="iso" />
                                    </div>
                                    <div class="col-sm-12 form-group ">
                                    <label for="" class="control-label">Description</label>
                                    <textarea v-model="description" name="description" id="" cols="30" rows="4" class="form-control"></textarea>
                                    </div>

                                </div>

                                <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600"></h6>
                                <div class="row">
                                    <button type="submit" class="btn btn-info">Save Changes</button>
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
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

import router from '../../../router'

export default {
    name: 'NewTask',

    components: {
        Base: Base,
        VueDatePicker,
    },
    data(){
        return {
            name: '',
            date: '',
            description: '',
            email: localStorage.getItem('email'),
            error: ''
        }
    },
    methods: {
        async task_create(){
                const res = await axios.post('api/task/create', {
                    name: this.name,
                    due_date: this.date,
                    description: this.description,
                    email: this.email,
                });
               if(res.data.success){
                console.log(res.data)

                router.push({ name: 'Home' })
               }else{
                this.error = res.data.message;
               }
            }
    },
}
</script>

<style>


    .card {
        border-radius: 5px;
        -webkit-box-shadow: 0 1px 20px 0 rgba(69,90,100,0.08);
        box-shadow: 0 1px 20px 0 rgba(69,90,100,0.08);
        border: none;
        margin-bottom: 30px;
    }

    .m-r-0 {
        margin-right: 0px;
    }

    .m-l-0 {
        margin-left: 0px;
    }

    .user-card-full .user-profile {
        border-radius: 5px 0 0 5px;
    }

    .bg-c-lite-green {
        background: -webkit-gradient(linear, left top, right top, from(#f29263), to(#ee5a6f));
        background: linear-gradient(to right, #ee5a6f, #f29263);
    }

    .user-profile {
        padding: 20px 0;
    }

    .card-block {
        padding: 1.25rem;
    }

    .m-b-25 {
        margin-bottom: 25px;
    }

    .img-radius {
        border-radius: 5px;
    }



    /* h6 {
        font-size: 14px;
    } */

    .card .card-block p {
        line-height: 25px;
    }

    @media only screen and (min-width: 1400px){
    p {
        font-size: 14px;
    }
    }

    .card-block {
        padding: 1.25rem;
    }

    .b-b-default {
        border-bottom: 1px solid #e0e0e0;
    }

    .m-b-20 {
        margin-bottom: 20px;
    }

    .p-b-5 {
        padding-bottom: 5px !important;
    }

    .card .card-block p {
        line-height: 25px;
    }

    .m-b-10 {
        margin-bottom: 10px;
    }

    .text-muted {
        color: #919aa3 !important;
    }

    .b-b-default {
        border-bottom: 1px solid #e0e0e0;
    }

    .f-w-600 {
        font-weight: 600;
    }

    .m-b-20 {
        margin-bottom: 20px;
    }

    .m-t-40 {
        margin-top: 20px;
    }

    .p-b-5 {
        padding-bottom: 5px !important;
    }

    .m-b-10 {
        margin-bottom: 10px;
    }

    .m-t-40 {
        margin-top: 20px;
    }

    /* .user-card-full .social-link li {
        display: inline-block;
    }

    .user-card-full .social-link li a {
        font-size: 20px;
        margin: 0 10px 0 0;
        -webkit-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
    } */
</style>
