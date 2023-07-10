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
    <router-view class="py-3"></router-view>
</template>

<style lang="scss"></style>
