<template>
    <div class="items-start max-w-3xl mx-auto px-6 md:max-w-7xl md:px-8 md:grid md:grid-cols-12 lg:gap-8">

        <aside class="sticky top-0 lg:hidden col-span-12">
            <div class="pb-4 w-full max-w-3xl mx-auto px-6 md:max-w-4xl md:px-8 bg-dark-800">
                <h2 class="sr-only">Details</h2>
                <div class="flex justify-between w-full pb-2 border-b border-neutral-200 dark:border-dark-500">
                    <div class="space-y-2">
                        <div class="items-center">
                            <span class="text-primary-600 text-sm font-medium">{{ form.title }}</span>
                        </div>
                        <div class="items-center">
                            <span class="text-gray-900 dark:text-dark-400 text-sm font-medium">{{ form.excerpt }}</span>
                        </div>
                    </div>

                    <div class="flex-col">
                        <p class="ml-1 inline-block align-middle text-sm font-medium text-neutral-500">Tagged:</p>
                        <ul class="leading-8">
                            <li class="inline">
                                <a href="#" class="flex flex-wrap place-content-start">
                                    <span v-for="tag in selectedTags" :key="tag.name"
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
                        <div class="flex items-center pt-2 sm:pt-0">
                            <CalendarIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                            <span class="text-gray-900 dark:text-dark-400 text-sm font-medium">Drafting on <time datetime="2020-12-02">Dec 2, 2020</time> by:</span>
                        </div>
                        <div class="sm:w-40">
                            <user-block :user="user" />
                        </div>
                    </div>
                    <div class="flex items-center my-2">
                        <jet-button class="ml-4">
                            Save
                        </jet-button>
                    </div>
                </div>
            </div>

        </aside>

        <main class="md:col-span-12 lg:col-span-9 lg:border-r lg:border-neutral-200 lg:dark:border-dark-500">
            <form class="max-w-3xl mx-auto px-6 md:max-w-4xl md:px-8 space-y-8 divide-y divide-gray-200 dark:divide-dark-500">

                <div>
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-dark-300">
                            New Snippet
                        </h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-dark-400">
                            Help others be a better wannabe pentester by sharing your knowledge in the form of a snippet.
                        </p>
                    </div>

                    <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">

                        <div class="sm:col-span-3">
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-dark-400">
                                Title
                            </label>
                            <div class="mt-1">
                                <input
                                    type="text" name="title" id="title" v-model="form.title"
                                    class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 dark:border-dark-600 dark:bg-dark-700 rounded-md dark:text-dark-300 dark:focus:text-neutral-300"
                                />
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <!--<tag-select />-->
                            <div>
                                <label for="tags" class="block text-sm font-medium text-gray-700 dark:text-dark-400">Tags</label>
                                <select id="tags" name="tags"
                                        class="mt-1 block w-full pl-3 pr-10 py-2 shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm border-gray-300 dark:border-dark-600 dark:bg-dark-700 rounded-md dark:text-dark-300 dark:focus:text-neutral-300">
                                    <option selected disabled>Select tags...</option>
                                    <option v-for="tag in tags" :key="tag.name"
                                    >{{ tag.name }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="sm:col-span-6">
                            <label for="excerpt" class="block text-sm font-medium text-gray-700 dark:text-dark-400">
                                Excerpt
                            </label>
                            <div class="mt-1">
                                <input
                                    type="text" name="excerpt" id="excerpt" v-model="form.excerpt"
                                    class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 dark:border-dark-600 dark:bg-dark-700 rounded-md dark:text-dark-300 dark:focus:text-neutral-300"
                                />
                            </div>
                        </div>
                        <div class="sm:col-span-6">
                            <label for="snippet" class="block text-sm font-medium text-gray-700 dark:text-dark-400">
                                Snippet
                            </label>
                            <div class="mt-1">
                                    <textarea
                                        id="snippet" name="snippet" rows="30" v-model="form.markdown"
                                        class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-lg border-gray-300 dark:border-dark-600 dark:bg-dark-700 rounded-md dark:text-dark-300 dark:focus:text-neutral-300"
                                    />
                            </div>
                            <p class="mt-2 text-sm text-gray-500 dark:text-dark-400">Write your snippet in markdown.</p>
                        </div>
                    </div>
                </div>

            </form>
        </main>

        <aside class="hidden lg:block lg:col-span-3">
            <div class="sticky top-6 space-y-4">
                <h2 class="sr-only">Details</h2>
                <div class="space-y-5">
                    <div class="flex items-center space-x-2">
                        <span class="text-primary-600 text-sm font-medium">{{ form.title }}</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="text-gray-900 dark:text-dark-400 text-sm font-medium">{{ form.excerpt }}</span>
                    </div>
                </div>
                <div class="mt-6 border-t border-b border-gray-200 dark:border-dark-500 py-7 space-y-8">
                    <div>
                        <div class="flex items-center space-x-2">
                            <CalendarIcon class="h-6 w-6 text-gray-400" aria-hidden="true" />
                            <span class="text-gray-900 dark:text-dark-400 text-sm font-medium">Drafting on <time datetime="2020-12-02">Dec 2, 2020</time> by:</span>
                        </div>
                        <user-block :user="user" />
                    </div>
                    <div>
                        <h2 class="text-sm font-medium text-neutral-500">Tagged:</h2>
                        <ul class="mt-2 leading-8">
                            <li class="inline">
                                <a href="#" class="flex flex-wrap place-content-start mt-3">
                                    <span v-for="tag in selectedTags" :key="tag.name"
                                          class="m-1 px-2 py-1 text-xs font-semiabold rounded-full"
                                          :class="`text-${tag.color}-800 bg-${tag.color}-100 dark:text-${tag.color}-200 dark:bg-${tag.color}-800`"
                                    >{{ tag.name }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div>
                    <button @click="sumbitForm" type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md shadow-sm text-white dark:text-dark-200 bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:ring-primary-500">
                        Save
                    </button>
                </div>
            </div>
        </aside>

    </div>
</template>

<script>
import { reactive } from 'vue'
import { useForm } from '@inertiajs/inertia-vue3'
import AppLayout from "@/Layouts/AppLayout";
import TagSelect from "@/Pages/Snippets/TagSelect";
import UserBlock from "@/Components/UserBlock";
import { CalendarIcon } from '@heroicons/vue/outline'
import JetButton from '@/Jetstream/Button'

const user = {
    handle: 'CryDeTaan',
    streetCred: 123,
    imageUrl:
        'https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
}

const tags = [
    {id: 1, name: 'PowerShell'},
    {id: 2, name: 'SSH'},
    {id: 3, name: 'Lateral Movement'},
    {id: 4, name: 'C2'},
    {id: 5, name: 'Windows'},
]

const selectedTags = [
        {
            'name' : 'PowerShell',
            'color' : 'blue',
            'tw': 'text-blue-800 bg-blue-100 dark:text-blue-200 dark:bg-blue-800'
        },
        {
            'name' : 'SSH',
            'color' : 'red',
            'tw': 'text-red-800 bg-red-100 dark:text-red-200 dark:bg-red-800'
        }
]
export default {
    name: "Create",
    layout: AppLayout,

    components: {
        UserBlock,
        TagSelect,
        CalendarIcon,
        JetButton
    },

    setup() {
        const form = useForm({
            title: null,
            excerpt: null,
            markdown: null,
        })

        function sumbitForm(){
            form.post(route('snippets.store'), {
                preserveScroll: true,
                // TODO: Catch errors
            })
        }

        return {
            sumbitForm,
            form,
            user,
            tags,
            selectedTags
        }
    }

}
</script>

<style scoped>

</style>
