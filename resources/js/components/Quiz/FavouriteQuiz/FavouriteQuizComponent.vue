<template>
    <span>
        <i @click="favouriteOrUnfavouriteAQuiz" :class="quizFavouriteIcon"></i>
        <span class="ml-1 text-white">{{quizFavourites.length}}</span>
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
        quizOwnerId:{
            type: Number,
        },
        quizIndex:{
            type: Number,
        },
        quizFavourites:{
            type: Array,
        },
    },
    methods:{
        ...mapActions('quiz', ['getQuizzes', 'favouriteQuiz', 'unfavouriteQuiz']),
        favouriteOrUnfavouriteAQuiz(){
            const data = {
                'quiz_id': this.quizId,
                'user_id': this.userId,
                'quiz_index': this.quizIndex
            };

            if(this.quizFavourites.find(quiz => quiz.user_id === this.userId)){
                this.unfavouriteQuiz(this.quizId)
                .then(() => {
                    this.getQuizzes();
                })
                .catch(error => {
                    console.log(error.response);
                })
            }else{
                this.favouriteQuiz(data)
                .then(() => {
                    this.getQuizzes();
                })
                .catch(error => {
                    console.log(error.response);
                })
            }
        }
    },
    computed:{
        quizFavouriteIcon(){
            return this.quizFavourites.find(quiz => quiz.user_id === this.userId) ? 'ml-2 fas fa-heart-broken text-red-600 cursor-pointer' : 'ml-2 fas fa-heart text-red-600 cursor-pointer';
        }
    }
}
</script>