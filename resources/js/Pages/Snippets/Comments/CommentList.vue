<template>
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
                    <div class="flex justify-between mt-2 text-sm">
                        <span
                            class="text-gray-500 dark:text-dark-500 font-medium"
                        >{{ getDifferenceInDays(comment.updated_at) }}</span>
                        <div v-if="$page.props.user.id === comment.user_id" class="flex space-x-4 items-center">
                            <button
                                class="text-gray-500 hover:text-gray-600 dark:text-dark-500 dark:hover:text-dark-400"
                            >
                                <PencilAltIcon class="h-4 w-4" aria-hidden="true" />
                            </button>
                            <button
                                class="text-gray-500 hover:text-gray-600 dark:text-dark-500 dark:hover:text-dark-400"
                            >
                                <TrashIcon class="h-4 w-4" aria-hidden="true" />
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </li>
    </ul>
</template>

<script>
import {PencilAltIcon, TrashIcon,} from '@heroicons/vue/outline'

export default {
    name: "CommentList",
    components: {
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

        return {
            getDifferenceInDays,
        }
    }
}
</script>

<style scoped>

</style>
