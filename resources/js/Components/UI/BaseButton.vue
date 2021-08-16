<template>
    <Link v-if="as === 'link'" :href="href" :class="classes">
        <slot></slot>
    </Link>
    <button v-else-if="as === 'button'" type="button" :class="classes">
        <slot></slot>
    </button>
</template>

<script>

import { computed } from 'vue';
import { Link } from '@inertiajs/inertia-vue3'

export default {
    name: "BaseButton",

   components: {
        Link
   },

    props: {
        secondary: {
            type: Boolean,
            required: false,
            default: false,
        },
        as: {
            // link or button
            type: String,
            required: false,
            default: 'button',
        },
        href: {
            type: String,
            required: false,
            default: '/',
        },
    },

    setup(props) {
        const classes = computed(function() {
            let classes = "inline-flex items-center justify-center px-4 py-2 border rounded-md shadow-sm " +
                "text-xs uppercase tracking-widest font-medium disabled:opacity-25 " +
                "focus:outline-none focus:ring-2 focus:ring-offset-2 "

            if (!props.secondary) {
                classes += "border-transparent text-white bg-primary-600 hover:bg-primary-700 focus:ring-primary-500 " +
                    "dark:text-dark-200 dark:ring-offset-dark-800 dark:focus:ring-primary-500"
            } else {
                classes += "border-primary-300 text-neutral-600 hover:bg-primary-200 hover:text-primary-600 ring-primary-500 dark:focus:ring-dark-500  " +
                    "dark:border-dark-400 dark:bg-dark-700 dark:text-dark-400 dark:ring-offset-dark-800 dark:hover:bg-dark-600 dark:hover:text-dark-200 "
            }
            return classes
        })

        return {
            classes
        }
    },
}
</script>

<style scoped>

</style>
