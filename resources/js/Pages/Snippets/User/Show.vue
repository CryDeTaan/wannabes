<template>
    <div class="max-w-3xl mx-auto px-6 md:max-w-7xl md:px-8 md:grid md:grid-cols-12 lg:gap-8">
        <main class="md:col-span-12 lg:col-span-9">
            <cards-grid :snippets="snippets" />
            <div class="mt-6">
                <pagination
                    :next_page="snippets.next_page_url" :prev_page="snippets.prev_page_url" :links="snippets.links"
                />
            </div>
        </main>
        <aside class="hidden lg:block lg:col-span-3">
            <div class="sticky top-6 space-y-4">
                <div class="px-4 py-2 bg-white dark:bg-dark-700 rounded-lg shadow">
                    <div class="space-y-4">
                        <img
                            class="mx-auto h-20 w-20 rounded-full lg:w-24 lg:h-24" :src="user.profile_photo_url" alt=""
                        />
                        <div class="space-y-1 text-align-middle">
                            <h3 class=" flex justify-between text-2xl font-semibold text-neutral-700 dark:text-dark-400 truncate">{{
                                    user.name
                                }}
                            <span class="flex items-center">
                                <FireIcon class="w-7 h-7 text-red-400 dark:text-red-500" aria-hidden="true" />
                                <span class="ml-2">{{ user.streetcred }}</span>
                            </span>
                            </h3>
                            <p class="text-right text-xs font-medium text-neutral-400">Snippets : {{ snippets.total }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
    </div>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import CardsGrid from "@/Components/CardsGrid";
import Pagination from "@/Components/Pagination";
import { FireIcon } from '@heroicons/vue/solid'

export default {
    name: "Show",
    layout: AppLayout,

    components: {
        CardsGrid,
        Pagination,
        FireIcon,
    },

    props: {
        user: {
            type: Object,
        },
        snippets: {
            type: Object,
        },
    },
}
</script>

<style scoped>

</style>
