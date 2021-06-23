<template>
    <div class="text-gray-700 dark:text-dark-400 text-md font-medium">Tags:</div>
    <ul v-if="tags" class="mt-2 leading-8">
        <li class="inline">
            <base-tag
                v-for="tag in tags" :key="tag" :tag="tag"
            />
        </li>
    </ul>
</template>

<script>
import BaseTag from "@/Components/BaseTag";

export default {
    name: "TagsCard",
    components: {BaseTag},
    props: {
        tags: Array,
    },

}
</script>

<style scoped>

</style>
