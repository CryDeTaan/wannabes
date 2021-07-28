<template>
    <div class="px-4 py-6 sm:px-6">
        <div class="flex space-x-3">
            <div class="flex-shrink-0">
                <img class="h-10 w-10 rounded-full" :src="$page.props.user.profile_photo_url" alt="" />
            </div>
            <div class="min-w-0 flex-1">
                <div>
                    <base-text-area
                        v-model="form.body"
                        label="Comment"
                        :label-src-only="true"
                        id="text"
                        rows="3"
                        placeholder="Add a comment"
                    />
                </div>
                <div class="mt-3 flex justify-end">
                    <base-button @click="submitForm">Comment</base-button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { useForm } from "@inertiajs/inertia-vue3";

export default {
    name: "CreateComment",

    setup() {

        // Get part after last / of the URI, in this case representing the snippet slug.
        // https://stackoverflow.com/a/6165408/15658552
        let snippetSlug = location.pathname.substring(location.pathname.lastIndexOf("/") + 1)

        const form = useForm({
            body: null,
        })

        function submitForm() {
            form.post(route('snippets.comments.store', { snippet: snippetSlug }), {
                preserveScroll: true,
                onSuccess: () => form.reset(),
            })
        }

        return {
            form,
            submitForm,
        }
    }
}
</script>

<style scoped>

</style>
