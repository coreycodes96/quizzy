<template>
    <div>
        <!-- Change Password Button -->
        <button @click="openChangePasswordModal" class="mb-5 mx-auto p-3 w-3/5 bg-white text-gray-800 rounded">Change Password?</button>

        <!-- Change Password Modal -->
        <div ref="changePasswordModal" class="ml-min-100 p-4 fixed top-0 left-0 w-full h-screen hidden justify-center items-center flex-col bg-white z-20">
            <!-- Close Button -->
            <div class="absolute top-5 right-5">
                <i @click="closeChangePasswordModal" class="fas fa-times cursor-pointer text-2xl"></i>
            </div>

            <!-- Title -->
            <h1 class="mb-10 text-2xl w-4/5 text-left">Change Your Password!</h1>

            <!-- Model Box -->
            <div class="p-5 w-4/5 h-550 flex justify-center items-center flex-col bg-gray-800 rounded">
                <!-- Current Password -->
                <div class="mb-10 w-full text-center">
                    <input class="pl-3 w-4/5 h-12" type="password" placeholder="Current Password" v-model="current_password"/>
                    <p class="mt-2 mx-auto w-4/5 text-left text-red-800" v-if="errors.current_password"><i class="fas fa-exclamation-circle"></i> {{errors.current_password}}</p>
                </div>

                <!-- New Password -->
                <div class="w-full text-center">
                    <input class="pl-3 w-4/5 h-12" type="password" placeholder="New Password" v-model="new_password"/>
                    <p class="mt-2 mx-auto w-4/5 text-left text-red-800" v-if="errors.new_password"><i class="fas fa-exclamation-circle"></i> {{errors.new_password}}</p>
                </div>

                <!-- Change Username Button -->
                <div class="mt-10 mx-auto w-4/5">
                    <button class="p-3 bg-white text-gray-800 rounded" @click="changeUsersPassword">Change Password</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions} from 'vuex';
export default {
    props:{
        authFirstname:{
            type: String,
            required: true,
        },
        authSurname:{
            type: String,
            required: true,
        },
        profileUsername:{
            type: String,
            required: true,
        },
    },
    data(){
        return{
            current_password: '',
            new_password: '',
            errors:{
                current_password: '',
                new_password: '',
            }
        }
    },
    methods:{
        ...mapActions('profile', ['changePassword']),
        openChangePasswordModal(){
            tl.to(this.$refs.changePasswordModal, {marginLeft: '0', display: 'flex', duration: 0.3, ease: "power3.out"});
        },
        closeChangePasswordModal(){
            tl.to(this.$refs.changePasswordModal, {marginLeft: '-100%', display: 'hidden', duration: 0.3, ease: "power3.out"});
        },
        changeUsersPassword(){
            //Current Password Validation
            if(this.currentPasswordValidation(this.current_password) === false){
                this.currentPasswordValidation(this.current_password);
            }

            //New Password Validation
            if(this.newPasswordValidation(this.new_password) === false){
                this.newPasswordValidation(this.new_password);
            }

            if(this.currentPasswordValidation(this.current_password) === true && this.newPasswordValidation(this.new_password) === true){
                //Change Password
                const data = {
                    'current_password': this.current_password,
                    'new_password': this.new_password,
                };

                this.changePassword(data)
                .then(() => {
                    location.replace('http://192.168.1.114:8000/');
                })
                .catch(error => {
                    console.log(error.response);
                })
            }
        },
        currentPasswordValidation(current_password){
            if(current_password === ""){
                this.errors.current_password = 'Please enter your current password';
                return false;
            }else{
                this.errors.current_password = '';
                return true;
            }
        },
        newPasswordValidation(password){
            if(password === ""){
                this.errors.new_password = 'Please enter your new password';
                return false;
            }else if(password.length < 8){
                this.errors.new_password = 'Your new password can\'t be less than 8 characters';
                return false;
            }else if(password.length > 255){
                this.errors.new_password = 'Your new password can\'t be more than 255 characters.';
                return false;
            }else if(this.new_password.toLowerCase().indexOf(this.authFirstname.toLowerCase()) > -1 || this.new_password.toLowerCase().indexOf(this.authSurname.toLowerCase()) > -1 || this.new_password.toLowerCase().indexOf(this.profileUsername.toLowerCase()) > -1){
                this.errors.new_password = 'Your password can\'t contain your firstname, surname or username.';
                return false;
            }else{
                this.errors.new_password = '';
                return true;
            }
        }
    }
}
</script>