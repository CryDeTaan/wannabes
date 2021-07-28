<template>
    <div class="max-w-3xl mx-auto px-6 md:max-w-7xl md:px-8 md:grid md:grid-cols-12 lg:gap-8">
        <aside class="sticky top-0 z-30 lg:hidden col-span-12">
            <div class="pb-4 w-full max-w-3xl mx-auto px-2 md:max-w-4xl md:px-8 bg-dark-800">
                <h2 class="sr-only">Details</h2>
                <div class="flex justify-between w-full pb-2 border-b border-neutral-200 dark:border-dark-500">
                    <div class="space-y-2 pr-2">
                        <div class="items-center">
                            <span class="text-primary-600 text-sm font-medium">{{ snippet.title }}</span>
                        </div>
                        <div class="items-center">
                            <span class="text-gray-900 dark:text-dark-400 text-sm font-medium">{{ snippet.excerpt }}</span>
                        </div>
                    </div>

                    <div class="flex-col flex justify-end">
                        <p class="ml-1 inline-block text-right align-middle text-sm font-medium text-neutral-500">Tagged:</p>
                        <ul class="leading-8">
                            <li class="flex flex-wrap justify-end inline">
                                <base-tag
                                    v-for="tag in snippet.tags" :key="tag" :tag="tag"
                                />
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="flex-col sm:flex-row sm:flex justify-between items-center">
                    <div class="flex flex-col sm:flex-row sm:space-x-2 max-w-2xl">
                        <div class="flex items-center pt-2 sm:pt-0">
                            <CalendarIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                            <span class="ml-2 text-gray-900 dark:text-dark-400 text-sm font-medium">Drafting on <time
                                :datetime="snippet.created"
                            >{{ snippet.created_at}}</time> by:</span>
                        </div>
                        <div class="sm:w-40">
                            <user-block :user="snippet.user" />
                        </div>
                    </div>
                    <div class="flex items-center my-2">
                        <div class="flex w-full sm:flex-col justify-end" v-if="can_edit">
                            <base-button class="flex-1" as="link" :href="route('snippets.edit', snippet.slug)">
                                <PencilAltIcon class="-ml-1 mr-2 h-5 w-5" aria-hidden="true" />
                                Edit
                            </base-button>
                            <base-button @click="confirmSnippetDeletion" :secondary="true" class="ml-2 sm:ml-0 sm:mt-2 flex-1">
                                <TrashIcon class="-ml-1 mr-2 h-5 w-5" aria-hidden="true" />
                                Delete
                            </base-button>
                        </div>
                        <base-button class="flex-1" v-else-if="snippet.gaveStreetcred" @click="toggleStreetcred" secondary>
                            <MinusCircleIcon class="-ml-1 mr-2 h-5 w-5" aria-hidden="true" />
                            Remove Street Cred
                        </base-button>
                        <base-button class="flex-1" v-else @click="toggleStreetcred">
                            <PlusCircleIcon class="-ml-1 mr-2 h-5 w-5" aria-hidden="true" />
                            Street Cred
                        </base-button>
                    </div>
                </div>
            </div>

        </aside>

        <main class="md:col-span-12 lg:col-span-9 lg:border-r lg:border-neutral-200 lg:dark:border-dark-500">
            <div
                class="max-w-3xl mx-auto px-6 md:max-w-4xl md:px-8 prose dark:prose-dark"
                v-html="snippet.markdown"
            ></div>
            <div class="max-w-3xl mx-auto mt-6 md:max-w-4xl md:px-8">
                <comment-layout :comments="comments"/>
            </div>
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
                            <span class="text-gray-900 dark:text-dark-400 text-sm font-medium">Created on <time :datetime="snippet.created_at">{{ snippet.created_at}}</time> by:</span>
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
                    <template v-if="can_edit" >
                        <base-button class="w-full" as="link" :href="route('snippets.edit', snippet.slug)">
                            <PencilAltIcon class="-ml-1 mr-2 h-5 w-5" aria-hidden="true" />
                            Edit
                        </base-button>
                        <base-button @click="confirmSnippetDeletion" :secondary="true" class="w-full mt-2">
                            <TrashIcon class="-ml-1 mr-2 h-5 w-5" aria-hidden="true" />
                            Delete
                        </base-button>
                    </template>
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

        <!-- Delete Snippet Confirmation Modal -->
        <jet-dialog-modal :show="confirmingSnippetDeletion" @close="closeModal">
            <template #title>
                Delete Snippet
            </template>

            <template #content>
                Are you sure you want to delete this snippet? Once the snippet is deleted, it cannot be undone. Please confirm you would like to permanently delete this snippet.
            </template>

            <template #footer>
                <base-button @click="closeModal" :secondary="true">
                    Cancel
                </base-button>
                <base-button class="ml-2" @click="deleteSnippet">
                   Delete
                </base-button>
            </template>
        </jet-dialog-modal>

    </div>

</template>

<script>
import {computed, ref} from "vue";
import { Inertia } from '@inertiajs/inertia'
import { usePage } from '@inertiajs/inertia-vue3'
import hljs from 'highlight.js';
import 'highlight.js/styles/atom-one-dark.css';
import AppLayout from "@/Layouts/AppLayout";
import UserBlock from "@/Components/UserBlock";
import { CalendarIcon, MinusCircleIcon, PlusCircleIcon, PencilAltIcon, TrashIcon } from '@heroicons/vue/outline'
import { FireIcon } from '@heroicons/vue/solid'
import JetButton from '@/Jetstream/Button'
import BaseTag from "@/Components/BaseTag";
import JetDialogModal from '@/Jetstream/DialogModal'
import BaseTagSmall from "@/Components/BaseTagSmall";
import CommentLayout from "@/Pages/Snippets/Comments/CommentLayout";

export default {
    name: "Show",
    layout: AppLayout,

    components: {
        CommentLayout,
        BaseTagSmall,
        BaseTag,
        hljs,
        UserBlock,
        CalendarIcon,
        PlusCircleIcon,
        MinusCircleIcon,
        PencilAltIcon,
        FireIcon,
        TrashIcon,
        JetButton,
        JetDialogModal,
    },

    props: {
        comments: Array,
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

        const confirmingSnippetDeletion = ref(false)
        const confirmSnippetDeletion = () => { confirmingSnippetDeletion.value = true }
        const closeModal = () => { confirmingSnippetDeletion.value = false }

        function deleteSnippet() {
            Inertia.delete(`/snippets/${snippet.slug}`, )
        }


        return {
            toggleStreetcred,
            deleteSnippet,
            can_edit,
            snippet,
            confirmingSnippetDeletion,
            confirmSnippetDeletion,
            closeModal,
        }
    },

    mounted() {
        hljs.highlightAll();
    }
}
</script>

<style scoped>

</style>
