<template>
    <div>
        <div v-for="user in fetchProfileInfo" :key="user.id">
            <!-- Title -->
            <div class="mt-20 ml-20">
                <h3 class="text-2xl">Welcome To {{profileUsername}}'s Profile</h3>
                <Supporter :auth-id="authId" :profile-id="profileId" :profile-username="profileUsername" :user-supporters="user.supporters"/>
            </div>

            <!-- Sections -->
            <div class="mt-20 mx-auto p-5 w-4/5 h-96 flex justify-center items-center bg-gray-800 rounded overflow-y-scroll">
                <!-- Quizzes -->
                <template v-if="selected === 0">
                    <UserQuizzes :user-quizzes="user.quizzes"/>
                </template>

                <!-- Settings -->
                <template v-if="selected === 1">
                    <UserSettings :auth-firstname="authFirstname" :auth-surname="authSurname" :profile-username="profileUsername"/>
                </template>
            </div>

            <!-- Buttons -->
            <div class="mx-auto p-5 w-4/5 h-24 flex justify-between items-center">
                <button @click="selected = 0">Quizzes</button>
                <button v-if="authUsername === profileUsername" @click="selected = 1">Settings</button>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions, mapGetters} from 'vuex';
import UserQuizzes from './UserQuizzes/UserQuizzesComponent.vue';
import Supporter from './Supporter/SupporterComponent.vue';
import UserSettings from './UserSettings/UserSettingsViewComponent.vue';
export default {
    props:{
        authId:{
            type: Number,
            required: true,
        },
        authUsername:{
            type: String,
            required: true,
        },
        authFirstname:{
            type: String,
            required: true,
        },
        authSurname:{
            type: String,
            required: true,
        },
        profileId:{
            type: Number,
            required: true,
        },
        profileUsername:{
            type: String,
            required: true,
        }
    },
    components:{UserQuizzes, Supporter, UserSettings},
    data(){
        return{
            selected: 0
        }
    },
    methods:{
        ...mapActions('profile', ['getProfileInfo']),
    },
    computed:{
        ...mapGetters('profile', ['fetchProfileInfo']),
    },
    created(){
        this.getProfileInfo(this.profileUsername);
    }
}
</script>