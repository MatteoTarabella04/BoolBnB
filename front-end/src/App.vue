<script>
import AppHeader from './components/AppHeader.vue';
import AppFooter from './components/AppFooter.vue';
export default {
    components: {
        AppHeader,
        AppFooter
    },
}
</script>

<template>
    <AppHeader></AppHeader>
    <router-view class="pb-5 pt-0 pt-sm-3 viewport_without_header"></router-view>
    <AppFooter></AppFooter>
</template>

<style lang="scss"></style>
