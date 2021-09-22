<template>
    <App>
        <div class="ml-6">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 text-center sm:text-3xl sm:truncate ml-6 mt-10 mb-10">
                {{ quiz.name }}
            </h2>

            <div class="bg-white ring ring-gray-800 ring-offset-1 p-6 justify-center">
                <h5 class="text-3xl font-bold mb-4 mt-0"></h5>
                <p class="text-gray-700 text-sm mb-6">{{this.currentQuoteOrder}}. {{ currentQuote.name }}</p>
                <div class="grid grid-cols-2 gap-8">
                    <div v-for="(answer, i) in currentQuote.answers"
                         class="ring ring-gray-800 ring-offset-1  text-white rounded cursor-pointer p-2.5 shadow bg-gray-800">
                        {{ i + 1 }}. {{ answer.answer }}
                    </div>
                </div>
            </div>

            <button :disabled="currentQuoteOrder===1" @click.prevent="previousQuote"
                    class="px-4 py-2 mt-10 rounded-md text-sm disabled:opacity-50 font-medium border focus:outline-none focus:ring transition text-gray-600 border-gray-600 hover:text-white hover:bg-gray-600 active:bg-gray-700 focus:ring-gray-300 float-left">
                Previous
            </button>
            <button :disabled="currentQuoteOrder===quiz.quotes.length" @click.prevent="nextQuote"
                    class="disabled:opacity-50 px-4 py-2 mt-10 rounded-md text-sm font-medium border focus:outline-none focus:ring transition text-gray-600 border-gray-600 hover:text-white hover:bg-gray-600 active:bg-gray-700 focus:ring-gray-300 float-right">
                Next
            </button>

        </div>
    </App>
</template>

<script>
import App from "../../Layouts/App";

export default {
    name: "Index",
    components: {App},
    data() {
        return {
            quiz: {},
            currentQuote: {},
            currentQuoteOrder: 1
        }
    },
    beforeCreate() {
        this.$axios.get('api/quiz').then(res => {
            this.quiz = res.data;
            this.currentQuote = this.quiz.quotes[0];
        });
    },
    methods: {
        nextQuote() {
            this.currentQuote = this.quiz.quotes[this.currentQuoteOrder];
            this.currentQuoteOrder = this.currentQuoteOrder + 1;
        },
        previousQuote() {
            this.currentQuote = this.quiz.quotes[this.currentQuoteOrder];
            this.currentQuoteOrder = this.currentQuoteOrder - 1;
        }
    }
}
</script>

<style scoped>

</style>
