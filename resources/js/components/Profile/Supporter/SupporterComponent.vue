<template>
    <span>
        <button v-if="authId !== profileId" class="mt-5 p-2 bg-gray-800 text-white rounded" @click="supportOrUnsupportUser">{{isSupported}}</button>
    </span>
</template>

<script>
import {mapActions} from 'vuex';
export default {
    props:{
        authId:{
            type: Number,
            required: true,
        },
        profileId:{
            type: Number,
            required: true,
        },
        profileUsername:{
            type: String,
            required: true,
        },
        userSupporters:{
            type: Array,
            required: true,
        }
    },
    methods:{
        ...mapActions('profile', ['getProfileInfo', 'support', 'unsupport']),
        supportOrUnsupportUser(){
            if(this.userSupporters.find(s => s.sender === this.authId)){
                //Unsupport
                this.unsupport(this.profileId)
                .then(() => {
                    this.getProfileInfo(this.profileUsername);
                })
                .catch(error => {
                    console.log(error.response);
                })
            }else{
                //Support
                const data = {
                    'sender': this.authId,
                    'receiver': this.profileId
                };

                this.support(data)
                .then(() => {
                    this.getProfileInfo(this.profileUsername);
                })
                .catch(error => {
                    console.log(error.response);
                })
            }
        }
    },
    computed:{
        isSupported(){
            return this.userSupporters.find(s => s.sender === this.authId) ? 'Unsupport' : 'Support';
        }
    }
}
</script>