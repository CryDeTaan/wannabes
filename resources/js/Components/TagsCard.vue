<template>
    <div class="text-gray-700 dark:text-dark-400 text-md font-medium">Tags:</div>
    <ul v-if="tags" class="mt-2 leading-8">
        <li class="inline">
            <base-tag
                v-for="tag in tags" :key="tag" :tag="tag"
            />
        </li>
    </ul>
    <p class="block mt-3 text-sm font-medium text-gray-700 dark:text-dark-400">Suggest a tag:</p>
    <div class="flex items-center">
        <base-input
            label=""
            v-model="form.name"
            id="tag"
            type="text"
        />
        <base-button @click="submitTagRequest" class="ml-2 mt-1">submit</base-button>
    </div>
    <p v-if="form.errors.name" class="mt-2 text-sm text-red-600" id="error`">{{ form.errors.name }}</p>
</template>

<script>
import {useForm} from "@inertiajs/inertia-vue3";
import BaseTag from "@/Components/BaseTag";

export default {
    name: "TagsCard",
    components: {BaseTag},
    props: {
        tags: Array,
    },

    setup() {
        const form = useForm({
            name: null,
        })

        function submitTagRequest() {
            form.post(route('tags.request'), {
                preserveScroll: true,
                onSuccess: () => form.reset('name'),
            })
        }

        return {
            form,
            submitTagRequest,
        }
    },
}
</script>

<style scoped>

</style>
