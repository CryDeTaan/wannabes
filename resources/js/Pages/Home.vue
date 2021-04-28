<template>
    <app-layout>
        <div class="max-w-3xl mx-auto px-6 md:max-w-7xl md:px-8 md:grid md:grid-cols-12 lg:gap-8">
            <main class="md:col-span-12 lg:col-span-9">
                <div>
                    Cards
                </div>
            </main>
            <aside class="hidden lg:block lg:col-span-3">
                <div class="sticky space-y-4">
                    <div class="px-4 pt-2 bg-white rounded-lg shadow">
                        <div class="text-gray-700 text-md font-medium">Leader Board:</div>
                        <div class="grid grid-cols-1 divide-y divide-gray-200">
                            Users
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'

export default {
    components: {
        AppLayout,
    },
}
</script>
