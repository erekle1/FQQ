<template>
    <App :loading="this.loading">
        <div class="ml-6">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 text-center sm:text-3xl sm:truncate ml-6 mt-10">
                Quiz - {{ quiz.name }}
            </h2>
            <div class="flex justify-center space-x-1.5">
                <button @click="mode=1"
                        class="px-4  py-2 mt-10 rounded-md text-sm font-medium border focus:outline-none focus:ring transition  border-gray-600  active:bg-gray-700 focus:ring-gray-300"
                        :class="{'bg-gray-600 text-white':mode===1}">
                    Multiple Choice
                </button>
                <button @click="mode=0"
                        class="px-4  py-2 mt-10 rounded-md text-sm font-medium border focus:outline-none focus:ring transition  border-gray-600  active:bg-gray-700 focus:ring-gray-300"
                        :class="{'bg-gray-600 text-white':mode===0}">
                    Binary
                </button>
            </div>

            <progress-bar :size="currentQuoteOrder"/>
            <div class="bg-white ring ring-gray-800 ring-offset-1 p-6 justify-center">
                <h6 class=" font-bold mb-4 mt-0"> Who said it?</h6>
                <p class="text-gray-700 text-sm mb-6">{{ this.currentQuoteOrder }}. {{ currentQuote.name }}</p>
                <div class="grid grid-cols-2 gap-8">
                    <div v-if="mode===1" v-for="(answer, i) in currentQuote.answers" @click="submitAnswer(answer)"
                         :class="{'ring-green-800 bg-green-800' :rightAnswer.id === answer.id, 'ring ring-red-800 bg-red-800': answer.id===selectedAnswer.id && rightAnswer.id !== answer.id, 'cursor-not-allowed': selectedAnswer !==false}"
                         class="ring ring-offset-1  text-white rounded cursor-pointer p-2.5 shadow ring ring-gray-800 bg-gray-800">
                        {{ i + 1 }}. {{ answer.answer }}
                    </div>
                    <div v-if="mode===0" class="col-span-2">
                        {{ randomAnswer.answer }}
                    </div>
                    <div v-if="mode===0" @click="submitAnswer(randomAnswer)"
                         class="ring ring-offset-1  text-white rounded cursor-pointer p-2.5 shadow ring ring-gray-800 bg-gray-800">
                        Yes
                    </div>
                    <div v-if="mode===0" @click="submitAnswer(false)"
                         class="ring ring-offset-1  text-white rounded cursor-pointer p-2.5 shadow ring ring-gray-800 bg-gray-800">
                        No
                    </div>

                </div>
                <div class="mt-10" v-if="selectedAnswer">
                    <span class="text-green-900" v-if="selectedAnswer.id===rightAnswer.id"> Correct! </span>
                    <span v-else class="text-red-900">Sorry, You are wrong.</span>
                    The right answer is {{ this.rightAnswer.answer }}
                </div>
            </div>
            <button @click.prevent="nextQuote"
                    class="px-4 py-2 mt-10 rounded-md text-sm font-medium border focus:outline-none focus:ring transition text-gray-600 border-gray-600 hover:text-white hover:bg-gray-600 active:bg-gray-700 focus:ring-gray-300 float-right">
                Next
            </button>

        </div>
    </App>
</template>

<script>
import App from "../../Layouts/App";
import ProgressBar from "../../Components/ProgressBar";

export default {
    name: "Index",
    components: {ProgressBar, App},
    data() {
        return {
            quiz: {},
            currentQuote: {},
            currentQuoteOrder: 1,
            rightAnswer: {},
            loading: false,
            selectedAnswer: false,
            mode: 1,
            randomAnswer: false
        }
    },
    created() {
        this.$axios.get('api/quiz').then(res => {
            this.quiz = res.data;
            this.currentQuote = this.quiz.quotes[0];
            this.randomAnswer = this.currentQuote.answers[Math.floor(Math.random() * 4)];
        });
    },
    methods: {
        submitAnswer(answer) {
            this.loading = true;
            if (!this.selectedAnswer) {
                this.$axios.get(`api/quiz/check-answer?quote_id=${this.currentQuote.id}`).then(res => {
                    this.selectedAnswer = answer;
                    this.rightAnswer = res.data;
                    this.updateAnswersStat(this.isRight(answer));
                    let isFinished = this.currentQuoteOrder === this.currentQuote.length;
                    this.updateFinishedStatus(isFinished)
                });
            }
        },
        isRight(answer) {
            if (answer) {
                return this.rightAnswer.id === answer.id;
            }
            return this.rightAnswer.id === this.selectedAnswer.id
        },

        updateAnswersStat(isRight) {
            return this.$axios.put('/api/stats/update-answers', {isRight: isRight})
        },
        updateFinishedStatus(isFinished) {
            if (isFinished) {
                return this.$axios.put('/api/stats/update-finished-status', {isFinished: isFinished})
            }
        },
        nextQuote() {
            this.currentQuote = this.quiz.quotes[this.currentQuoteOrder];
            this.currentQuoteOrder = this.currentQuoteOrder + 1;
            this.selectedAnswer = false;
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
