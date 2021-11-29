<template>
    <div class="w-full text-center">
        <!-- Change Username -->
        <ChangeUsername :profile-username="profileUsername"/>

        <!-- Change Password -->
        <ChangePassword :auth-firstname="authFirstname" :auth-surname="authSurname" :profile-username="profileUsername"/>
    </div>
</template>

<script>
import ChangeUsername from './ChangeUsername/ChangeUsernameComponent.vue';
import ChangePassword from './ChangePassword/ChangePasswordComponent.vue';
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
    components:{ChangeUsername, ChangePassword},
}
</script>