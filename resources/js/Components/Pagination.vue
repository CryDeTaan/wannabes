<template>
    <nav class="border-t border-gray-200 dark:border-dark-500 px-4 flex items-center justify-between sm:px-0">
        <div class="-mt-px w-0 flex-1 flex">
            <Link
                v-if="prev_page !== null"
                :href="prev_page"
                :class="arrowClasses"
            >
                <ArrowNarrowLeftIcon class="mr-3 h-5 w-5 text-gray-400 dark:text-dark-500" aria-hidden="true" />
                Previous
            </Link>
        </div>
        <div class="hidden md:-mt-px md:flex">

            <template v-for="(link, index) in links.slice(1,-1)" :key="index">
                <span
                    v-if="!link.url"
                    class="border-transparent text-gray-500 border-t-2 pt-4 px-4 inline-flex items-center text-sm font-medium"
                >{{ link.label }}
                </span>
                <Link
                    v-else
                    :href="link.url ? link.url : ''"
                    class="border-t-2 pt-4 px-4 inline-flex items-center text-sm font-medium"
                    :class="activeClasses(link.active)"
                >
                    {{ link.label }}
                </Link>
            </template>
        </div>
        <div class="-mt-px w-0 flex-1 flex justify-end">
            <Link
                v-if="next_page !== null"
                :href="next_page"
                :class="arrowClasses"
            >
                Next
                <ArrowNarrowRightIcon class="ml-3 h-5 w-5 text-gray-400 dark:text-dark-500" aria-hidden="true" />
            </Link>
        </div>
    </nav>
</template>

<script>
import { computed } from 'vue'
import { Link } from '@inertiajs/inertia-vue3'
import { ArrowNarrowLeftIcon, ArrowNarrowRightIcon } from '@heroicons/vue/solid'

export default {
    name: "Pagination",

    components: {
        Link,
        ArrowNarrowLeftIcon,
        ArrowNarrowRightIcon,
    },

    props: {
        next_page: String,
        prev_page: String,
        links: Object,
    },

    setup() {
        const arrowClasses = computed(function (){
            return "border-t-2 border-transparent pt-4 pl-1 inline-flex items-center text-sm font-medium " +
                "text-gray-500 dark:text-dark-400 hover:text-gray-700 dark:hover:text-dark-300 hover:border-gray-300"
        })

        function activeClasses(isActive) {
            return isActive ?
                "border-primary-500 text-primary-600" :
                "border-transparent text-gray-500 hover:text-gray-700 dark:hover:text-dark-300 hover:border-gray-300"
        }

        return {
            arrowClasses,
            activeClasses,
        }
    },
}
</script>

<style scoped>

</style>
