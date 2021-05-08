<template>

    <div class="font-sans text-gray-900 antialiased">
        <div class="pt-4">
            <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
                <div v-html="aboutMarkdown" class="w-full sm:max-w-4xl mt-6 p-6 shadow-md overflow-hidden sm:rounded-lg prose dark:prose-dark">
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import AppLayout from "@/Layouts/AppLayout";

export default {
    name: "About",
    layout: AppLayout,

    props: {
        aboutMarkdown: String,
    },

    setup() {
        return {
            //
        }
    },

}
</script>

<style scoped>

</style>
