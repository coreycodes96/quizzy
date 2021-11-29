<template>
    <div class="select-none">
        <!-- Title -->
        <div class="mt-20 px-10 w-full text-3xl">
            <h1>Announcements!</h1>
        </div>

        <!-- No Announcements -->
        <template v-if="fetchAnnouncements.length === 0">
            <div class="p-5 w-full h-550 flex justify-center items-center">
                <p class="text-2xl text-gray-800">SORRY NO ANNOUNCEMENTS</p>
            </div>
        </template>

        <!-- Display Announcements -->
        <template v-if="fetchAnnouncements.length > 0">
            <div v-for="announcement in fetchAnnouncements" :key="announcement.id">
                <div class="my-10 mx-auto p-4 w-4/5 h-auto bg-gray-800 rounded text-white">
                    <h3 class="mb-5 text-2xl">{{announcement.title}}</h3>
                    <p class="mb-5 text-base">{{announcement.body}}</p>
                    <p class="text-sm">{{timeSince(announcement.created_at)}} ago</p>
                </div>
            </div>
        </template>
    </div>
</template>

<script>
import {mapActions, mapGetters} from 'vuex';
import formatDistance from 'date-fns/formatDistance';
export default {
    methods:{
        ...mapActions('announcements', ['getAnnouncements']),
        timeSince(date) {
            return formatDistance(new Date(), new Date(date));
        }
    },
    computed:{
        ...mapGetters('announcements', ['fetchAnnouncements']),
    },
    created(){
        this.getAnnouncements()
    }
}
</script>