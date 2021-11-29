<template>
    <div class="select-none">
        <!-- Title -->
        <div class="mt-20 px-10 w-full text-3xl">
            <h1>Login!</h1>
        </div>

        <!-- Login Form -->
        <div class="mt-20 mx-auto w-4/5 h-96 bg-gray-900 rounded">
            <!-- Form Container -->
            <div class="w-full h-96 flex justify-center items-center flex-col">
                <form class="w-full" @submit.prevent="loggingTheUserIn">
                    <!-- Email -->
                    <div class="mb-20 mx-auto w-4/5 h-12">
                        <input class="pl-2 w-full h-12" type="text" placeholder="Email" v-model.trim="email.model"/>
                        <p class="mt-2 w-4/5 text-left text-red-800" v-if="email.error"><i class="fas fa-exclamation-circle"></i> {{email.error}}</p>
                    </div>
                    
                    <!-- Password -->
                    <div class="my-20 mx-auto w-4/5 h-12">
                        <input class="pl-2 w-full h-12" type="password" placeholder="Password" v-model.trim="password.model"/>
                        <p class="mt-2 w-4/5 text-left text-red-800" v-if="password.error"><i class="fas fa-exclamation-circle"></i> {{password.error}}</p>
                    </div>

                    <!-- Login Button -->
                    <div class="mt-10 mx-auto w-4/5 h-12 text-center">
                        <button class="p-3 w-4/5 h-12 bg-white text-gray-800 rounded">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions} from 'vuex';
export default {
    data(){
        return{
            email: {
                model: "",
                error: ""
            },
            password: {
                model: "",
                error: ""
            }
        }
    },
    methods:{
        ...mapActions('account', ['logTheUserIn']),
        async loggingTheUserIn(){
            //Email Check
            if(await this.emailInput(this.email) === false){
                await this.emailInput(this.email);
            }

            //Password Check
            if(this.passwordInput(this.password) === false){
                this.passwordInput(this.password);
            }

            //Log the user in
            if(await this.emailInput(this.email) === true && this.passwordInput(this.password) === true){
                const data = {
                    'email': this.email.model,
                    'password': this.password.model
                };

                this.logTheUserIn(data)
                .then(res => {
                    //Logging In User
                    if(res.data.is_admin === 0){
                        location.replace('http://192.168.1.114:8000/announcements');
                    }

                    //Logging In Admin
                    if(res.data.is_admin === 1){
                        location.replace('http://192.168.1.114:8000/admin');
                    }
                })
                .catch(error => {
                    console.log(error.response);
                })
            }
        },
        async emailInput(email){
            if(email.model === ''){
                email.error = 'Please enter your email';
                return false;
            }else if(await this.checkIfEmailExists(email.model) === 0){
                email.error = `Sorry your email (${email.model}) does not exist`;
                return false;
            }else{
                email.error = '';
                return true;
            }
        },
        async checkIfEmailExists(email){
            const checkEmail = await axios.get(`http://192.168.1.114:8000/check/email/${email}`);
            return checkEmail.data;
        },
        passwordInput(password){
            if(password.model === ''){
                password.error = 'Please enter your password.';
                return false;
            }else{
                password.error = '';
                return true;
            }
        }
    }
}
</script>