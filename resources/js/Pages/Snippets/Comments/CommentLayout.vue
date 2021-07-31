<template>
    <div class="">
        <div class="border-t border-neutral-200 dark:border-dark-500 sm:overflow-hidden">
            <div class="">
                <div class="px-4 py-3 sm:px-6">
                    <h2 id="notes-title" class="text-lg font-medium text-gray-900 dark:text-dark-400">Comments</h2>
                </div>
                <div v-if="comments.length" class="px-4 py-6 sm:px-6">
                    <comment-list :comments="comments"/>
                </div>
                <p v-else class="px-4 py-2 sm:px-6 text-center font-medium text-gray-900 dark:text-dark-400">Be the first to comment...</p>
            </div>
            <comment-create />
        </div>
    </div>
</template>

<script>
import { QuestionMarkCircleIcon } from '@heroicons/vue/solid'
import BaseButton from "@/Components/UI/BaseButton";
import BaseTextArea from "@/Components/UI/BaseTextArea";
import CommentCreate from "@/Pages/Snippets/Comments/CommentCreate";
import CommentList from "@/Pages/Snippets/Comments/CommentList";

export default {
    name: "CommentLayout",
    components: {
        CommentList,
        CommentCreate,
        BaseTextArea,
        QuestionMarkCircleIcon,
        BaseButton
    },

    props: {
        comments: Array,
    },

}
</script>

<style scoped>

</style>
