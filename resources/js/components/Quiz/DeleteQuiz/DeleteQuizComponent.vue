<template>
    <span>
        <i v-if="userId === quizOwnerId" @dblclick="deleteAQuiz(quizId)" class="fas fa-trash text-red-600 cursor-pointer"></i>
    </span>
</template>

<script>
import {mapActions} from 'vuex';
export default {
    props:{
        quizId:{
            type: Number,
        },
        userId:{
            type: Number,
        },
        quizIndex:{
            type: Number,
        },
        quizOwnerId:{
            type: Number,
        }
    },
    methods:{
        ...mapActions('quiz', ['getQuizzes', 'deleteQuiz']),
        deleteAQuiz(id){
            const data = {
                id,
                'quiz_index': this.quizIndex,
            };

            this.deleteQuiz(data)
            .then(() => {
                this.getQuizzes();
            })
            .catch(error => {
                console.log(error.response);
            })
        }
    }
}
</script>