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
    <router-view class="py-5"></router-view>
</template>

<style lang="scss"></style>
