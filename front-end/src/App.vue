<script>
import AppHeader from './components/AppHeader.vue';
export default {
    components: {
        AppHeader,
    },
}
</script>

<template>
    <AppHeader></AppHeader>
    <router-view class="pb-3 pt-0 pt-sm-3"></router-view>
</template>

<style lang="scss"></style>
