<template>
    <span
        class="inline-flex rounded-full items-center m-1 px-3 py-0.5 text-sm font-medium"
        :class="`bg-${tag.color}-200 dark:bg-${tag.color}-600 text-${tag.color}-700 dark:text-${tag.color}-200`"
    >
        {{ tag.name }}
    </span>
</template>

<script>
export default {
    name: "BaseTag",

    props: {
        tag: {
            type: Object,
            required: true
        },
    },
}
</script>

<style scoped>

</style>
