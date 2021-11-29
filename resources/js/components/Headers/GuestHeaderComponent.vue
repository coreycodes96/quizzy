<template>
    <div>
        <!-- Header -->
        <div class="absolute top-0 left-0 w-full h-12 flex justify-end items-center z-10">
            <!-- Open Button -->
            <i @click="openGuestHeader" class="mt-5 mr-10 p-2 text-2xl bg-gray-900 text-white rounded-full cursor-pointer fas fa-bars"></i>
        </div>

        <!-- Modal -->
        <div ref="guestHeaderModal" class="p-5 fixed top-0 left-0 sm:w-1/4 w-full h-screen bg-gray-900 hidden z-20">
            <!-- Close Button -->
            <div class="absolute top-5 right-5 text-white">
                <i @click="closeGuestHeader" class="fas fa-times text-2xl text-white cursor-pointer"></i>
            </div>

            <!-- List -->
            <div class="mt-40 w-full h-96 flex justify-center items-center flex-col">
                <li class="mt-10 p-3 bg-white w-full text-center list-none rounded">
                    <a href="http://192.168.1.114:8000/">Home</a>
                </li>
                <li class="mt-10 p-3 bg-white w-full text-center list-none rounded">
                    <a href="http://192.168.1.114:8000/register">Create An Account</a>
                </li>
                <li class="mt-10 p-3 bg-white w-full text-center list-none rounded">
                    <a href="http://192.168.1.114:8000/login">Login</a>
                </li>
                <li class="mt-10 p-3 bg-white w-full text-center list-none rounded">
                    <a href="http://192.168.1.114:8000/faq">FAQ</a>
                </li>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    methods:{
        //Open Header
        openGuestHeader(){
            tl.to(this.$refs.guestHeaderModal, {display: 'flex', marginLeft: '0', duration: 0.5, ease: "power3.out"});
        },
        //Close Header
        closeGuestHeader(){
            tl.to(this.$refs.guestHeaderModal, {display: 'none', marginLeft: '-100%', duration: 0.5, ease: "power3.out"});
        }
    }
}
</script>