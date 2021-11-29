<template>
    <div>
        <!-- No Quizzes -->
        <template v-if="userQuizzes.length === 0">
            <div>
                <h3 class="text-3xl text-center text-white">Sorry No Quizzes</h3>
            </div>
        </template>

        <div v-for="(quiz) in mapppedQuizData" :key="quiz.id">
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
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:{
        userQuizzes:{
            type: Array,
            required: true,
        }
    },
    data(){
        return{
            answered: {
                id: 0,
                correct: false,
            }
        }
    },
    methods:{
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
        mapppedQuizData(){
            const newData = this.userQuizzes.map(quiz => {
                return {
                    'id': Number(quiz.id),
                    'user_id': Number(quiz.user_id),
                    'title': quiz.title,
                    'image': quiz.image,
                    'data': JSON.parse(quiz.data),
                    'created_at': quiz.created_at,
                    'updated_at': quiz.updated_at,
                }
            })

            return newData;
        }
    },
}
</script>