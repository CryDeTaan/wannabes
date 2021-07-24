<template>
    <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
        <div class="sm:col-span-3">
            <base-input
                v-model="form.title"
                label="Title"
                id="title"
                :error="form.errors.title"
            />
        </div>

        <div class="sm:col-span-3">
            <!--<tag-select />-->
            <div>
                <label for="tags" class="block text-sm font-medium text-gray-700 dark:text-dark-400">Tags</label>
                <select
                    id="tags" name="tags" @change="addTag"
                    class="mt-1 block w-full pl-3 pr-10 py-2 shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm border-gray-300 dark:border-dark-600 dark:bg-dark-700 rounded-md dark:text-dark-300 dark:focus:text-neutral-300"
                >
                    <option selected>Select tags...</option>
                    <option
                        v-for="tag in tags" :key="tag.slug" :value="tag.slug"
                    >{{ tag.name }}
                    </option>
                </select>
            </div>
        </div>
        <div class="sm:col-span-6">
            <base-input
                v-model="form.excerpt"
                label="Excerpt"
                id="excerpt"
                :error="form.errors.excerpt"
            />
        </div>
        <div class="sm:col-span-6">
            <base-text-area
                v-model="form.markdown"
                label="Snippet"
                id="snippet"
                rows="35"
                :error="form.errors.markdown"
            />
            <p v-if="!form.errors.markdown" class="mt-2 text-sm text-gray-500 dark:text-dark-400">Write
                your snippet in markdown.</p>
        </div>
    </div>

</template>

<script>

export default {
    name: "SnippetForm",

    props: {
        form: {
            type: Object,
            required: true
        },
        tags: {
            type: Object,
            required: true
        }
    },

    setup(props){
        function addTag(event) {
            const index = props.tags.findIndex((tag) => tag.slug === event.target.value);
            const selectedTag = props.tags.splice(index, 1);

            props.form.tags.push(selectedTag[0])
        }

        return {
            addTag,
        }

    }

}
</script>

<style scoped>

</style>
