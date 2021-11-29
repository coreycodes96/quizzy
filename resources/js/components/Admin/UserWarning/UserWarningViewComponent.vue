<template>
    <div class="w-full">
        <!-- No Users -->
        <template v-if="fetchUserWarnings.length === 0">
            <h3 class="text-3xl text-center text-white">No Users</h3>
        </template>

        <!-- Display Users -->
        <div v-for="(user) in fetchUserWarnings" :key="user.id">
            <div class="my-10 mx-auto p-5 w-4/5 h-auto bg-white text-gray-800 rounded">
                <h3 class="mb-5 text-2xl">{{user.username}}</h3>
                <p>Warnings: {{user.warnings}}</p>
                <button class="mt-5 p-2 bg-green-500 text-white rounded" @click="updateAUserWarning(user.id, user.warnings)">Update</button>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions, mapGetters} from 'vuex';
export default {
    methods:{
        ...mapActions('admin', ['getUserWarnings', 'updateUserWarning']),
        updateAUserWarning(id, warnings){
            const data = {
                id,
                warnings
            };
            
            this.updateUserWarning(data)
            .then(() => {
                this.getUserWarnings();
            })
            .catch(error => {
                console.log(error.response);
            })
        }
    },
    computed:{
        ...mapGetters('admin', ['fetchUserWarnings']),
    },
    created(){
        this.getUserWarnings();
    }
}
</script>