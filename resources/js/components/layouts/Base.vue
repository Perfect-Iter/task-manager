<template>
  <div class="">
   <Header />
   <Nav />
  </div>
</template>

<script>
import Header from './Header.vue'
import Nav from './Nav.vue'

export default {
    name: 'Base',
    components: {
        Header: Header,
        Nav: Nav,
    },

}
</script>

<style>
@import './base.css';
</style>
