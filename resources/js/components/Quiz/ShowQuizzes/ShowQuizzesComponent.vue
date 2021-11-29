<template>
    <div>
        <!-- No Quizzes -->
        <template v-if="fetchQuizzes.length === 0">
            <div class="p-5 w-full h-550 flex justify-center items-center">
                <p class="text-2xl text-gray-800">SORRY NO QUIZZES</p>
            </div>
        </template>

        <!-- Display Quizzes -->
        <template v-else>
            <div v-for="(quiz, quizIndex) in mapppedQuizData" :key="quiz.id">
                <div class="my-20 relative w-full h-screen overflow-hidden">
                    <img class="object-fit w-full h-full" :src="`../storage/${quiz.image}`" alt="post">
                    
                    <template v-if="answered.id === quiz.id">
                        <!-- Correct -->
                        <div v-if="answered.correct === true" class="absolute top-0 left-0 w-full h-screen flex justify-center items-center flex-col bg-green-600 text-white z-30">
                            <p class="text-4xl">CORRECT</p>
                        </div>
                        
                        <!-- Incorrect -->
                        <div v-if="answered.correct === false" class="absolute top-0 left-0 w-full h-screen flex justify-center items-center flex-col bg-red-600 text-white z-30">
                            <p class="text-4xl">INCORRECT</p>
                        </div>
                    </template>

                    <div class="absolute top-0 left-0 w-full h-screen bg-black bg-opacity-70 flex justify-center items-center flex-col text-white">
                        <!-- Title -->
                        <h2 class="mx-auto p-3 w-3/5 bg-white text-gray-800 text-4xl text-center">{{quiz.title}}</h2>

                        <!-- Display Quiz -->
                        <div class="mt-20 w-4/5">
                            <!-- Question -->
                            <h4 class="mb-10 text-2xl">{{quiz.data.question}}</h4>

                            <!-- Answer 1 & 2 -->
                            <div class="mx-auto w-full flex justify-around items-center">
                                <button @click="checkAnswer(quiz.id, quiz.data.answer1, quiz.data.correct_answer)" class="mr-5 w-full h-8 bg-white text-gray-800">{{quiz.data.answer1}}</button>
                                <button @click="checkAnswer(quiz.id, quiz.data.answer2, quiz.data.correct_answer)" class="w-full h-8 bg-white text-gray-800">{{quiz.data.answer2}}</button>
                            </div>

                            <!-- Answer 3 & 4 -->
                            <div class="mt-5 mx-auto w-full flex justify-around items-center">
                                <button @click="checkAnswer(quiz.id, quiz.data.answer3, quiz.data.correct_answer)" class="mr-5 w-full h-8 bg-white text-gray-800">{{quiz.data.answer3}}</button>
                                <button @click="checkAnswer(quiz.id, quiz.data.answer4, quiz.data.correct_answer)" class="w-full h-8 bg-white text-gray-800">{{quiz.data.answer4}}</button>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Options -->
                    <div class="absolute bottom-0 left-0 w-full h-12 flex justify-around items-center bg-gray-800">
                        <FavouriteQuiz v-if="quiz.quiz_favourites" :quiz-id="quiz.id" :user-id="userId" :quiz-owner-id="quiz.user_id" :quiz-index="quizIndex" :quiz-favourites="quiz.quiz_favourites"/>
                        <DeleteQuiz :quiz-id="quiz.id" :user-id="userId" :quiz-index="quizIndex" :quiz-owner-id="quiz.user_id"/> 
                        <ShowQuizFeedback :user-id="userId" :quiz-id="quiz.id" :quiz-feedback-count="quiz.quiz_feedback_count"/>
                    </div>
                </div>
            </div>
        </template>
    </div>
</template>

<script>
import {mapActions, mapGetters} from 'vuex';
import FavouriteQuiz from '../FavouriteQuiz/FavouriteQuizComponent.vue';
import DeleteQuiz from '../DeleteQuiz/DeleteQuizComponent.vue';
import ShowQuizFeedback from '../QuizFeedback/ShowQuizFeedback/ShowQuizFeedbackComponent.vue';
export default {
    props:{
        userId:{
            type: Number,
            required: true
        },
        username:{
            type: String,
            required: true
        }
    },
    components:{
        FavouriteQuiz,
        DeleteQuiz,
        ShowQuizFeedback,
    },
    data(){
        return{
            answered: {
                id: 0,
                correct: false
            }
        }
    },
    methods:{
        ...mapActions('quiz', ['getQuizzes']),
        checkAnswer(id, answer, correct_answer){
            if(answer === correct_answer){
                this.answered.id = id;
                this.answered.correct = true;
            }else{
                this.answered.id = id;
                this.answered.correct = false;
            }
        }
    },
    computed:{
        ...mapGetters('quiz', ['fetchQuizzes']),
        mapppedQuizData(){
            const newData = this.fetchQuizzes.map(quiz => {
                return {
                    'id': Number(quiz.id),
                    'user_id': Number(quiz.user_id),
                    'title': quiz.title,
                    'image': quiz.image,
                    'data': JSON.parse(quiz.data),
                    'created_at': quiz.created_at,
                    'updated_at': quiz.updated_at,
                    'quiz_favourites': quiz.quiz_favourites,
                    'quiz_feedback_count': quiz.quiz_feedback_count,
                }
            })

            return newData;
        }
    },
    created(){
        this.getQuizzes()
    }
}
</script>