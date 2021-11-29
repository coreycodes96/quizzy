<template>
    <div class="relative w-full">
        <!-- Create Announcement -->
        <CreateAnnouncement />


        <!-- No Announcements -->
        <template v-if="fetchAnnouncements.length === 0">
            <h3 class="mt-10 text-3xl text-center text-white">No Announcements</h3>
        </template>

        <!-- Display Announcements -->
        <div v-for="(announcement, announcementIndex) in fetchAnnouncements" :key="announcement.id">
            <div class="my-10 mx-auto p-5 w-4/5 h-auto bg-white text-gray-800 rounded">
                <h3 class="mb-5 text-xl">Title: {{announcement.title}}</h3>
                <p>Body: {{announcement.body}}</p>
                <button class="mt-5 p-2 bg-red-500 text-white rounded" @click="deleteAnAnnouncement(announcement.id, announcementIndex)">Delete</button>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions, mapGetters} from 'vuex';
import CreateAnnouncement from './CreateAnnouncement/CreateAnnouncementComponent.vue';
export default {
    components:{CreateAnnouncement},
    methods:{
        ...mapActions('admin', ['getAnnouncements', 'deleteAnnouncement']),
        deleteAnAnnouncement(id, index){
            const data = {
                id,
                'announcement_index': index,
            };

            this.deleteAnnouncement(data)
            .then(() => {
                this.getAnnouncements();
            })
            .catch(error => {
                console.log(error.response);
            })
        }
    },
    computed:{
        ...mapGetters('admin', ['fetchAnnouncements']),
    },
    created(){
        this.getAnnouncements();
    }
}
</script>