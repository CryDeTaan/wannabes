<template>
    <span
        class="inline-flex rounded-full items-center m-1 py-0.5 pl-2.5 pr-1 text-sm font-medium"
        :class="`bg-${tag.color}-200 dark:bg-${tag.color}-600 text-${tag.color}-700 dark:text-${tag.color}-200`">
        {{ tag.name }}
        <button
            @click="remove(tag.slug)"
            type="button"
            class="flex-shrink-0 ml-0.5 h-4 w-4 rounded-full inline-flex items-center justify-center focus:outline-none focus:text-white"
            :class="`text-${tag.color}-400 dark:text-${tag.color}-300 hover:bg-${tag.color}-200 dark:hover:bg-${tag.color}-700 hover:text-${tag.color}-500 dark:hover:text-${tag.color}-300 focus:bg-${tag.color}-500`">
            <span class="sr-only">Remove large option</span>
            <svg class="h-2 w-2" stroke="currentColor" fill="none" viewBox="0 0 8 8">
                <path stroke-linecap="round" stroke-width="1.5" d="M1 1l6 6m0-6L1 7" />
            </svg>
        </button>
    </span>
</template>

<script>
const color = {
    blue: 'bg-blue-200 dark:bg-blue-600 text-blue-700 dark:text-blue-200 text-blue-400 dark:text-blue-300 hover:bg-blue-200 dark:hover:bg-blue-700 hover:text-blue-500 dark:hover:text-blue-300 focus:bg-blue-500',
    red: 'bg-red-200 dark:bg-red-600 text-red-700 dark:text-red-200 text-red-400 dark:text-red-300 hover:bg-red-200 dark:hover:bg-red-700 hover:text-red-500 dark:hover:text-red-300 focus:bg-red-500',
    green: 'bg-green-200 dark:bg-green-600 text-green-700 dark:text-green-200 text-green-400 dark:text-green-300 hover:bg-green-200 dark:hover:bg-green-700 hover:text-green-500 dark:hover:text-green-300 focus:bg-green-500',
    pink: 'bg-pink-200 dark:bg-pink-600 text-pink-700 dark:text-pink-200 text-pink-400 dark:text-pink-300 hover:bg-pink-200 dark:hover:bg-pink-700 hover:text-pink-500 dark:hover:text-pink-300 focus:bg-pink-500',
    yellow: 'bg-yellow-200 dark:bg-yellow-600 text-yellow-700 dark:text-yellow-200 text-yellow-400 dark:text-yellow-300 hover:bg-yellow-200 dark:hover:bg-yellow-700 hover:text-yellow-500 dark:hover:text-yellow-300 focus:bg-yellow-500',
    indigo: 'bg-indigo-200 dark:bg-indigo-600 text-indigo-700 dark:text-indigo-200 text-indigo-400 dark:text-indigo-300 hover:bg-indigo-200 dark:hover:bg-indigo-700 hover:text-indigo-500 dark:hover:text-indigo-300 focus:bg-indigo-500',
}
export default {
    name: "BaseTagClose",

    emits: ['remove-tag'],

    props: {
        tag: {
            type: Object,
            required: true
        },
    },

    setup(props, context) {

        function remove(slug) {
            context.emit('remove-tag', slug)
        }

        return {remove}
    }
}
</script>

<style scoped>

</style>
