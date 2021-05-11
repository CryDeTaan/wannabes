<template>
    <div class="max-w-3xl mx-auto px-6 md:max-w-7xl md:px-8 md:grid md:grid-cols-12 lg:gap-8">
        <aside class="sticky top-0 z-30 lg:hidden col-span-12">
            <div class="pb-4 w-full max-w-3xl mx-auto px-6 md:max-w-4xl md:px-8 bg-dark-800">
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
                                <a href="#" class="flex flex-wrap place-content-start">
                                     <span
                                         v-for="tag in snippet.tags" :key="tag.name"
                                         class="m-1 px-2 py-1 text-xs font-semiabold rounded-full"
                                         :class="`text-${tag.color}-800 bg-${tag.color}-100 dark:text-${tag.color}-200 dark:bg-${tag.color}-800`"
                                     >{{ tag.name }}</span>
                                </a>
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
                        <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md shadow-sm text-white dark:text-dark-200 bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:ring-primary-500">
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
                <div class="space-y-5">
                    <div class="flex items-center space-x-2">
                        <span class="text-primary-600 text-sm font-medium">{{ snippet.title }}</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="text-gray-900 dark:text-dark-400 text-sm font-medium">{{ snippet.excerpt }}</span>
                    </div>
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
                                <a href="#" class="flex flex-wrap place-content-start mt-3">
                                    <span v-for="tag in snippet.tags" :key="tag.name"
                                          class="m-1 px-2 py-1 text-xs font-semiabold rounded-full"
                                          :class="`text-${tag.color}-800 bg-${tag.color}-100 dark:text-${tag.color}-200 dark:bg-${tag.color}-800`"
                                    >{{ tag.name }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div>
                    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md shadow-sm text-white dark:text-dark-200 bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:ring-primary-500">
                        <PlusCircleIcon class="-ml-1 mr-2 h-5 w-5" aria-hidden="true" />
                        Street Cred
                    </button>
                </div>
            </div>
        </aside>

    </div>

</template>

<script>
import hljs from 'highlight.js';
import 'highlight.js/styles/atom-one-dark.css';
import AppLayout from "@/Layouts/AppLayout";
import UserBlock from "@/Components/UserBlock";
import {CalendarIcon, PlusCircleIcon} from '@heroicons/vue/outline'
import JetButton from '@/Jetstream/Button'


const snippet = {
        slug: 'invoke-mimikatz',
        title: 'Invoke-Mimikatz',
        description: 'Dump Credentials and Secretes',
        tags: [
            {
                'name' : 'PowerShell',
                'color' : 'blue'
            }
        ],
        likes: '192',
        user: {
            handle: 'CryDeTaan',
            streetCred: 123,
            imageUrl:
                'https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
        },
        imageUrl:
            'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60',
    }

export default {
    name: "Show",
    layout: AppLayout,

    components: {
        hljs,
        UserBlock,
        CalendarIcon,
        PlusCircleIcon,
        JetButton
    },

    props: {
        snippet: Object,
    },

    setup(props) {
        const snippet = props.snippet

        return {
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
