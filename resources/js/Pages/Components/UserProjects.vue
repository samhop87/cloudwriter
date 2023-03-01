<template>
    <div class="lg:flex lg:items-center lg:justify-between">
        <div class="min-w-0 flex-1">
            <h3 class="text-lg leading-7 text-gray-900 sm:truncate sm:text-xl sm:tracking-tight">
                {{ project.project_name }}
            </h3>
            <div class="mt-1 flex flex-col sm:mt-0 sm:flex-row sm:flex-wrap sm:space-x-6">
                <div class="mt-2 flex items-center text-sm text-gray-500">
                    <!-- Heroicon name: mini/briefcase -->
                    <svg class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd"
                              d="M6 3.75A2.75 2.75 0 018.75 1h2.5A2.75 2.75 0 0114 3.75v.443c.572.055 1.14.122 1.706.2C17.053 4.582 18 5.75 18 7.07v3.469c0 1.126-.694 2.191-1.83 2.54-1.952.599-4.024.921-6.17.921s-4.219-.322-6.17-.921C2.694 12.73 2 11.665 2 10.539V7.07c0-1.321.947-2.489 2.294-2.676A41.047 41.047 0 016 4.193V3.75zm6.5 0v.325a41.622 41.622 0 00-5 0V3.75c0-.69.56-1.25 1.25-1.25h2.5c.69 0 1.25.56 1.25 1.25zM10 10a1 1 0 00-1 1v.01a1 1 0 001 1h.01a1 1 0 001-1V11a1 1 0 00-1-1H10z"
                              clip-rule="evenodd"/>
                        <path
                            d="M3 15.055v-.684c.126.053.255.1.39.142 2.092.642 4.313.987 6.61.987 2.297 0 4.518-.345 6.61-.987.135-.041.264-.089.39-.142v.684c0 1.347-.985 2.53-2.363 2.686a41.454 41.454 0 01-9.274 0C3.985 17.585 3 16.402 3 15.055z"/>
                    </svg>
                    Type: Novel
                </div>
                <div class="mt-2 flex items-center text-sm text-gray-500">
                    <!-- Heroicon name: mini/map-pin -->
                    <svg class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd"
                              d="M9.69 18.933l.003.001C9.89 19.02 10 19 10 19s.11.02.308-.066l.002-.001.006-.003.018-.008a5.741 5.741 0 00.281-.14c.186-.096.446-.24.757-.433.62-.384 1.445-.966 2.274-1.765C15.302 14.988 17 12.493 17 9A7 7 0 103 9c0 3.492 1.698 5.988 3.355 7.584a13.731 13.731 0 002.273 1.765 11.842 11.842 0 00.976.544l.062.029.018.008.006.003zM10 11.25a2.25 2.25 0 100-4.5 2.25 2.25 0 000 4.5z"
                              clip-rule="evenodd"/>
                    </svg>
                    Class: Hero's Journey
                </div>
                <div class="mt-2 flex items-center text-sm text-gray-500">
                    <!-- Heroicon name: mini/calendar -->
                    <svg class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd"
                              d="M5.75 2a.75.75 0 01.75.75V4h7V2.75a.75.75 0 011.5 0V4h.25A2.75 2.75 0 0118 6.75v8.5A2.75 2.75 0 0115.25 18H4.75A2.75 2.75 0 012 15.25v-8.5A2.75 2.75 0 014.75 4H5V2.75A.75.75 0 015.75 2zm-1 5.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25H4.75z"
                              clip-rule="evenodd"/>
                    </svg>
                    Last updated: {{ project.last_updated }}
                </div>
            </div>
        </div>
        <div class="mt-5 flex lg:justify-around md:justify-start lg:mt-0 lg:ml-4">
    <span class="sm:ml-3">
      <Link type="button" :href="route('project.show') + '?project_id=' + project.project_id"
         class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium
               text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500
                focus:ring-offset-2 cursor-pointer">
        Load Project
      </Link>
    </span>
            <span class="sm:ml-3 pl-4 lg:pl-0">
      <button type="button" @click=destroy(project.project_id)
              class="inline-flex items-center rounded-md border border-gray-300 bg-cleomagenta px-4 py-2 text-sm
               text-white font-medium text-gray-700 shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2
               focus:ring-red-500 focus:ring-offset-2">
         delete
      </button>
    </span>
        </div>
    </div>
</template>

<script>
import {Inertia} from "@inertiajs/inertia";
import { Link } from '@inertiajs/vue3'

export default {
    components: {
        Link
    },
    props: {
        project: {
            required: true,
        }
    },
    methods: {
        destroy(id) {
            if (confirm("This is a destructive operation! Are you sure you want to delete this project?")) {
                Inertia.delete(route("project.delete", id));
            }
        }
    }
}
</script>
