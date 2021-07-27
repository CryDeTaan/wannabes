<template>
    <ul class="space-y-8">
        <li v-for="comment in comments" :key="comment.id">
            <div class="flex space-x-3">
                <div class="flex-shrink-0">
                    <img class="h-10 w-10 rounded-full" :src="comment.user.profile_photo_url" alt="" />
                </div>
                <div class="w-full">
                    <div class="text-sm">
                        <a href="#" class="font-medium text-gray-900 dark:text-dark-300">{{ comment.user.name }}</a>
                    </div>
                    <div v-if="editCommentId !== comment.id">
                        <div class="mt-1 text-sm text-gray-700 dark:text-dark-400">
                            <p>{{ comment.body }}</p>
                        </div>
                        <div class="flex justify-between mt-2 text-sm">
                        <span
                            class="text-gray-500 dark:text-dark-500 font-medium"
                        >{{ getDifferenceInDays(comment.updated_at) }}</span>
                            <div v-if="$page.props.user.id === comment.user_id" class="flex space-x-4 items-center">
                                <button
                                    @click="toggleEditComment(comment)"
                                    class="text-gray-500 hover:text-gray-600 dark:text-dark-500 dark:hover:text-dark-400"
                                >
                                    <PencilAltIcon class="h-4 w-4" aria-hidden="true" />
                                </button>
                                <button
                                    @click="deleteComment(comment.id)"
                                    class="text-gray-500 hover:text-gray-600 dark:text-dark-500 dark:hover:text-dark-400"
                                >
                                    <TrashIcon class="h-4 w-4" aria-hidden="true" />
                                </button>
                            </div>
                        </div>
                    </div>
                    <div v-else>
                        <base-text-area
                            v-model="form.body"
                            label="Comment"
                            :label-src-only="true"
                            id="text"
                            rows="3"
                        />
                        <div class="mt-3 flex justify-end space-x-2">
                            <base-button
                                :secondary="true"
                                @click="toggleEditComment"
                            >
                                Cancel
                            </base-button>
                            <base-button
                                @click="updateComment(comment.id)"
                            >
                                Update
                            </base-button>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</template>

<script>
import {PencilAltIcon, TrashIcon,} from '@heroicons/vue/outline'
import {ref} from "vue";
import BaseButton from "@/Components/UI/BaseButton";
import {useForm} from "@inertiajs/inertia-vue3";

export default {
    name: "CommentList",
    components: {
        BaseButton,
        PencilAltIcon,
        TrashIcon,
    },
    props: {
        comments: Array,
    },
    setup() {
        // This could possibly be improved.
        function getDifferenceInDays(date) {
            const diffInMs = Math.abs(Date.now() - Date.parse(date));
            const diffInDays = (diffInMs / (1000 * 60 * 60 * 24)).toFixed(0);

            if (diffInDays < 1) {
                return 'Today'
            }

            const diffForHumans = new Intl.RelativeTimeFormat('en', {style: 'narrow'});
            return diffForHumans.format(-diffInDays, 'day');
        }

        // Edit/Update comment
        const editCommentId = ref(null);
        function toggleEditComment(comment) {
            if (comment == null) {
                editCommentId.value = null
                form.body = null
                return
            }
            editCommentId.value = comment.id
            form.body = comment.body

        }

        // Get part after last / of the URI, in this case representing the snippet slug.
        // https://stackoverflow.com/a/6165408/15658552
        let snippetSlug = location.pathname.substring(location.pathname.lastIndexOf("/") + 1)

        const form = useForm({
            body: null,
        })

        function updateComment(id) {
            form.put(route('snippets.comments.update', { snippet: snippetSlug, comment:id }), {
                preserveScroll: true,
                onSuccess: () => {
                    form.reset()
                    toggleEditComment(null)
                }
            })
        }

        function deleteComment(id) {
            console.log(id)
        }

        return {
            getDifferenceInDays,
            editCommentId,
            toggleEditComment,
            form,
            updateComment,
            deleteComment,
        }
    }
}
</script>

<style scoped>

</style>
