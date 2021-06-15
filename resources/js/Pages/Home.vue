<template>
    <app-layout>
        <div class="max-w-3xl mx-auto px-6 md:max-w-7xl md:px-8 md:grid md:grid-cols-12 lg:gap-8">
            <main class="md:col-span-12 lg:col-span-9">
                <cards-grid :snippets="snippets"/>
                <div class="mt-6">
                    <pagination :next_page="snippets.next_page_url" :prev_page="snippets.prev_page_url" :links="snippets.links"/>
                </div>
            </main>
            <aside class="hidden lg:block lg:col-span-3">
                <div class="sticky top-6 space-y-4">
                    <div class="px-4 pt-2 bg-white dark:bg-dark-700 rounded-lg shadow">
                        <div class="text-gray-700 dark:text-dark-400 text-md font-medium">Leader Board:</div>
                        <div class="grid grid-cols-1 divide-y divide-gray-200 dark:divide-dark-500">
                            <div v-for="user in leaderBoard" :key="user.id">
                                <user-block :user="user" />
                            </div>
                        </div>
                    </div>
                    <div class="px-4 pt-2 bg-white dark:bg-dark-700 rounded-lg shadow">
                        <div class="text-gray-700 dark:text-dark-400 text-md font-medium">Tags:</div>
                        <ul class="mt-2 leading-8">
                            <li class="inline">
                                <base-tag
                                    v-for="tag in tags" :key="tag" :tag="tag"
                                />
                            </li>
                        </ul>
                        <p class="py-3 text-sm text-neutral-600 dark:text-dark-400">
                            Let me know if you have any tag suggestions
                            <a target="_blank" href="https://twitter.com/CryDeTaan" class="underline text-sm text-primary-600 hover:text-primary-900 dark:text-primary-400 dark:hover:text-primary-500">
                               @CryDeTaan
                            </a>
                        </p>
                    </div>
                </div>
            </aside>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import CardsGrid from "@/Components/CardsGrid";
import UserBlock from "@/Components/UserBlock";
import Pagination from "@/Components/Pagination";
import {SearchIcon} from '@heroicons/vue/solid'
import BaseTag from "@/Components/BaseTag";

export default {
    components: {
        BaseTag,
        Pagination,
        UserBlock,
        CardsGrid,
        AppLayout,
        SearchIcon,
    },

    props: {
        snippets: Object,
        leaderBoard: Array,
        tags: Array,
        filters: Object,
    },

    setup(props) {
        //
    },
}
</script>
