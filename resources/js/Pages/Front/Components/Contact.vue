<template>
    <div ref="top">
        <div class="w-full bg-turquoise flex flex-col justify-center items-center">
            <div class="py-8 mt-4">
                <h1 class="sm:text-4xl text-mobile-display text-xl">Get in touch</h1>
                <p class="my-4">If <a :href="route('home')">our FAQ</a> can't help you, get in touch with any questions.
                </p>
            </div>
            <div class="w-5/6 md:w-3/4 lg:w-1/2 rounded-md bg-white p-8 mb-16">
                <div>
                    <label class="block mb-6">
                        <span class="text-gray-700">Your name</span>
                        <span class="ml-3 text-xs text-red-400" v-if="validation.includes('name')">
                            Please fill out your name
                        </span>
                        <input
                            type="text"
                            v-model="form.name"
                            :class="validation.includes('name') ? 'border-red-200 border-4' : 'border-gray-300'"
                            class="flex w-full mt-1 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            placeholder="Joe Bloggs"
                        />
                    </label>
                    <label class="block mb-6">
                        <span class="text-gray-700">Email address</span>
                        <span class="ml-3 text-xs text-red-400" v-if="validation.includes('email')">
                            Please give a valid email address.
                        </span>
                        <input
                            v-model="form.email"
                            type="email"
                            :class="validation.includes('email') ? 'border-red-200 border-4' : 'border-gray-300'"
                            class="flex w-full mt-1 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            placeholder="joe.bloggs@example.com"
                            required
                        />
                    </label>
                    <label class="block mb-6">
                        <span class="text-gray-700">Message</span>
                        <span class="ml-3 text-xs text-red-400" v-if="validation.includes('message')">
                            Please write a query or message
                        </span>
                        <textarea
                            v-model="form.message"
                            :class="validation.includes('name') ? 'border-red-200 border-4' : 'border-gray-300'"
                            class="flex w-full mt-1 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            rows="3"
                            placeholder="Type your question here"
                        ></textarea>
                    </label>
                    <div v-if="!sent" class="mb-6">
                        <button
                            @click="submit"
                            class="h-10 px-5 text-indigo-100 bg-indigo-700 rounded-lg transition-colors duration-150 focus:shadow-outline hover:bg-indigo-800"
                        >
                            Submit
                        </button>
                    </div>
                    <div v-if="sent">
                        <p>
                            Your message was sent!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Layout from '@/Pages/Front/Home.vue'
import frontScroll from "@/Mixins/frontScroll";
import invalid from "@/Mixins/invalid";

export default {
    mixins: [frontScroll, invalid],
    layout: Layout,
    props: {
        user: Object,
    },
    data() {
        return {
            form: {
                name: null,
                email: null,
                message: null
            },
            sending: false,
            sent: false,
            validation: []
        }
    },
    mounted() {
        this.frontScroll(this.$refs.top)
    },
    methods: {
        submit() {
            this.sending = true
            axios.post('/api/send-email', this.form).then(({ data }) => {
                this.sending = false
                this.sent = true
                this.form.name = null
                this.form.email = null
                this.form.message = null
            }).catch((e) => {
                this.validation = this.invalid(e.response.data.errors)
                this.sending = false
                this.sent = false
            })
        },
    }
}
</script>
