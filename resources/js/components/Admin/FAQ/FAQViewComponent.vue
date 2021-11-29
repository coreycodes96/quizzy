<template>
    <div class="relative w-full">
        <!-- Create FAQ -->
        <CreateFAQ />

        <!-- No FAQs -->
        <template v-if="fetchFAQs.length === 0">
            <h3 class="mt-10 text-3xl text-center text-white">No FAQs</h3>
        </template>

        <!-- Display FAQs -->
        <div v-for="(faq, faqIndex) in fetchFAQs" :key="faq.id">
            <div class="my-10 mx-auto p-5 w-4/5 h-auto bg-white text-gray-800 rounded">
                <h3 class="mb-5 text-xl">Question: {{faq.question}}</h3>
                <p>Answer: {{faq.answer}}</p>
                <button class="mt-5 p-2 bg-red-500 text-white rounded" @click="deleteAFAQ(faq.id, faqIndex)">Delete</button>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions, mapGetters} from 'vuex';
import CreateFAQ from './CreateFAQ/CreateFAQComponent.vue';
export default {
    components:{CreateFAQ},
    methods:{
        ...mapActions('admin', ['getFAQs', 'deleteFAQ']),
        deleteAFAQ(id, index){
            const data = {
                id,
                'faq_index': index,
            };

            this.deleteFAQ(data)
            .then(() => {
                this.getFAQs();
            })
            .catch(error => {
                console.log(error.response);
            })
        }
    },
    computed:{
        ...mapGetters('admin', ['fetchFAQs']),
    },
    created(){
        this.getFAQs();
    }
}
</script>