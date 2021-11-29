<template>
    <span>
        <i @click="favouriteOrUnfavouriteAQuizFeedback" :class="quizFeedbackFavouriteIcon"></i>
        <span class="text-gray-800">{{quizFeedbackFavourites.length}}</span>
    </span>
</template>

<script>
import {mapActions} from 'vuex';
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
        quizFeedbackId:{
            type: Number,
            required: true,
        },
        quizFeedbackIndex:{
            type: Number,
            required: true,
        },
        quizFeedbackFavourites:{
            type: Array,
            required: true,
        }
    },
    methods:{
        ...mapActions('quiz_feedback', ['getQuizFeedback', 'favouriteQuizFeedback', 'unfavouriteQuizFeedback']),
        favouriteOrUnfavouriteAQuizFeedback(){
            if(this.quizFeedbackFavourites.find(quizFeedback => quizFeedback.user_id === this.userId)){
                const quizFeedbackFavouriteId = this.quizFeedbackFavourites.find(quizFeedback => quizFeedback.user_id === this.userId).id;
                this.unfavouriteQuizFeedback(quizFeedbackFavouriteId)
                .then(() => {
                    this.getQuizFeedback(this.quizId);
                })
                .catch(error => {
                    console.log(error.response);
                })
            }else{
                const data = {
                    'quiz_feedback_id': this.quizFeedbackId,
                    'user_id': this.userId,
                    'quiz_feedback_index': this.quizFeedbackIndex,
                };

                this.favouriteQuizFeedback(data)
                .then(() => {
                    this.getQuizFeedback(this.quizId);
                })
                .catch(error => {
                    console.log(error.response);
                })
            }
        }
    },
    computed:{
        quizFeedbackFavouriteIcon(){
            return this.quizFeedbackFavourites.find(quizFeedback => quizFeedback.user_id === this.userId) ? 'ml-2 fas fa-heart-broken text-red-600 cursor-pointer' : 'ml-2 fas fa-heart text-red-600 cursor-pointer';
        }
    }
}
</script>