<template>
    <span>
        <!-- Give Quiz Feedback Button -->
        <button @click="openCreateQuizFeedback" class="my-2 mx-auto p-2 bg-gray-800 text-white rounded">Give Quiz Feedback</button>

        <!-- Create Quiz Feedback Modal -->
        <div ref="createQuizFeedbackModal" class="ml-min-100 p-4 fixed top-0 left-0 w-full h-screen hidden justify-center items-center flex-col bg-white z-30">
            <!-- Close Button -->
            <div class="absolute top-5 right-5">
                <i @click="closeCreateQuizFeedback" class="fas fa-times cursor-pointer text-2xl"></i>
            </div>

            <!-- Title -->
            <h1 class="mb-10 text-2xl w-4/5 text-left">Give Quiz Feedback!</h1>

            <!-- Model Box -->
            <div class="p-5 w-4/5 h-550 flex justify-center items-center flex-col bg-gray-800 rounded">
                <div class="mx-auto w-4/5">
                    <textarea class="pt-2 pl-3 w-full h-48 resize-none" type="text" placeholder="Quiz Feedback" v-model="body"></textarea>
                    <p class="mt-2 w-4/5 text-red-800" v-if="errors.body"><i class="fas fa-exclamation-circle"></i> {{errors.body}}</p>
                </div>

                <div class="mt-10 mx-auto w-4/5">
                    <button class="p-3 bg-white text-gray-800 rounded" @click="createAQuizFeedback">Create Quiz Feedback</button>
                </div>
            </div>
        </div>
    </span>
</template>

<script>
import {mapActions} from 'vuex';
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
        }
    },
    data(){
        return{
            body: '',
            errors:{
                body: ''
            }
        }
    },
    methods:{
        ...mapActions('quiz_feedback', ['getQuizFeedback', 'createQuizFeedback']),
        openCreateQuizFeedback(){
            tl.to(this.$refs.createQuizFeedbackModal, {marginLeft: '0', display: 'flex', duration: 0.3, ease: "power3.out"});
        },
        closeCreateQuizFeedback(){
            tl.to(this.$refs.createQuizFeedbackModal, {marginLeft: '-100%', display: 'hidden', duration: 0.3, ease: "power3.out"});
        },
        createAQuizFeedback(){
            if(this.bodyValidation(this.body) === false){
                this.bodyValidation(this.body);
            }

            const data = {
                'user_id': this.userId,
                'quiz_id': this.quizId,
                'body': this.body,
            };

            this.createQuizFeedback(data)
            .then(() => {
               this.getQuizFeedback(this.quizId); 
               bus.$emit('add_one_to_feedback_count', this.quizId);
            })
            .catch(error => {
                console.log(error.response);
            })
        },
        bodyValidation(body){
            if(body === ""){
                this.errors.body = 'Please enter some quiz feedback.';
                return false;
            }else if(body.length > 2000){
                this.errors.body = 'Your quiz feedback can\'t be more than 2000 characters';
                return false;
            }else{
                this.errors.body = '';
                return true;
            }
        }
    }
}
</script>