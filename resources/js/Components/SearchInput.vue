<template>
    <label for="search" class="sr-only">Search</label>
    <div class="relative">
        <div
            class="pointer-events-none absolute inset-y-0 left-0 pl-3 flex items-center"
        >
            <SearchIcon class="h-5 w-5 text-neutral-400" aria-hidden="true" />
        </div>
        <input
            v-model="form.search"
            id="search" name="search"
            class="block w-full bg-white dark:bg-dark-700 border border-neutral-300 dark:border-dark-600 rounded-md py-2 pl-10 pr-3 text-sm placeholder-neutral-500 dark:placeholder-dark-400 dark:text-dark-400 focus:outline-none focus:text-neutral-900 dark:focus:text-neutral-400 focus:placeholder-neutral-400 focus:ring-1 focus:ring-primary-500 focus:border-primary-500 sm:text-sm"
            placeholder="Search"
        />
    </div>
</template>

<script>
import {reactive, inject, watch, ref} from 'vue'
import { Inertia } from '@inertiajs/inertia'
import {SearchIcon} from '@heroicons/vue/solid'
import _ from 'lodash'

export default {
    name: "SearchInput",
    components: {
        SearchIcon
    },

    setup() {
        const form = inject('search')

        watch(form,
            _.throttle(function(value) {
                let query = _.pickBy(value)
                Inertia.get(route('home'),
                    Object.keys(query).length ? query : { remember: 'forget' },
                    {replace: true, preserveState: true, preserveScroll: true })
            }, 150),
            {deep: true }
        )

        return {
            form,
        }
    }
}
</script>

<style scoped>

</style>
