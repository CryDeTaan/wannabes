<template>
    <div class="flex py-2">
        <a
            :href="`users/${ user.handle }`"
            class="flex flex-1 inline-flex justify-between text-xs text-gray-700 font-medium hover:text-gray-500"
        >
            <span class="flex items-center">
                <img class="h-6 w-6 rounded-full" :src="user.imageUrl" alt="" />
                <span class="ml-2">{{ user.handle }}</span>
            </span>
            <span class="flex items-center">
                <FireIcon class="w-5 h-5 text-gray-400" aria-hidden="true" />
                <span class="ml-2">{{ user.streetCred}}</span>
            </span>
        </a>
    </div>
</template>

<script>
import { UserCircleIcon } from '@heroicons/vue/outline'
import { FireIcon } from '@heroicons/vue/solid'

export default {
    name: "UserBlock",

    components: {
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
