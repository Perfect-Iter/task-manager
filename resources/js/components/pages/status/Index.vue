<template>
    <div class="container">
        <Base />
        <div class="mt-5 d-flex justify-content-end">
            <router-link :to="{ name: 'NewTaskStatus'}" class="btn btn-sm btn-outline-primary">Add a New Status</router-link>
        </div>
        <div class="table-responsive mt-3">
            <table class="table">
                <caption>List of Task Statuses</caption>
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Date Added</th>
                    <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="value in status_list" v-bind:key="value">
                        <th scope="row">{{ value.id }}</th>
                        <td>{{value.name}}</td>
                        <td>{{value.date_added}}</td>
                        <td>
                            <div class="">
                                <router-link :to="{ name: 'EditTaskStatus', params: { id: value.id}}" class="px-3 btn btn-sm btn-secondary">Edit</router-link>

                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import Base from '../../layouts/Base.vue'


export default {
    name: 'TaskStatus',

    data() {
        return {
            status_list: []
        }
    },

    mounted(){
        const res = axios.get('api/status')
        .then((response) => {
            //console.log(response)
            this.status_list = response.data.data
        })
        .catch((error) =>{
            console.log(error)
        })
    },
    components: {
        Base: Base
    },

}
</script>

<style>

</style>
