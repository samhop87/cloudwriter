<template>
    <Head/>
    <div ref="titleTop">
        <div
            class="flex flex-col justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <div v-if="canLogin" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                <Link v-if="$page.props.auth.user.id" :href="route('dashboard')" class="text-sm text-gray-700 underline">
                    Dashboard
                </Link>

                <template v-else>
                    <Link :href="route('login')"
                          class="font-display text-sm text-white font-bold p-3 rounded-sm bg-turquoise hover:bg-deepgreen border-gray-100 border">
                        Log in
                    </Link>

                    <Link v-if="canRegister"
                          :href="route('register')"
                          class="font-display ml-4 text-sm p-3 font-bold text-white bg-linkedIn hover:bg-neonblue border-gray-100 border">
                        Register
                    </Link>
                </template>
            </div>

            <div class="flex flex-col justify-center p-3 lg:p-0">
                <Link :href="route('home')" class="cursor-pointer">
                <div class="font-display sm:text-display text-mobile-display text-xl mb-4 text-center">
                    CloudWriter
                </div>
                <div>
                    <p class="font-display text-sm mt-4 sm:mt-2 text-center sm:text-right">
                        A manuscript writing and management tool
                    </p>
                </div>
                </Link>
                <div class="flex flex-row justify-around mt-24">
                    <Link v-for="link in links" :href="link.route" class="cursor-pointer">
                        {{ link.label }}
                    </Link>
                </div>
            </div>
        </div>
        <div id="slot" ref="slot">
            <slot></slot>
        </div>
        <div v-if="displayScrollUp && displayScrollButton" @click="frontScroll($refs.titleTop)"
             class="rounded-md fixed p-2 bg-cleomagenta text-white bottom-0 right-0 opacity-50 cursor-pointer">
            Back to top
        </div>
    </div>
</template>

<script>
import {Head, Link} from '@inertiajs/inertia-vue3';
import frontScroll from "@/Mixins/frontScroll";

export default {
    mixins: [frontScroll],
    components: {
        Head,
        Link,
    },
    props: {
        canRegister: Boolean,
        canLogin: Boolean,
        displayScrollUp: Boolean,
        laravelVersion: String,
        phpVersion: String,
    },
    created() {
        window.addEventListener('scroll', this.handleScroll);
    },
    data() {
        return {
            displayScrollButton: false,
            height: window.innerHeight,
            links: [
                {
                    label: 'How It Works',
                    route: route('details')
                },
                {
                    label: 'Pricing',
                    route: route('pricing')
                },
                {
                    label: 'Contact',
                    route: route('contact')
                }
            ]
        }
    },
    methods: {
        handleScroll() {
            this.displayScrollButton = window.pageYOffset >= this.height;
        }
    }
}
</script>
