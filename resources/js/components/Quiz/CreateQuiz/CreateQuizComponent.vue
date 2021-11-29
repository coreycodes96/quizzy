<template>
    <div>
        <!-- Create A Quiz Button -->
        <div class="fixed bottom-0 right-0 flex justify-end items-center w-full h-16 z-10 pointer-events-none">
            <div class="mb-20 mr-5 p-1 bg-white rounded-full">
                <i @click="openQuizModal" class="fas fa-plus-circle text-gray-900 border-4 border-black rounded-full text-6xl cursor-pointer pointer-events-auto"></i>
            </div>
        </div>

        <!-- Modal -->
        <div ref="createQuizModal" class="ml-min-100 p-4 fixed top-0 left-0 w-full h-screen hidden justify-center items-center flex-col bg-white z-20">
            <!-- Close Button -->
            <div class="absolute top-5 right-5">
                <i @click="closeQuizModal" class="fas fa-times cursor-pointer text-2xl"></i>
            </div>

            <!-- Title -->
            <h1 class="mb-10 text-2xl w-4/5 text-left">Create Your Quiz!</h1>

            <!-- Model Box -->
            <div class="p-5 w-4/5 h-600 flex justify-center items-center flex-col bg-gray-800 rounded">
                <!-- Step 1 -->
                <template v-if="steps === 1">
                    <!-- Sub Header -->
                    <h2 class="my-10 text-white text-xl">Please enter the title of the quiz and select an image..</h2>

                    <!-- Title -->
                    <div class="w-full text-center">
                        <input class="pl-3 w-4/5 h-12" type="text" placeholder="Title" v-model="title"/>
                        <p class="mt-2 mx-auto w-4/5 text-left text-red-800" v-if="errors.title"><i class="fas fa-exclamation-circle"></i> {{errors.title}}</p>
                    </div>

                    <!-- Media -->
                    <div ref="media" class="w-full text-center">
                        <input @change="mediaChange($event)" class="mt-10 w-4/5 h-12" type="file" ref="file" placeholder="Media">
                        <p class="mt-2 mx-auto w-4/5 text-left text-red-800" v-if="errors.media"><i class="fas fa-exclamation-circle"></i> {{errors.media}}</p>
                    </div>

                    <!-- Step 1 Button -->
                    <div class="mt-10 mx-auto w-4/5">
                        <button class="p-3 w-48 bg-white text-gray-800 rounded" @click="createStep1">Done</button>
                    </div>
                </template>

                <!-- Step 2 -->
                <template v-if="steps === 2">
                    <!-- Question -->
                    <div class="w-full text-center">
                        <input class="pl-3 w-4/5 h-12" type="text" placeholder="Question" v-model="question"/>
                        <p class="mt-2 mx-auto w-4/5 text-left text-red-800" v-if="errors.question"><i class="fas fa-exclamation-circle"></i> {{errors.question}}</p>
                    </div>

                    <!-- Answer 1 and 2 -->
                    <div class="mt-10 mx-auto w-4/5 flex justify-between items-center text-center">
                        <div>
                            <input class="pl-3 w-full h-12" type="text" placeholder="Answer 1" v-model="answer1"/>
                            <p class="mt-2 mx-auto w-4/5 text-left text-red-800" v-if="errors.answer1"><i class="fas fa-exclamation-circle"></i> {{errors.answer1}}</p>
                        </div>

                        <div>
                            <input class="pl-3 w-full h-12" type="text" placeholder="Answer 2" v-model="answer2"/>
                            <p class="mt-2 mx-auto w-4/5 text-left text-red-800" v-if="errors.answer2"><i class="fas fa-exclamation-circle"></i> {{errors.answer2}}</p>
                        </div>
                    </div>

                    <!-- Answer 3 and 4 -->
                    <div class="mt-10 mx-auto w-4/5 flex justify-between items-center text-center">
                        <div>
                            <input class="pl-3 w-full h-12" type="text" placeholder="Answer 3" v-model="answer3"/>
                            <p class="mt-2 mx-auto w-4/5 text-left text-red-800" v-if="errors.answer3"><i class="fas fa-exclamation-circle"></i> {{errors.answer3}}</p>
                        </div>

                        <div>
                            <input class="pl-3 w-full h-12" type="text" placeholder="Answer 4" v-model="answer4"/>
                            <p class="mt-2 mx-auto w-4/5 text-left text-red-800" v-if="errors.answer4"><i class="fas fa-exclamation-circle"></i> {{errors.answer4}}</p>
                        </div>
                    </div>

                    <!-- Correct Answer -->
                    <div class="mt-10 w-full text-center">
                        <input class="pl-3 w-4/5 h-12" type="text" placeholder="Correct Answer" v-model="correct_answer"/>
                        <p class="mt-2 mx-auto w-4/5 text-left text-red-800" v-if="errors.correct_answer"><i class="fas fa-exclamation-circle"></i> {{errors.correct_answer}}</p>
                    </div>

                    <!-- Create Quiz Button -->
                    <div class="mt-10 mx-auto w-4/5">
                        <button class="p-3 bg-white text-gray-800 rounded" @click="createAQuiz">Create Quiz</button>
                    </div>
                </template>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions} from 'vuex';
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
    data(){
        return{
            title: '',
            media: null,
            question: '',
            answer1: '',
            answer2: '',
            answer3: '',
            answer4: '',
            correct_answer: '',
            errors:{
                title: '',
                media: '',
                question: '',
                answer1: '',
                answer2: '',
                answer3: '',
                answer4: '',
                correct_answer: '',
            },
            steps: 1
        }
    },
    methods:{
        ...mapActions('quiz', ['getQuizzes', 'createQuiz']),
        openQuizModal(){
            tl.to(this.$refs.createQuizModal, {marginLeft: '0', display: 'flex', duration: 0.3, ease: "power3.out"});
        },
        //Close Posts
        closeQuizModal(){
            tl.to(this.$refs.createQuizModal, {marginLeft: '-100%', display: 'hidden', duration: 0.3, ease: "power3.out"});

            //Clear inputs
            this.title = '';
            this.media = '';
            this.question = '';
            this.answer1 = '';
            this.answer2 = '';
            this.answer3 = '';
            this.answer4 = '';
            this.correct_answer = '';

            //Clear input errors
            this.errors.title = '';
            this.errors.media = '';
            this.errors.question = '';
            this.errors.answer1 = '';
            this.errors.answer2 = '';
            this.errors.answer3 = '';
            this.errors.answer4 = '';
            this.errors.correct_answer = '';
        },
        mediaChange(event){
            this.media = event.target.files[0];
        },
        createStep1(){
            //Title Validation
            if(this.titleValidation(this.title) === false){
                this.titleValidation(this.title);
            }

            //Media Validation
            if(this.mediaValidation(this.media) === false){
                this.mediaValidation(this.media);
            }

            //Create Step1
            if(this.titleValidation(this.title) === true && this.mediaValidation(this.media) === true){
                this.steps = 2;
            }
        },
        createAQuiz(){
            //Question Validation
            if(this.questionValidation(this.question) === false){
                this.questionValidation(this.question);
            }

            //Answer 1 Validation
            if(this.answer1Validation(this.answer1) === false){
                this.answer1Validation(this.answer1);
            }

            //Answer 2 Validation
            if(this.answer2Validation(this.answer2) === false){
                this.answer2Validation(this.answer2);
            }

            //Answer 3 Validation
            if(this.answer3Validation(this.answer3) === false){
                this.answer3Validation(this.answer3);
            }

            //Answer 4 Validation
            if(this.answer4Validation(this.answer4) === false){
                this.answer4Validation(this.answer4);
            }

            //Correct Answer Validation
            if(this.correctAnswerValidation(this.correct_answer) === false){
                this.correctAnswerValidation(this.correct_answer);
            }

            //Create Quiz
            if(this.questionValidation(this.question) === true && this.answer1Validation(this.answer1) === true && this.answer2Validation(this.answer2) === true && this.answer3Validation(this.answer3) === true && this.answer4Validation(this.answer4) === true && this.correctAnswerValidation(this.correct_answer) === true){
                //Quiz data
                const quizData = {
                    'question': this.question,
                    'answer1': this.answer1,
                    'answer2': this.answer2,
                    'answer3': this.answer3,
                    'answer4': this.answer4,
                    'correct_answer': this.correct_answer
                };
                
                //Form Data
                let data = new FormData();
                data.append('user_id', this.userId);
                data.append('title', this.title);
                data.append('image', this.media);
                data.append('data', JSON.stringify(quizData));

                //Create Quiz
                this.createQuiz(data)
                .then(res => {
                    console.log(res.data);
                    this.title = '';
                    this.media = '';
                    this.question = '';
                    this.answer1 = '';
                    this.answer2 = '';
                    this.answer3 = '';
                    this.answer4 = '';
                    this.correct_answer = '';
                    this.getQuizzes();
                })
                .catch(error => {
                    console.log(error.response);
                })
            }
        },
        titleValidation(title){
            if(title === ""){
                this.errors.title = 'Please enter a title.';
                return false;
            }else if(title.length > 140){
                this.errors.title = 'Your title can\'t be more than 140 characters.';
                return false;
            }else{
                this.errors.title = '';
                return true;
            }
        },
        mediaValidation(media){
            const ext = ['png', 'jpeg', 'jpg'];
            
            if(media === null){
                this.errors.media = 'Please select a file';
                return false;
            }else if(ext.includes(media.type.split('/')[1]) === false){
                this.errors.media = 'You have selected the wrong file type.';
                return false;
            }else if(media.size > 2097152){
                this.errors.media = 'File size is too large.';
                return false;
            }else{
                this.errors.media = '';
                return true;
            }
        },
        questionValidation(question){
            if(question === ""){
                this.errors.question = 'Please enter a question';
                return false;
            }else if(question[question.length - 1] !== '?'){
                this.errors.question = 'Please add a question mark (?) at the end of your question.';
                return false;
            }else{
                this.errors.question = '';
                return true;
            }
        },
        answer1Validation(answer){
            if(answer === ""){
                this.errors.answer1 = 'Please enter an answer.';
                return false;
            }else{
                this.errors.answer1 = '';
                return true;
            }
        },
        answer2Validation(answer){
            if(answer === ""){
                this.errors.answer2 = 'Please enter an answer.';
                return false;
            }else{
                this.errors.answer2 = '';
                return true;
            }
        },
        answer3Validation(answer){
            if(answer === ""){
                this.errors.answer3 = 'Please enter an answer.';
                return false;
            }else{
                this.errors.answer3 = '';
                return true;
            }
        },
        answer4Validation(answer){
            if(answer === ""){
                this.errors.answer4 = 'Please enter an answer.';
                return false;
            }else{
                this.errors.answer4 = '';
                return true;
            }
        },
        correctAnswerValidation(correct_answer){
            if(correct_answer === ""){
                this.errors.correct_answer = 'Please enter the correct answer for your question.';
                return false;
            }else{
                this.errors.correct_answer = '';
                return true;
            }
        }
    }
}
</script>