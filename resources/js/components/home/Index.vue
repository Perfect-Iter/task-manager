<template>
    <div class="container">
        <Base />

      <div class="my-3 p-3 bg-white rounded box-shadow">
        <h6 class="border-bottom border-gray pb-2 mb-0">Todays Tasks</h6>

        <div class="" v-for="value in task_list" v-bind:key="value.id" >
            <div class="card px-4">
                <div class="media text-muted pt-3">

                <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <div class="">
                            <strong class="text-gray-dark">{{value.name}}</strong> <br>
                            <small>Due: {{value.due_date}}</small>
                        </div>

                        <div class="">
                            {{value.status}}
                        </div>
                    </div>
                    <span class="mt-3 d-block">{{ value.description }}</span>
                </div>
                </div>
                <div class="py-2 d-flex justify-content-between">
                    <div class="">
                        <a href="#" class="mx-2">Start</a>
                        <a href="#" class="mx-2">End Task</a>
                    </div>

                    <div class="">
                        <a href="#" class="mx-2">Cancel Task</a>
                        <a href="#">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
</template>

<script>
import router from '../../router'
import Base from '../../components/layouts/Base.vue'
import Task from '../../components/home/components/Task.vue'

export default {
    methods: {
        async start_task(){
            const res = await axios.post('api/auth/register', {
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation
                });
               if(res.data.success){
                //console.log(res.data)
                localStorage.setItem('token', JSON.stringify(res.data.data.token));
                localStorage.setItem('email', JSON.stringify(res.data.data.email));

                router.push({ name: 'Home' })
               }else{
                this.error = res.data.message;
               }
        }
    },
    data(){
        return {
            email: localStorage.getItem('email'),
            task_list: []
        }
    },
    mounted(){

        const res = axios.get('api/task',{ params: { email: this.email } })
        .then((response) => {
            console.log(response)
            this.task_list = response.data.data
        })
        .catch((error) =>{
            console.log(error)
        })
    },
    components: {
    Base,
    Task
  },
}
</script>

<style>

</style>
