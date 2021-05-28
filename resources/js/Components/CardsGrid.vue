<template>
    <ul class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3">
        <li
            v-for="snippet in snippets.data" :key="snippet.slug"
            class="col-span-1 flex flex-col text-center bg-white dark:bg-dark-700 rounded-lg shadow divide-y divide-gray-200 dark:divide-dark-500"
        >

            <div class="flex-1 flex flex-col p-4">
                <inertia-link :href="route('snippets.show', snippet.slug)">
                    <h3 class="text-gray-900 dark:text-dark-300 text-sm font-medium">{{ snippet.title }}</h3>
                </inertia-link>
                <dl class="mt-1 flex-grow flex flex-col justify-between">
                    <dt class="sr-only">Excerpt</dt>
                    <inertia-link :href="route('snippets.show', snippet.slug)">
                        <dd class="text-gray-500 dark:text-dark-400 text-sm">{{ snippet.excerpt }}</dd>
                    </inertia-link>
                    <dt class="sr-only">Tags</dt>
                    <dd class="flex flex-wrap justify-center place-content-start mt-3">
                        <span v-for="tag in snippet.tags" :key="tag.name"
                              class="m-1 px-2 py-1 text-xs font-semiabold rounded-full"
                              :class="`text-${tag.color}-800 bg-${tag.color}-100 dark:text-${tag.color}-200 dark:bg-${tag.color}-800`"
                        >{{ tag.name }}</span>
                    </dd>
                    <dt class="sr-only">Creator</dt>
                    <dd class="mt-4">
                        <div class="flex text-gray-500 dark:text-dark-400 text-xs">
                            Added by:
                        </div>
                        <user-block :user="snippet.user" />
                    </dd>
                </dl>
            </div>
            <div>
                <div class="-mt-px flex divide-x divide-gray-200 dark:divide-dark-500">
                    <div class="w-0 flex-1 flex">
                        <button
                            @click="toggleStreetcred(snippet.slug, snippet.gaveStreetcred)"
                            :class="snippet.gaveStreetcred
                                ? 'text-primary-600 hover:text-primary-700'
                                : 'text-gray-700 dark:text-dark-400 hover:text-gray-500 dark:hover:text-dark-300' "
                            class="relative -mr-px w-0 flex-1 inline-flex items-center justify-center py-4 text-sm font-medium border border-transparent rounded-bl-lg focus:outline-none"
                        >
                            <PlusCircleIcon class="w-5 h-5" aria-hidden="true" />
                            <span class="ml-3">Street Cred</span>
                        </button>
                    </div>
                    <div class="-ml-px w-0 flex-1 flex">
                        <div
                            class="relative w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 dark:text-dark-400 font-medium border border-transparent rounded-br-lg"
                        >
                            <FireIcon class="w-5 h-5 text-gray-400" aria-hidden="true" />
                            <span class="ml-3">{{ snippet.streetcred ? snippet.streetcred : 0}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</template>

<script>
import { Inertia } from '@inertiajs/inertia'

import { PlusCircleIcon } from '@heroicons/vue/outline'
import { FireIcon } from '@heroicons/vue/solid'
import UserBlock from "@/Components/UserBlock";

export default {
    name: "CardsGrid",

    components: {
        Inertia,
        UserBlock,
        PlusCircleIcon,
        FireIcon,
    },

    props: {
        snippets: Object,
    },

    setup(props) {
        const snippets = props.snippets

        const toggleStreetcred = (slug, deleteStreetcred) => {
            if (deleteStreetcred) {
                Inertia.delete(`/snippets/${slug}/streetcred`, {
                    preserveState: false,
                    preserveScroll: true
                })
            } else {
                Inertia.post(`/snippets/${slug}/streetcred`, {}, {
                    preserveState: false,
                    preserveScroll: true
                })
            }
        }

        return {
            snippets,
            toggleStreetcred
        }
    },
}
</script>

<style scoped>

</style>
