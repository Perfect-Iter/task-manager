<template>
    <nav class="navbar navbar-expand-md fixed-top navbar-dark bg-primary px-3">
      <a class="navbar-brand" href="#">{{this.email}}</a>
      <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item active">
            <button @click="logout" class="nav-link">Logout</button>
          </li>
        </ul>
      </div>
    </nav>
</template>

<script>
import router from '../../router'


export default {

    data(){
        return {
            email: localStorage.getItem('email'),
        }
    },

    methods: {
        logout(){
            localStorage.removeItem('token');
            localStorage.removeItem('email');

            router.push({ name: 'Login' })
        }
    },
}
</script>

<style>

</style>
