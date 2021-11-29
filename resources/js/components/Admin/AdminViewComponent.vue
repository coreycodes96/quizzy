<template>
    <div class="select-none">
        <!-- Sections -->
        <div class="mt-24 mx-auto p-5 w-4/5 h-550 flex justify-center items-center bg-gray-800 rounded overflow-y-scroll">
            <!-- Welcome -->
            <template v-if="selected === 0">
                <div class="mt-18 w-full h-auto">
                    <h3 class="text-4xl text-center text-white">Welcome To The Admin Centre</h3>
                </div>
            </template>

            <!-- Update User Warning -->
            <template v-if="selected === 1">
                <UserWarningView />
            </template>

            <!-- Delete User -->
            <template v-if="selected === 2">
                <DeleteUserView />
            </template>

            <!-- FAQ -->
            <template v-if="selected === 3">
                <FAQView />
            </template>

            <!-- Announcement -->
            <template v-if="selected === 4">
                <AnnouncementView />
            </template>
        </div>

        <!-- Buttons -->
        <div class="mx-auto p-5 w-4/5 h-24 flex justify-between items-center">
            <button @click="selected = 0">Home</button>
            <button @click="selected = 1">Update User Warning</button>
            <button @click="selected = 2">Delete User</button>
            <button @click="selected = 3">FAQ</button>
            <button @click="selected = 4">Announcements</button>
        </div>
    </div>
</template>

<script>
import UserWarningView from './UserWarning/UserWarningViewComponent.vue';
import DeleteUserView from './DeleteUser/DeleteUserViewComponent.vue';
import FAQView from './FAQ/FAQViewComponent.vue';
import AnnouncementView from './Announcement/AnnouncementViewComponent.vue';
export default {
    components:{UserWarningView, DeleteUserView, FAQView, AnnouncementView},
    data(){
        return{
            selected: 0
        }
    }
}
</script>