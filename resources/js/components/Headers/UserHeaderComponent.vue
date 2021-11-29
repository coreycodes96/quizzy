<template>
    <div>
        <!-- Header -->
        <div class="absolute top-0 left-0 w-full h-12 flex justify-end items-center z-10">
            <!-- Open Button -->
            <i @click="openUserHeader" class="mt-5 mr-10 p-2 text-2xl bg-gray-900 text-white rounded-full cursor-pointer fas fa-bars"></i>
        </div>

        <!-- Modal -->
        <div ref="userHeaderModal" class="p-5 fixed top-0 left-0 sm:w-1/4 w-full h-screen bg-gray-900 hidden z-20">
            <!-- Close Button -->
            <div class="absolute top-5 right-5 text-white">
                <i @click="closeUserHeader" class="fas fa-times text-2xl text-white cursor-pointer"></i>
            </div>

            <!-- List -->
            <div class="mt-40 w-full h-96 flex justify-center items-center flex-col">
                <li class="mt-10 p-3 bg-white w-full text-center list-none rounded">
                    <a href="http://192.168.1.114:8000/announcements">Announcements</a>
                </li>
                <li class="mt-10 p-3 bg-white w-full text-center list-none rounded">
                    <a href="http://192.168.1.114:8000/quiz">Quizzies</a>
                </li>
                <li class="mt-10 p-3 bg-white w-full text-center list-none rounded">
                    <a :href="`http://192.168.1.114:8000/profile/${username}`">Profile</a>
                </li>
                <li class="mt-20 p-3 bg-white w-full text-center list-none rounded">
                    <button @click="loggingTheUserOut">Logout</button>
                </li>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions} from 'vuex';
export default {
    props:{
        username: {
            type: String,
            required: true
        },
    },
    methods:{
        ...mapActions('account', ['logTheUserOut']),
        //Open Header
        openUserHeader(){
            tl.to(this.$refs.userHeaderModal, {display: 'flex', marginLeft: '0', duration: 0.5, ease: "power3.out"});
        },
        //Close Header
        closeUserHeader(){
            tl.to(this.$refs.userHeaderModal, {display: 'none', marginLeft: '-100%', duration: 0.5, ease: "power3.out"});
        },
        loggingTheUserOut(){
            this.logTheUserOut()
            .then(() => {
                location.replace('http://192.168.1.114:8000/');
            })
            .catch(error => {
                console.log(error.response);
            })
        }
    }
}
</script>