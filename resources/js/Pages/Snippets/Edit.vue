<template>
    <div class="items-start max-w-3xl mx-auto px-6 md:max-w-7xl md:px-8 md:grid md:grid-cols-12 lg:gap-8">

        <aside class="sticky top-0 lg:hidden col-span-12">
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
                                <base-tag-close
                                    v-for="tag in form.tags" :key="tag" :tag="tag"
                                    @remove-tag="removeTag"
                                />
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="flex justify-between items-center">
                    <div class="flex flex-col sm:flex-row sm:space-x-2 max-w-2xl">
                        <div class="flex items-center pt-2 sm:pt-0">
                            <CalendarIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                            <span class="text-gray-900 dark:text-dark-400 text-sm font-medium">Drafting on <time :datetime="now">{{ now }}</time> by:</span>
                        </div>
                        <div class="sm:w-40">
                            <user-block :user="snippet.user" />
                        </div>
                    </div>
                    <div class="flex items-center my-2">
                        <base-button @click="submitForm" class="w-full">
                            <SaveIcon class="-ml-1 mr-2 h-5 w-5" aria-hidden="true" />
                            Save
                        </base-button>
                    </div>
                </div>
            </div>

        </aside>

        <main class="md:col-span-12 lg:col-span-9 lg:border-r lg:border-neutral-200 lg:dark:border-dark-500">
            <form class="max-w-3xl mx-auto px-6 md:max-w-4xl md:px-8 space-y-8 divide-y divide-gray-200 dark:divide-dark-500">

                <div>
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-dark-300">
                            Edit Snippet
                        </h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-dark-400">
                            Help others be a better wannabe pentester by sharing your knowledge in the form of a snippet.
                        </p>
                    </div>

                    <snippet-form  :form="form" :tags="availableTags"/>

                </div>

            </form>
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
                <div class="mt-6 border-t border-b border-gray-200 dark:border-dark-500 py-4 space-y-8">
                    <div>
                        <div class="flex items-center space-x-2">
                            <CalendarIcon class="h-6 w-6 text-gray-400" aria-hidden="true" />
                            <span class="text-gray-900 dark:text-dark-400 text-sm font-medium">Drafting on <time :datetime="now">{{ now }}</time> by:</span>
                        </div>
                        <user-block :user="snippet.user" />
                    </div>
                    <div>
                        <h2 class="text-sm font-medium text-neutral-500">Tagged:</h2>
                        <ul class="mt-2 leading-8">
                            <li class="inline">
                                <base-tag-close
                                    v-for="tag in form.tags" :key="tag" :tag="tag"
                                    @remove-tag="removeTag"
                                />
                            </li>
                        </ul>
                    </div>
                    <base-button @click="submitForm" class="w-full">
                        <SaveIcon class="-ml-1 mr-2 h-5 w-5" aria-hidden="true" />
                        Save
                    </base-button>
                </div>
                <tag-request />
            </div>
        </aside>

    </div>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import UserBlock from "@/Components/UserBlock";
import { CalendarIcon, SaveIcon } from '@heroicons/vue/outline'
import JetButton from '@/Jetstream/Button'
import {computed, reactive, ref} from "vue";
import BaseTagClose from "@/Components/BaseTagClose";
import {useForm} from "@inertiajs/inertia-vue3";
import TagRequest from "@/Components/TagRequest";
import SnippetForm from "@/Pages/Snippets/SnippetForm";

export default {
    name: "Edit",
    layout: AppLayout,

    components: {
        SnippetForm,
        TagRequest,
        BaseTagClose,
        UserBlock,
        CalendarIcon,
        SaveIcon,
        JetButton
    },

    props: {
        snippet: Object,
        allTags: Array,
    },

    setup(props) {

        const form = useForm({
            title: props.snippet.title,
            excerpt: props.snippet.excerpt,
            markdown: props.snippet.markdown,
            tags: props.snippet.tags
        })

        function submitForm(){
            form
                .transform((data) => ({
                    ...data,
                    tags: data.tags.map(tag => tag.id),
                }))
                .put(route('snippets.update', props.snippet.slug), {
                    preserveScroll: true,
                    // TODO: Catch errors
                })
        }

        // Preparing available tags mean to remove already selected tags.
        // https://stackoverflow.com/a/20690490/15658552
        // ^^^ Reference "Removing multiple items (ECMAScript 7 code)" section
        const selectedTagIds =  form.tags.map(tag => tag.id);
        const availableTags = ref(
            props.allTags.filter(tag => !selectedTagIds.includes(tag.id))
        )

        function removeTag(slug) {
            const index = form.tags.findIndex((tag) => tag.slug === slug);
            const selectedTag = form.tags.splice(index, 1);
            availableTags.value.push(selectedTag[0])
            availableTags.value = _.orderBy(availableTags.value, 'id')
        }

        const now = computed(() => {
            return new Date().toLocaleDateString(
                'en-us',
                {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                })
        })

        return {
            availableTags,
            form,
            submitForm,
            removeTag,
            now,
        }
    }

}
</script>

<style scoped>

</style>
