<template>
    <div class="">
        <div class="border-t border-neutral-200 dark:border-dark-500 sm:overflow-hidden">
            <div class="">
                <div class="px-4 py-3 sm:px-6">
                    <h2 id="notes-title" class="text-lg font-medium text-gray-900 dark:text-dark-400">Comments</h2>
                </div>
                <div class="px-4 py-6 sm:px-6">
                    <ul class="space-y-8">
                        <li v-for="comment in comments" :key="comment.id">
                            <div class="flex space-x-3">
                                <div class="flex-shrink-0">
                                    <img class="h-10 w-10 rounded-full" :src="`https://images.unsplash.com/photo-${comment.imageId}?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80`" alt="" />
                                </div>
                                <div>
                                    <div class="text-sm">
                                        <a href="#" class="font-medium text-gray-900 dark:text-dark-300">{{ comment.name }}</a>
                                    </div>
                                    <div class="mt-1 text-sm text-gray-700 dark:text-dark-400">
                                        <p>{{ comment.body }}</p>
                                    </div>
                                    <div class="mt-2 text-sm space-x-2">
                                        <span class="text-gray-500 dark:text-dark-500 font-medium">{{ comment.date }}</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="px-4 py-6 sm:px-6">
                <div class="flex space-x-3">
                    <div class="flex-shrink-0">
                        <img class="h-10 w-10 rounded-full" :src="user.imageUrl" alt="" />
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

const user = {
    name: 'Whitney Francis',
    email: 'whitney@example.com',
    imageUrl:
        'https://images.unsplash.com/photo-1517365830460-955ce3ccd263?ixlib=rb-=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=8&w=256&h=256&q=80',
}
const comments = [
    {
        id: 1,
        name: 'Leslie Alexander',
        date: '4d ago',
        imageId: '1494790108377-be9c29b29330',
        body:
            'Ducimus quas delectus ad maxime totam doloribus reiciendis ex. Tempore dolorem maiores. Similique voluptatibus tempore non ut.',
    },
    {
        id: 2,
        name: 'Michael Foster',
        date: '4d ago',
        imageId: '1519244703995-f4e0f30006d5',
        body:
            'Et ut autem. Voluptatem eum dolores sint necessitatibus quos. Quis eum qui dolorem accusantium voluptas voluptatem ipsum. Quo facere iusto quia accusamus veniam id explicabo et aut.',
    },
    {
        id: 3,
        name: 'Dries Vincent',
        date: '4d ago',
        imageId: '1506794778202-cad84cf45f1d',
        body:
            'Expedita consequatur sit ea voluptas quo ipsam recusandae. Ab sint et voluptatem repudiandae voluptatem et eveniet. Nihil quas consequatur autem. Perferendis rerum et.',
    },
]

export default {
    name: "CommentLayout",
    components: {
        BaseTextArea,
        QuestionMarkCircleIcon,
        BaseButton
    },

    setup() {
        return {
            user,
            comments,
        }
    }
}
</script>

<style scoped>

</style>
