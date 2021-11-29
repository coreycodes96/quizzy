<template>
    <span>
        <!-- Quiz Feedback Button -->
        <i @click="openQuizFeedbackModal" class="fas fa-comments cursor-pointer text-white"></i>
        <span :ref="`feedbackCount${quizId}`" class="ml-1 text-white">{{quizFeedbackCount}}</span>

        <!-- Quiz Feedback Modal -->
        <div ref="quizFeedbackModal" class="ml-min-100 p-4 fixed top-0 left-0 w-full h-screen hidden justify-center items-center flex-col bg-white z-20">
            <!-- Close Button -->
            <div class="absolute top-5 right-5">
                <i @click="closeQuizFeedbackModal" class="fas fa-times cursor-pointer text-2xl"></i>
            </div>

            <!-- Title -->
            <h1 class="mb-10 text-2xl w-4/5 text-left">Feedback On The Quiz!</h1>

            <!-- Create Quiz Feedback Button -->
            <CreateQuizFeedback :user-id="userId" :quiz-id="quizId"/>

            <!-- Model Box -->
            <div class="p-5 w-4/5 h-550 bg-gray-800 rounded overflow-y-scroll">
                <div v-for="(feedback, feedbackIndex) in fetchQuizFeedback" :key="feedback.id">
                    <div class="relative my-10 mx-auto p-3 w-4/5 h-auto bg-white text-gray-800 rounded">
                        <p class="mb-10 p-2 whitespace-pre-line">{{feedback.body}}</p>

                        <!-- Bottom Options -->
                        <div class="px-4 absolute bottom-0 left-0 w-full h-8 flex justify-between items-center">
                            <FavouriteQuizFeedback v-if="feedback.quiz_feedback_favourites" :user-id="userId" :quiz-id="quizId" :quiz-feedback-id="feedback.id" :quiz-feedback-index="feedbackIndex" :quiz-feedback-favourites="feedback.quiz_feedback_favourites"/>
                            <DeleteQuizFeedback :user-id="userId" :quiz-id="quizId" :quiz-feedback-owner-id="feedback.user_id" :quiz-feedback-index="feedbackIndex" :quiz-feedback-id="feedback.id"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </span>
</template>

<script>
import {mapActions, mapGetters} from 'vuex';
import CreateQuizFeedback from '../CreateQuizFeeback/CreateQuizFeedbackComponent.vue';
import FavouriteQuizFeedback from '../FavouriteQuizFeedback/FavouriteQuizFeedbackComponent.vue';
import DeleteQuizFeedback from '../DeleteQuizFeedback/DeleteQuizFeedbackComponent.vue';
import {bus} from '../../../../app.js';
export default {
    props:{
        userId:{
            type: Number,
            required: true,
        },
        quizId:{
            type: Number,
            required: true,
        },
        quizFeedbackCount:{
            type: Number,
        }
    },
    components:{CreateQuizFeedback, FavouriteQuizFeedback, DeleteQuizFeedback},
    methods:{
        ...mapActions('quiz_feedback', ['getQuizFeedback']),
        openQuizFeedbackModal(){
            tl.to(this.$refs.quizFeedbackModal, {marginLeft: '0', display: 'flex', duration: 0.3, ease: "power3.out"});

            this.getQuizFeedback(this.quizId);
        },
        closeQuizFeedbackModal(){
            tl.to(this.$refs.quizFeedbackModal, {marginLeft: '-100%', display: 'hidden', duration: 0.3, ease: "power3.out"});
        },
    },
    computed:{
        ...mapGetters('quiz_feedback', ['fetchQuizFeedback']),
    },
    created(){
        bus.$on('add_one_to_feedback_count', id => {
            if(id === this.quizId){
                this.$refs['feedbackCount'+id].innerText = parseInt(this.$refs['feedbackCount'+id].innerText) + 1;
            }
        })

        bus.$on('take_one_away_from_feedback_count', id => {
            if(id === this.quizId){
                this.$refs['feedbackCount'+id].innerText = parseInt(this.$refs['feedbackCount'+id].innerText) - 1;
            }
        })
    }
}
</script>