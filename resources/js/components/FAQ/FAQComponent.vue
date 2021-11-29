<template>
    <div class="select-none">
        <!-- Title -->
        <div class="mt-20 px-10 w-full text-3xl">
            <h1>FAQS (Frequently Asked Questions)</h1>
        </div>

        <!-- No FAQS -->
        <template v-if="fetchFAQs.length === 0">
            <div>
                SORRY NO FAQS
            </div>
        </template>

        <!-- Display FAQS -->
        <div class="mt-10">
            <template v-if="fetchFAQs.length > 0">
                <div v-for="faq in fetchFAQs" :key="faq.id">
                    <div class="my-20 mx-auto p-4 w-4/5 h-auto bg-gray-800 text-white rounded">
                        <div class="w-full h-auto flex justify-between items-center">
                            <h2>{{faq.question}}</h2>
                            <i v-if="selected === 0" @click="selected = faq.id" class="fas fa-arrow-circle-up cursor-pointer text-xl"></i>
                            <i v-if="selected === faq.id" @click="selected = 0" class="fas fa-arrow-circle-down cursor-pointer text-xl"></i>
                        </div>
                        <p v-if="selected === faq.id" class="mt-5 whitespace-pre-line text-sm">{{faq.answer}}</p>
                        <p class="mt-5 text-sm">{{timeSince(faq.created_at)}} ago</p>
                    </div>
                </div>
            </template>
        </div>
    </div>
</template>

<script>
import {mapActions, mapGetters} from 'vuex';
import formatDistance from 'date-fns/formatDistance';
export default {
    data(){
        return{
            selected: 0
        }
    },
    methods:{
        ...mapActions('account', ['getFAQs']),
        timeSince(date) {
            return formatDistance(new Date(), new Date(date));
        }
    },
    computed:{
        ...mapGetters('account', ['fetchFAQs']),
    },
    created(){
        this.getFAQs()
    }
}
</script>