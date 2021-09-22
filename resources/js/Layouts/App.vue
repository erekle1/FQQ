<template>
    <div>
        <Nav/>
        <main class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <slot/>
        </main>
    </div>
</template>

<script>
import Nav from "../Components/Nav";

export default {
    name: "App",
    components: {Nav}
}
</script>

<style scoped>

</style>
