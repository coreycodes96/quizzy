<template>
    <div class="text-center">
        <!-- Create FAQ Button -->
        <button class="mx-auto p-3 w-4/5 bg-white text-gray-800 rounded" @click="openFAQModal">Create FAQ</button>

        <!-- Create FAQ Modal -->
        <div ref="createFAQModal" class="ml-min-100 p-4 fixed top-0 left-0 w-full h-screen hidden justify-center items-center flex-col bg-white z-20"> 
            <!-- Close FAQ Modal -->
            <div class="absolute top-5 right-5">
                <i @click="closeFAQModal" class="fas fa-times cursor-pointer text-2xl"></i>
            </div>

            <!-- Create FAQ Modal -->
            <div class="p-5 w-4/5 h-600 flex justify-center items-center flex-col bg-gray-800 rounded">
                <!-- Question -->
                <div class="w-full text-center">
                    <input class="pl-3 w-4/5 h-12" type="text" placeholder="Question.." v-model="question"/>
                    <p class="mt-2 mx-auto w-4/5 text-left text-red-800" v-if="errors.question"><i class="fas fa-exclamation-circle"></i> {{errors.question}}</p>
                </div>

                <!-- Answer -->
                <div class="mt-10 w-full text-center">
                    <input class="pl-3 w-4/5 h-12" type="text" placeholder="Answer.." v-model="answer"/>
                    <p class="mt-2 mx-auto w-4/5 text-left text-red-800" v-if="errors.answer"><i class="fas fa-exclamation-circle"></i> {{errors.answer}}</p>
                </div>

                <div class="mt-10 mx-auto w-4/5">
                    <button class="p-3 w-48 bg-white text-gray-800 rounded" @click="createAFAQ">Create FAQ</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions} from 'vuex';
export default {
    data(){
        return{
            question: '',
            answer: '',
            errors:{
                question: '',
                answer: '',
            }
        }
    },
    methods:{
        ...mapActions('admin', ['getFAQs', 'createFAQ']),
        openFAQModal(){
            tl.to(this.$refs.createFAQModal, {marginLeft: '0', display: 'flex', duration: 0.3, ease: "power3.out"});
        },
        closeFAQModal(){
            tl.to(this.$refs.createFAQModal, {marginLeft: '-100%', display: 'hidden', duration: 0.3, ease: "power3.out"});
        },
        createAFAQ(){
            //Question validation
            if(this.questionValidation(this.question) === false){
                this.questionValidation(this.question);
            }

            //Answer validation
            if(this.answerValidation(this.answer) === false){
                this.answerValidation(this.answer);
            }

            //If validation passes
            if(this.questionValidation(this.question) === true && this.answerValidation(this.answer) === true){
                const data = {
                    'question': this.question,
                    'answer': this.answer,
                };

                this.createFAQ(data)
                .then(() => {
                    this.getFAQs();
                })
                .catch(error => {
                    console.log(error.response);
                })
            }
        },
        questionValidation(question){
            if(question === ""){
                this.errors.question = 'Please enter a question';
                return false;
            }else if(question.length > 140){
                this.errors.question = 'Your question can\'t be more than 140 characters.';
                return false;
            }else{
                this.errors.question = '';
                return true;
            }
        },
        answerValidation(answer){
            if(answer === ""){
                this.errors.answer = 'Please enter an answer';
                return false;
            }else if(answer.length > 500){
                this.errors.answer = 'Your answer can\'t be more than 500 characters.';
                return false;
            }else{
                this.errors.answer = '';
                return true;
            }
        }
    }
}
</script>