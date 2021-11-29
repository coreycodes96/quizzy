<template>
    <span>
        <i v-if="userId === quizFeedbackOwnerId" @dblclick="deleteAQuizFeedback(quizFeedbackId)" class="fas fa-trash text-red-600 cursor-pointer"></i>
    </span>
</template>

<script>
import {mapActions} from 'vuex';
import {bus} from '../../../../app.js';
export default {
    props:{
        userId:{
            type: Number,
        },
        quizId:{
            type: Number,
        },
        quizFeedbackOwnerId:{
            type: Number,
        },
        quizFeedbackIndex:{
            type: Number,
        },
        quizFeedbackId:{
            type: Number,
        }
    },
    methods:{
        ...mapActions('quiz_feedback', ['getQuizFeedback', 'deleteQuizFeedback']),
        deleteAQuizFeedback(id){
            const data = {
                id,
                'quiz_feedback_index': this.quizFeedbackIndex,
            };

            this.deleteQuizFeedback(data)
            .then(() => {
                this.getQuizFeedback(this.quizId);
                bus.$emit('take_one_away_from_feedback_count', this.quizId);
            })
            .catch(error => {
                console.log(error.response);
            })
        }
    }
}
</script>