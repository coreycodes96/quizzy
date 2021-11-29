<template>
    <div class="select-none">
        <!-- Title -->
        <div class="mt-20 px-10 w-full text-3xl">
            <h1>Quizzes!</h1>
        </div>

        <!-- Show Quizzes -->
        <ShowQuizzes :user-id="userId" :username="username"></ShowQuizzes>

        <!-- Create Quiz -->
        <CreateQuiz :user-id="userId" :username="username"></CreateQuiz>
    </div>
</template>

<script>
import CreateQuiz from './CreateQuiz/CreateQuizComponent.vue';
import ShowQuizzes from './ShowQuizzes/ShowQuizzesComponent.vue';
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
        CreateQuiz,
        ShowQuizzes
    }
}
</script>