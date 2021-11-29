<template>
    <div class="w-full">
        <!-- No Users -->
        <template v-if="fetchUsers.length === 0">
            <h3 class="text-3xl text-center text-white">No Users</h3>
        </template>

        <!-- Display Users -->
        <div v-for="(user, userIndex) in fetchUsers" :key="user.id">
            <div class="my-10 mx-auto p-5 w-4/5 h-auto bg-white text-gray-800 rounded">
                <h3 class="mb-5 text-2xl">{{user.username}}</h3>
                <button class="mt-5 p-2 bg-red-500 text-white rounded" @click="deleteAUser(user.id, userIndex)">Delete</button>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions, mapGetters} from 'vuex';
export default {
    methods:{
        ...mapActions('admin', ['getUsers', 'deleteUser']),
        deleteAUser(id, userIndex){
            const data = {
                id,
                'user_index': userIndex,
            };

            this.deleteUser(data)
            .then(() => {
                this.getUsers();
            })
            .catch(error => {
                console.log(error.response);
            })
        }

    },
    computed:{
        ...mapGetters('admin', ['fetchUsers']),
    },
    created(){
        this.getUsers();
    }
}
</script>