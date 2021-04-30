<template>
    <div class="max-w-3xl mx-auto px-6 md:max-w-4xl md:px-8">
        <form class="space-y-8 divide-y divide-gray-200 dark:divide-dark-500">

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
                                type="text" name="title" id="title"
                                class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 dark:border-dark-600 dark:bg-dark-700 rounded-md dark:text-dark-300 dark:focus:text-neutral-300"
                            />
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <tag-select />
                    </div>

                    <div class="sm:col-span-6">
                        <label for="excerpt" class="block text-sm font-medium text-gray-700 dark:text-dark-400">
                            Excerpt
                        </label>
                        <div class="mt-1">
                            <input
                                type="text" name="excerpt" id="excerpt"
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
                                    id="snippet" name="snippet" rows="25"
                                    class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-lg border-gray-300 dark:border-dark-600 dark:bg-dark-700 rounded-md dark:text-dark-300 dark:focus:text-neutral-300"
                                />
                        </div>
                        <p class="mt-2 text-sm text-gray-500 dark:text-dark-400">Write your snippet in markdown.</p>
                    </div>
                </div>
            </div>

            <div class="pt-5">
                <div class="flex justify-end">
                    <button
                        type="button"
                        class="bg-white dark:bg-dark-700 py-2 px-4 border border-gray-300 dark:border-dark-500 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-dark-400 hover:bg-gray-50 dark:hover:bg-dark-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500"
                    >
                        Cancel
                    </button>
                    <button
                        type="submit"
                        class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white dark:text-dark-100 bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500"
                    >
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import TagSelect from "@/Pages/Snippets/TagSelect";

export default {
    name: "Create",
    components: {TagSelect},
    layout: AppLayout,
}
</script>

<style scoped>

</style>
