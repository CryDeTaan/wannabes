<template>
    <button :type="type" class="inline-flex items-center px-4 py-2 bg-white dark:bg-dark-700 border border-primary-300 dark:border-dark-500 rounded-md font-semibold text-xs text-neutral-700 dark:text-dark-400 uppercase tracking-widest shadow-sm hover:text-neutral-500 dark:hover:bg-dark-600 dark:hover:text-dark-400 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-neutral-800 active:bg-neutral-50 disabled:opacity-25 transition">
        <slot></slot>
    </button>
</template>

<script>
    export default {
        props: {
            type: {
                type: String,
                default: 'button',
            },
        }
    }
</script>
