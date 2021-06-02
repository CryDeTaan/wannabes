<template>
    <div class="max-w-3xl mx-auto px-6 md:max-w-7xl md:px-8 md:grid md:grid-cols-12 lg:gap-8">
        <aside class="sticky top-0 z-30 lg:hidden col-span-12">
            <div class="pb-4 w-full max-w-3xl mx-auto px-6 md:max-w-4xl md:px-8">
                <h2 class="sr-only">Details</h2>
                <div class="flex justify-between w-full pb-2 border-b border-neutral-200 dark:border-dark-500">
                    <div class="space-y-2">
                        <div class="items-center">
                            <span class="text-primary-600 text-sm font-medium">{{ snippet.title }}</span>
                        </div>
                        <div class="items-center">
                            <span class="text-gray-900 dark:text-dark-400 text-sm font-medium">{{ snippet.excerpt }}</span>
                        </div>
                    </div>

                    <div class="flex-col">
                        <p class="ml-1 inline-block align-middle text-sm font-medium text-neutral-500">Tagged:</p>
                        <ul class="leading-8">
                            <li class="inline">
                                <base-tag
                                    v-for="tag in snippet.tags" :key="tag" :tag="tag"
                                />
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="flex justify-between items-center">
                    <div class="flex flex-col sm:flex-row sm:space-x-2 max-w-2xl">
                        <div class="flex items-center pt-2">
                            <CalendarIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                            <span class="text-gray-900 dark:text-dark-400 text-sm font-medium">Drafting on <time
                                datetime="2020-12-02"
                            >{{ snippet.created_at}}</time> by:</span>
                        </div>
                        <div class="sm:w-40">
                            <user-block :user="snippet.user" />
                        </div>
                    </div>
                    <div class="flex items-center my-2">
                        <button v-if="can_edit" type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md shadow-sm text-white dark:text-dark-200 bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:ring-primary-500">
                            <PencilAltIcon class="-ml-1 mr-2 h-5 w-5" aria-hidden="true" />
                            Edit
                        </button>
                        <button v-else type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md shadow-sm text-white dark:text-dark-200 bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:ring-primary-500">
                            <PlusCircleIcon class="-ml-1 mr-2 h-5 w-5" aria-hidden="true" />
                            Street Cred
                        </button>
                    </div>
                </div>
            </div>

        </aside>

        <main class="md:col-span-12 lg:col-span-9 lg:border-r lg:border-neutral-200 lg:dark:border-dark-500">
            <div
                class="max-w-3xl mx-auto px-6 md:max-w-4xl md:px-8 prose dark:prose-dark"
                v-html="snippet.markdown"
            ></div>
        </main>

        <aside class="hidden lg:block lg:col-span-3">
            <div class="sticky top-6 space-y-4">
                <h2 class="sr-only">Details</h2>
                <div class="flex">
                    <div class="flex-1 space-y-5">
                        <div class="flex items-center space-x-2">
                            <span class="text-primary-600 text-sm font-medium">{{ snippet.title }}</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="text-gray-900 dark:text-dark-400 text-sm font-medium">{{
                                    snippet.excerpt
                                }}</span>
                        </div>
                    </div>
                    <span class="flex items-center">
                        <FireIcon class="w-5 h-5 text-gray-400 dark:text-dark-500" aria-hidden="true" />
                        <span class="ml-2 text-gray-700 dark:text-dark-400">{{ snippet.streetcred }}</span>
                    </span>
                </div>
                <div class="mt-6 border-t border-b border-gray-200 dark:border-dark-500 py-7 space-y-8">
                    <div>
                        <div class="flex items-center space-x-2">
                            <CalendarIcon class="h-6 w-6 text-gray-400" aria-hidden="true" />
                            <span class="text-gray-900 dark:text-dark-400 text-sm font-medium">Created on <time datetime="2020-12-02">{{ snippet.created_at}}</time> by:</span>
                        </div>
                        <user-block :user="snippet.user" />
                    </div>
                    <div>
                        <h2 class="text-sm font-medium text-neutral-500">Tagged:</h2>
                        <ul class="mt-2 leading-8">
                            <li class="inline">
                                <base-tag
                                    v-for="tag in snippet.tags" :key="tag" :tag="tag"
                                />
                            </li>
                        </ul>
                    </div>
                </div>
                <div>
                    <base-button v-if="can_edit" class="w-full" as="link" :href="route('snippets.edit', snippet.slug)">
                        <PencilAltIcon class="-ml-1 mr-2 h-5 w-5" aria-hidden="true" />
                        Edit
                    </base-button>
                    <base-button v-else-if="snippet.gaveStreetcred" class="w-full" @click="toggleStreetcred"  secondary>
                        <MinusCircleIcon class="-ml-1 mr-2 h-5 w-5" aria-hidden="true" />
                        Remove Street Cred
                    </base-button>
                    <base-button v-else @click="toggleStreetcred" class="w-full">
                        <PlusCircleIcon class="-ml-1 mr-2 h-5 w-5" aria-hidden="true" />
                        Street Cred
                    </base-button>
                </div>
            </div>
        </aside>

    </div>

</template>

<script>
import { computed } from "vue";
import { Inertia } from '@inertiajs/inertia'
import { usePage } from '@inertiajs/inertia-vue3'
import hljs from 'highlight.js';
import 'highlight.js/styles/atom-one-dark.css';
import AppLayout from "@/Layouts/AppLayout";
import UserBlock from "@/Components/UserBlock";
import { CalendarIcon, MinusCircleIcon, PlusCircleIcon, PencilAltIcon } from '@heroicons/vue/outline'
import { FireIcon } from '@heroicons/vue/solid'
import JetButton from '@/Jetstream/Button'
import BaseTag from "@/Components/BaseTag";

export default {
    name: "Show",
    layout: AppLayout,

    components: {
        BaseTag,
        hljs,
        UserBlock,
        CalendarIcon,
        PlusCircleIcon,
        MinusCircleIcon,
        PencilAltIcon,
        FireIcon,
        JetButton
    },

    props: {
        snippet: Object,
    },

    setup(props) {
        const snippet = props.snippet

        const can_edit = computed(() =>
            usePage().props.value.user &&
            snippet.user.name === usePage().props.value.user.name
        )

        const toggleStreetcred = function () {
            if (snippet.gaveStreetcred) {
                Inertia.delete(`/snippets/${snippet.slug}/streetcred`, {
                    preserveState: false,
                    preserveScroll: true
                })
            } else {
                Inertia.post(`/snippets/${snippet.slug}/streetcred`, {}, {
                    preserveState: false,
                    preserveScroll: true
                })
            }
        }

        return {
            toggleStreetcred,
            can_edit,
            snippet
        }
    },

    mounted() {
        hljs.highlightAll();
    }
}
</script>

<style scoped>

</style>
