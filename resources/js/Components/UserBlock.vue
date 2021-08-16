<template>
    <div class="flex py-2">
        <Link
            :href="`/users/${ user.name }`"
            class="flex flex-1 inline-flex justify-between text-xs text-gray-700 dark:text-dark-400 font-medium hover:text-gray-500 dark:hover:text-dark-300"
        >
            <span class="flex items-center">
                <img class="h-6 w-6 rounded-full" :src="user.profile_photo_url" alt="" />
                <span class="ml-2">{{ user.name }}</span>
            </span>
            <span class="flex items-center">
                <FireIcon class="w-5 h-5 text-gray-400 dark:text-dark-500" aria-hidden="true" />
                <span class="ml-2">{{ user.streetcred }}</span>
            </span>
        </Link>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'
import { UserCircleIcon } from '@heroicons/vue/outline'
import { FireIcon } from '@heroicons/vue/solid'

export default {
    name: "UserBlock",

    components: {
        Link,
        UserCircleIcon,
        FireIcon,
    },

    props: {
        user: Object,
    },

    setup(props) {
        const user = props.user
        return {
            user
        }
    },
}
</script>

<style scoped>

</style>
