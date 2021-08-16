<template>
    <Link :href="`/tags/${tag.slug}`">
        <span
            class="inline-flex rounded-full items-center m-1 px-2.5 py-0.5 text-xs font-medium"
            :class="`bg-${tag.color}-200 dark:bg-${tag.color}-600 text-${tag.color}-700 dark:text-${tag.color}-200`"
        >
            {{ tag.name }}
        </span>
    </Link>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'
export default {
    name: "BaseTagSmall",

    components: {
        Link
    },

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
