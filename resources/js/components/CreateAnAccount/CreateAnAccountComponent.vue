<template>
    <div class="select-none">
        <!-- Title -->
        <div class="mt-20 px-10 w-full text-3xl">
            <h1>Create An Account!</h1>
        </div>

        <!-- Create An Account Form -->
        <div class="relative mt-20 mx-auto w-4/5 h-96 bg-gray-900 rounded">
            <!-- Form Container -->
            <template v-if="accountCreated === false">
                <div class="w-full h-96 flex justify-center items-center flex-col">
                    <!-- Input -->
                    <input v-if="form[slide].title !== 'dob' && form[slide].title !== 'gender'" class="pl-3 w-4/5 h-12" :type="form[slide].type" :placeholder="form[slide].title" v-model.trim="form[slide].model"/>
                    
                    <!-- Date Of Birth -->
                    <input v-if="form[slide].title === 'dob'" class="pl-3 w-4/5 h-12" type="date" min="1920-01-01" max="2005-01-01" :placeholder="form[slide].title" v-model.trim="form[slide].model"/>
                    
                    <!-- Gender -->
                    <select v-if="form[slide].title === 'gender'" class="pl-3 w-4/5 h-12" v-model.trim="form[slide].model">
                        <option value="">Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>

                    <!-- Error Message -->
                    <p class="mt-2 w-4/5 text-left text-red-800" v-if="form[slide].error"><i class="fas fa-exclamation-circle"></i> {{form[slide].error}}</p>
                </div>

                <!-- Bottom Buttons -->
                <div class="w-full h-12 absolute bottom-0 left-0 flex justify-around items-center text-white">
                    <template v-if="formComplete === false">
                        <!-- Previous Input -->
                        <button v-if="slide !== 0" @click="createAnAccountLeftButton">
                            <i class="fas fa-arrow-left"></i>
                        </button>

                        <!-- Next Input -->
                        <button @click="createAnAccountRightButton">
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </template>

                    <template v-else>
                        <!-- Create An Account Button -->
                        <button v-if="formComplete === true" @click="createAnAccount">
                            Create An Account
                        </button>
                    </template>
                </div>
            </template>

            <!-- Created Account Message -->
            <template v-else>
                <div class="w-full h-96 flex justify-center items-center flex-col text-white text-center">
                    <p class="text-2xl">Congratulations your account has been created!</p>
                    <a class="mt-12 p-2 bg-white text-gray-800 rounded" href="http://192.168.1.114:8000/login">Login Now</a>
                </div>
            </template>
        </div>
    </div>
</template>

<script>
import {mapActions} from 'vuex';
export default {
    data(){
        return{
            form:[
                {
                    title: "firstname",
                    model: "",
                    type: "text",
                    error: ""
                },
                {
                    title: "surname",
                    model: "",
                    type: "text",
                    error: ""
                },
                {
                    title: "username",
                    model: "",
                    type: "text",
                    error: ""
                },
                {
                    title: "email",
                    model: "",
                    type: "text",
                    error: ""
                },
                {
                    title: "dob",
                    model: "",
                    type: "text",
                    error: ""
                },
                {
                    title: "gender",
                    model: "",
                    type: "text",
                    error: ""
                },
                {
                    title: "password",
                    model: "",
                    type: "password",
                    error: ""
                }
            ],
            slide: 0,
            trackSlide: 0,
            formComplete: false,
            accountCreated: false
        }
    },
    methods:{
        ...mapActions('account', ['createAccount']),
        createAnAccountLeftButton(){
            this.slide--;
        },
        async createAnAccountRightButton(){
            this.trackSlide++;

            //Firstname input
            if(this.slide === 0){
                if(this.trackSlide === 1){
                    if(this.firstnameInput(this.form[this.slide]) === true){
                        this.slide++;
                        this.trackSlide = 0;
                    }else{
                        this.firstnameInput(this.form[this.slide]);
                        this.trackSlide = 0;
                    }
                }
            }

            //Surname input
            if(this.slide === 1){
                if(this.trackSlide === 1){
                    if(this.surnameInput(this.form[this.slide]) === true){
                        this.slide++;
                        this.trackSlide = 0;
                    }else{
                        this.surnameInput(this.form[this.slide]);
                        this.trackSlide = 0;
                    }
                }
            }

            //Username input
            if(this.slide === 2){
                if(this.trackSlide === 1){
                    if(await this.usernameInput(this.form[this.slide]) === true){
                        this.slide++;
                        this.trackSlide = 0;
                    }else{
                        await this.usernameInput(this.form[this.slide]);
                        this.trackSlide = 0;
                    }
                }
            }

            //Email input
            if(this.slide === 3){
                if(this.trackSlide === 1){
                    if(await this.emailInput(this.form[this.slide]) === true){
                        this.slide++;
                        this.trackSlide = 0;
                    }else{
                        await this.emailInput(this.form[this.slide]);
                        this.trackSlide = 0;
                    }
                }
            }

            //DOB input
            if(this.slide === 4){
                if(this.trackSlide === 1){
                    if(this.dobInput(this.form[this.slide]) === true){
                        this.slide++;
                        this.trackSlide = 0;
                    }else{
                        this.dobInput(this.form[this.slide]);
                        this.trackSlide = 0;
                    }
                }
            }

            //Gender input
            if(this.slide === 5){
                if(this.trackSlide === 1){
                    if(this.genderInput(this.form[this.slide]) === true){
                        this.slide++;
                        this.trackSlide = 0;
                    }else{
                        this.genderInput(this.form[this.slide]);
                        this.trackSlide = 0;
                    }
                }
            }

            //Password input
            if(this.slide === 6){
                if(this.trackSlide === 1){
                    if(this.passwordInput(this.form[this.slide]) === true){
                        this.trackSlide = 0;
                        this.formComplete = true;
                    }else{
                        this.passwordInput(this.form[this.slide]);
                        this.trackSlide = 0;
                    }
                }
            }
        },
        firstnameInput(form){
            if(form.model === ''){
                form.error = 'Please enter your firstname.';
                return false;
            }else if(form.model.length > 25){
                form.error = 'Your firstname can\'t be more than 25 characters.';
                return false;
            }else{
                form.error = '';
                return true;
            }
        },
        surnameInput(form){
            if(form.model === ''){
                form.error = 'Please enter your surname.';
                return false;
            }else if(form.model.length > 25){
                form.error = 'Your surname can\'t be more than 25 characters.';
                return false;
            }else{
                form.error = '';
                return true;
            }
        },
        async usernameInput(form){
            if(form.model === ''){
                form.error = 'Please enter your username.';
                return false;
            }else if(form.model.length > 25){
                form.error = 'Your username can\'t be more than 25 characters.';
                return false;
            }else if(await this.checkIfUsernameExists(form.model) === 1){
                form.error = `Sorry the username (${form.model}) has already been taken.`;
                return false;
            }else{
                form.error = '';
                return true;
            }
        },
        async checkIfUsernameExists(username){
            const checkUsername = await axios.get(`http://192.168.1.114:8000/check/username/${username}`);
            return checkUsername.data;
        },
        async emailInput(form){
            const validEmailOnly = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            
            if(form.model === ''){
                form.error = 'Please enter your email.';
                return false;
            }else if(form.model.length > 255){
                form.error = 'Your email can\'t be more than 255 characters.';
                return false;
            }else if(await this.checkIfUsernameExists(form.model) === 1){
                form.error = `Sorry the email (${form.model}) has already been taken.`;
                return false;
            }else if(form.model.split("@")[0].length >= 64){
                form.error = `Sorry the email (${form.model}) is invalid.`;
                return false;
            }else if(!validEmailOnly.test(form.model)){
                form.error = `Sorry the email (${form.model}) is invalid.`;
                return false; 
            }else{
                form.error = '';
                return true;
            }
        },
        async checkIfEmailExists(email){
            const checkEmail = await axios.get(`http://192.168.1.114:8000/check/email/${email}`);
            return checkEmail.data;
        },
        dobInput(form){
            if(form.model === ''){
                form.error = 'Please enter your date of birth.';
                return false;
            }else{
                form.error = '';
                return true;
            }
        },
        genderInput(form){
            if(form.model === ''){
                form.error = 'Please enter your gender.';
                return false;
            }else{
                form.error = '';
                return true;
            }
        },
        passwordInput(form){
            if(form.model === ''){
                form.error = 'Please enter your password.';
                return false;
            }else if(form.model.length < 8){
                form.error = 'Your password can\'t be less than 8 characters.';
                return false;
            }else if(form.model.length > 255){
                form.error = 'Your password can\'t be more than 255 characters.';
                return false;
            }else if(form.model.toLowerCase().indexOf(this.form[0].model.toLowerCase()) > -1 || form.model.toLowerCase().indexOf(this.form[1].model.toLowerCase()) > -1 || form.model.toLowerCase().indexOf(this.form[2].model.toLowerCase()) > -1){
                form.error = 'Your password can\'t contain your firstname, surname or username.';
                return false;
            }else{
                form.error = '';
                return true;
            }
        },
        createAnAccount(){
            //data
            const data = {
                'firstname': this.form[0].model,
                'surname': this.form[1].model,
                'username': this.form[2].model,
                'email': this.form[3].model,
                'dob': this.form[4].model,
                'gender': this.form[5].model,
                'password': this.form[6].model
            };

            //Creating an account
            this.createAccount(data)
            .then(res => {
                this.accountCreated = true;
            })
            .catch(error => {
                console.log(error.response);
            })
        }
    }
}
</script>