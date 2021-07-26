<template>
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
</template>

<script>
export default {
    name: "CreateComment"
}
</script>

<style scoped>

</style>
