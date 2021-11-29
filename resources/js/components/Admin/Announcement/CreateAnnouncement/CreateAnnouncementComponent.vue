<template>
    <div class="text-center">
        <!-- Create Announcement Button -->
        <button class="mx-auto p-3 w-4/5 bg-white text-gray-800 rounded" @click="openAnnouncementModal">Create Announcement</button>

        <!-- Create Announcement Modal -->
        <div ref="createAnnouncementModal" class="ml-min-100 p-4 fixed top-0 left-0 w-full h-screen hidden justify-center items-center flex-col bg-white z-20"> 
            <!-- Close Announcement Modal -->
            <div class="absolute top-5 right-5">
                <i @click="closeAnnouncementModal" class="fas fa-times cursor-pointer text-2xl"></i>
            </div>

            <!-- Create Announcement Modal -->
            <div class="p-5 w-4/5 h-600 flex justify-center items-center flex-col bg-gray-800 rounded">
                <!-- Title -->
                <div class="w-full text-center">
                    <input class="pl-3 w-4/5 h-12" type="text" placeholder="Title.." v-model="title"/>
                    <p class="mt-2 mx-auto w-4/5 text-left text-red-800" v-if="errors.title"><i class="fas fa-exclamation-circle"></i> {{errors.title}}</p>
                </div>

                <!-- Body -->
                <div class="mt-10 w-full text-center">
                    <input class="pl-3 w-4/5 h-12" type="text" placeholder="Body.." v-model="body"/>
                    <p class="mt-2 mx-auto w-4/5 text-left text-red-800" v-if="errors.body"><i class="fas fa-exclamation-circle"></i> {{errors.body}}</p>
                </div>

                <div class="mt-10 mx-auto w-4/5">
                    <button class="p-3 w-48 bg-white text-gray-800 rounded" @click="createAnAnnouncement">Create Announcement</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions} from 'vuex';
export default {
    data(){
        return{
            title: '',
            body: '',
            errors:{
                title: '',
                body: '',
            }
        }
    },
    methods:{
        ...mapActions('admin', ['getAnnouncements', 'createAnnouncement', 'deleteAnnouncement']),
        openAnnouncementModal(){
            tl.to(this.$refs.createAnnouncementModal, {marginLeft: '0', display: 'flex', duration: 0.3, ease: "power3.out"});
        },
        closeAnnouncementModal(){
            tl.to(this.$refs.createAnnouncementModal, {marginLeft: '-100%', display: 'hidden', duration: 0.3, ease: "power3.out"});
        },
        createAnAnnouncement(){
            //Title validation
            if(this.titleValidation(this.title) === false){
                this.titleValidation(this.title);
            }

            //Body validation
            if(this.bodyValidation(this.body) === false){
                this.bodyValidation(this.body);
            }

            //If validation passes
            if(this.titleValidation(this.title) === true && this.bodyValidation(this.body) === true){
                const data = {
                    'title': this.title,
                    'body': this.body,
                };

                this.createAnnouncement(data)
                .then(() => {
                    this.getAnnouncements();
                })
                .catch(error => {
                    console.log(error.response);
                })
            }
        },
        titleValidation(title){
            if(title === ""){
                this.errors.title = 'Please enter a title';
                return false;
            }else if(title.length > 140){
                this.errors.title = 'Your title can\'t be more than 140 characters.';
                return false;
            }else{
                this.errors.title = '';
                return true;
            }
        },
        bodyValidation(body){
            if(body === ""){
                this.errors.body = 'Please enter a body';
                return false;
            }else if(body.length > 700){
                this.errors.body = 'Your body can\'t be more than 700 characters.';
                return false;
            }else{
                this.errors.body = '';
                return true;
            }
        }
    }
}
</script>