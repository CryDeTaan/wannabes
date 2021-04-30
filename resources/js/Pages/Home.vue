<template>
    <app-layout>
        <div class="max-w-3xl mx-auto px-6 md:max-w-7xl md:px-8 md:grid md:grid-cols-12 lg:gap-8">
            <main class="md:col-span-12 lg:col-span-9">
                <cards-grid />
            </main>
            <aside class="hidden lg:block lg:col-span-3">
                <div class="sticky space-y-4">
                    <div class="px-4 pt-2 bg-white rounded-lg shadow">
                        <div class="text-gray-700 text-md font-medium">Leader Board:</div>
                        <div class="grid grid-cols-1 divide-y divide-gray-200">
                            <div v-for="user in leaderBoard">
                                <user-block :user="user" />
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import CardsGrid from "@/Components/CardsGrid";
import UserBlock from "@/Components/UserBlock";

const leaderBoard = [
    {
        handle: 'CryDeTaan',
        streetCred: 123,
        imageUrl:
            'https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
    },
    {
        handle: 'CryDeTaan',
        streetCred: 123,
        imageUrl:
            'https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
    },
    {
        handle: 'CryDeTaan',
        streetCred: 123,
        imageUrl:
            'https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
    },
]

export default {
    components: {
        UserBlock,
        CardsGrid,
        AppLayout,
    },

    setup() {
        return {
            leaderBoard,
        }
    },
}
</script>
