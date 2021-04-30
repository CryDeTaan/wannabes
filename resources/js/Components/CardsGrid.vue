<template>
    <ul class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3">
        <li
            v-for="snippet in snippets" :key="snippet.slug"
            class="col-span-1 flex flex-col text-center bg-white rounded-lg shadow divide-y divide-gray-200"
        >

            <div class="flex-1 flex flex-col p-4">
                <a href="">
                    <h3 class="text-gray-900 text-sm font-medium">{{ snippet.title }}</h3>
                </a>
                <dl class="mt-1 flex-grow flex flex-col justify-between">
                    <dt class="sr-only">Description</dt>
                    <dd class="text-gray-500 text-sm">{{ snippet.description }}</dd>
                    <dt class="sr-only">Tags</dt>
                    <dd class="flex flex-wrap justify-center place-content-start mt-3">
                        <span v-for="tag in snippet.tags" :key="tag.name"
                              class="m-1 px-2 py-1 text-xs font-medium rounded-full"
                              :class="`text-${tag.color}-800 bg-${tag.color}-100`"
                        >{{ tag.name }}</span>
                    </dd>
                    <dt class="sr-only">Creator</dt>
                    <dd class="mt-4">
                        <div class="flex text-gray-500 text-xs">
                            Added by:
                        </div>
                        <user-block :user="snippet.user" />
                    </dd>
                </dl>
            </div>
            <div>
                <div class="-mt-px flex divide-x divide-gray-200">
                    <div class="w-0 flex-1 flex">
                        <a
                            :href="snippet.slug"
                            class="relative -mr-px w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 font-medium border border-transparent rounded-bl-lg hover:text-gray-500"
                        >
                            <PlusCircleIcon class="w-5 h-5 text-gray-400" aria-hidden="true" />
                            <span class="ml-3">Street Cred</span>
                        </a>
                    </div>
                    <div class="-ml-px w-0 flex-1 flex">
                        <div
                            class="relative w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 font-medium border border-transparent rounded-br-lg"
                        >
                            <FireIcon class="w-5 h-5 text-gray-400" aria-hidden="true" />
                            <span class="ml-3">{{ snippet.likes }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</template>

<script>
import { PlusCircleIcon } from '@heroicons/vue/outline'
import { FireIcon } from '@heroicons/vue/solid'
import UserBlock from "@/Components/UserBlock";

export default {
    name: "CardsGrid",

    components: {
        UserBlock,
        PlusCircleIcon,
        FireIcon,
    },

    props: {
        snippets: Object,
    },

    setup(props) {
        const snippets = props.snippets
        return {
            snippets
        }
    },
}
</script>

<style scoped>

</style>
