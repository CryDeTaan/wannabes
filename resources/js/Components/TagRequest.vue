<template>
    <p class="block mt-3 text-sm font-medium text-gray-700 dark:text-dark-400">Suggest a tag:</p>
    <div class="flex items-center">
        <base-input
            label=""
            v-model="form.name"
            id="tag"
            type="text"
        />
        <base-button @click="submitTagRequest" :secondary="true" class="ml-2 mt-1">Submit</base-button>
    </div>
    <p v-if="form.errors.name" class="mt-2 text-sm text-red-600" id="error`">{{ form.errors.name }}</p>
</template>

<script>
import {useForm} from "@inertiajs/inertia-vue3";

export default {
    name: "TagRequest",

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
