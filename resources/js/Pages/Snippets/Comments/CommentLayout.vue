<template>
    <div class="">
        <div class="border-t border-neutral-200 dark:border-dark-500 sm:overflow-hidden">
            <div class="">
                <div class="px-4 py-3 sm:px-6">
                    <h2 id="notes-title" class="text-lg font-medium text-gray-900 dark:text-dark-400">Comments</h2>
                </div>
                <div v-if="comments.length" class="px-4 py-6 sm:px-6">
                    <ul class="space-y-8">
                        <li v-for="comment in comments" :key="comment.id">
                            <div class="flex space-x-3">
                                <div class="flex-shrink-0">
                                    <img class="h-10 w-10 rounded-full" :src="comment.user.profile_photo_url" alt="" />
                                </div>
                                <div>
                                    <div class="text-sm">
                                        <a href="#" class="font-medium text-gray-900 dark:text-dark-300">{{ comment.user.name }}</a>
                                    </div>
                                    <div class="mt-1 text-sm text-gray-700 dark:text-dark-400">
                                        <p>{{ comment.body }}</p>
                                    </div>
                                    <div class="mt-2 text-sm space-x-2">
                                        <span class="text-gray-500 dark:text-dark-500 font-medium">{{ getDifferenceInDays(comment.updated_at) }}</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <p v-else class="px-4 py-2 sm:px-6 text-center font-medium text-gray-900 dark:text-dark-400">Be the first to comment...</p>
            </div>
            <div class="px-4 py-6 sm:px-6">
                <div class="flex space-x-3">
                    <div class="flex-shrink-0">
                        <img class="h-10 w-10 rounded-full" :src="$page.props.user.profile_photo_url" alt="" />
                    </div>
                    <div class="min-w-0 flex-1">
                        <form action="#">
                            <div>
                                <base-text-area
                                    label="Comment"
                                    :label-src-only="true"
                                    id="text"
                                    rows="3"
                                    placeholder="Add a comment"
                                />
                            </div>
                            <div class="mt-3 flex justify-end">
                                <base-button>Comment</base-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { QuestionMarkCircleIcon } from '@heroicons/vue/solid'
import BaseButton from "@/Components/UI/BaseButton";
import BaseTextArea from "@/Components/UI/BaseTextArea";
import {computed} from "vue";

export default {
    name: "CommentLayout",
    components: {
        BaseTextArea,
        QuestionMarkCircleIcon,
        BaseButton
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

            const diffForHumans = new Intl.RelativeTimeFormat('en', { style: 'narrow' });
            return diffForHumans.format(-diffInDays, 'day');
        }

        return {
            getDifferenceInDays,
        }
    }
}
</script>

<style scoped>

</style>
