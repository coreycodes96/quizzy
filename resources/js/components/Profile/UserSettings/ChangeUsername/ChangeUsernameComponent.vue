<template>
    <div>
        <!-- Change Username Button -->
        <button @click="openChangeUsernameModal" class="mb-5 mx-auto p-3 w-3/5 bg-white text-gray-800 rounded">Change Username?</button>

        <!-- Change Username Modal -->
        <div ref="changeUsernameModal" class="ml-min-100 p-4 fixed top-0 left-0 w-full h-screen hidden justify-center items-center flex-col bg-white z-20">
            <!-- Close Button -->
            <div class="absolute top-5 right-5">
                <i @click="closeChangeUsernameModal" class="fas fa-times cursor-pointer text-2xl"></i>
            </div>

            <!-- Title -->
            <h1 class="mb-10 text-2xl w-4/5 text-left">Change Your Username!</h1>

            <!-- Model Box -->
            <div class="p-5 w-4/5 h-550 flex justify-center items-center flex-col bg-gray-800 rounded">
                <!-- New Username -->
                <div class="w-full text-center">
                    <input class="pl-3 w-4/5 h-12" type="text" placeholder="New Username" v-model="new_username"/>
                    <p class="mt-2 mx-auto w-4/5 text-left text-red-800" v-if="errors.new_username"><i class="fas fa-exclamation-circle"></i> {{errors.new_username}}</p>
                </div>

                <!-- Change Username Button -->
                <div class="mt-10 mx-auto w-4/5">
                    <button class="p-3 bg-white text-gray-800 rounded" @click="changeUsersUsername">Change Username</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions} from 'vuex';
export default {
    props:{
        profileUsername:{
            type: String,
            required: true,
        },
    },
    data(){
        return{
            new_username: '',
            errors:{
                new_username: '',
            }
        }
    },
    methods:{
        ...mapActions('profile', ['changeUsername']),
        openChangeUsernameModal(){
            tl.to(this.$refs.changeUsernameModal, {marginLeft: '0', display: 'flex', duration: 0.3, ease: "power3.out"});
        },
        closeChangeUsernameModal(){
            tl.to(this.$refs.changeUsernameModal, {marginLeft: '-100%', display: 'hidden', duration: 0.3, ease: "power3.out"});
        },
        async changeUsersUsername(){
            //Username Validation
            if(await this.newUsernameValidation(this.new_username) === false){
                await this.newUsernameValidation(this.new_username);
            }

            //Change Username
            const data = {
                'username': this.profileUsername,
                'new_username': this.new_username
            };

            this.changeUsername(data)
            .then(() => {
                location.replace('http://192.168.1.114:8000/');
            })
            .catch(error => {
                console.log(error.response);
            })
        },
        async newUsernameValidation(username){
            if(username === ""){
                this.errors.new_username = 'Please enter your new username.';
                return false;
            }else if(username.length > 25){
                this.errors.new_username = 'Your new username can\'t be more than 25 characters.';
                return false;
            }else if(await this.checkIfUsernameExists(this.new_username) === 1){
                this.errors.new_username = `Sorry the username (${this.new_username}) has already been taken.`;
                return false;
            }else{
                this.errors.new_username = '';
                return true;
            }
        },
        async checkIfUsernameExists(username){
            const checkUsername = await axios.get(`http://192.168.1.114:8000/profile/check/usernameExists/${username}`);
            return checkUsername.data;
        },
    }
}
</script>