<template>
    <App>
        <div class="ml-6">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 text-center sm:text-3xl sm:truncate ml-6 mt-10">
                Quiz - {{ quiz.name }}
            </h2>
            <quote />

        </div>
    </App>
</template>

<script>
import App from "../../Layouts/App";
import Quote from "../../Components/Quote";
import {mapState} from "vuex";

export default {
    name: "Index",
    components: {Quote, App},
    data() {
        return {
            mode: 1,
        }
    },

    computed: mapState({
        quiz: state => state.QuizModule.quiz,
    })



}
</script>

<style scoped>

</style>
