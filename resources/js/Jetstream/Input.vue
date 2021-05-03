<template>
    <input

        class="dark:bg-dark-700 border border-neutral-300 dark:border-dark-500 rounded-md dark:placeholder-dark-400 dark:text-dark-400 focus:outline-none focus:text-neutral-900 dark:focus:text-neutral-400 focus:placeholder-neutral-400 focus:ring-1 focus:ring-primary-500 focus:border-primary-500 sm:text-sm"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        ref="input"
    >
</template>

<script>
    export default {
        props: ['modelValue'],

        emits: ['update:modelValue'],

        methods: {
            focus() {
                this.$refs.input.focus()
            }
        }
    }
</script>

