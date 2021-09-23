<template>
    <div>
        <Nav/>
        <main class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <slot/>
        </main>
        <div v-if="loading" class="flex justify-center items-center">
            <div class="animate-spin rounded-full h-20 2-20 border-t-2 border-b-2 border-gray-500"></div>
        </div>
    </div>
</template>

<script>
import Nav from "../Components/Nav";

export default {
    name: "App",
    components: {Nav},
    props: {
        loading: Boolean
    }
}
</script>

<style scoped>

</style>
