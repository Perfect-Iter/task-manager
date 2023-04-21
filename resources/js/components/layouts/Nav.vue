<template>
    <div class="nav-scroller bg-secondary mt-2 box-shadow ">
      <nav class="nav nav-underline text-center px-4">
        <router-link :to="{ name: 'Home'}" class="nav-link active">Home</router-link>
        <router-link :to="{ name: 'NewTask'}" class="nav-link active">New Task</router-link>
        <router-link :to="{ name: 'TaskStatus'}" class="nav-link active">Status settings</router-link>
      </nav>
    </div>
</template>

<script>
export default {

}
</script>

<style>

</style>
