<template>
    <button
        :type="type"
        class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-neutral-200 dark:text-dark-200 uppercase tracking-widest hover:bg-primary-700 active:bg-primary-900 focus:outline-none focus:border-primary-900 focus:ring focus:ring-primary-300 disabled:opacity-25 transition">
        <slot></slot>
    </button>
</template>

<script>
    export default {
        props: {
            type: {
                type: String,
                default: 'submit',
            },
        }
    }
</script>
