<template>
    <div class="container">
        kuchh to aa
        {{msg}}
        <div>
            <!-- <transition name="fade">
            </transition> -->
            <!-- <router-view></router-view> -->
        </div>
    </div>
</template>

<style>
    /* .fade-enter-active, .fade-leave-active {
      transition: opacity .5s
    }
    .fade-enter, .fade-leave-active {
      opacity: 0
    } */
</style>

<script>

    export default{
        data(){
            return{
                msg:'hello world!!'
            }
        },
        mounted():{
            alert('chla')
        }
    }
</script>