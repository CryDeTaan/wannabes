<template>
    <Listbox as="div" v-model="selected">
        <ListboxLabel class="block text-sm font-medium text-gray-700 dark:text-dark-400">
            Tags
        </ListboxLabel>
        <div class="mt-1 relative">
            <ListboxButton
                class="relative w-full bg-white dark:bg-dark-700 dark:text-dark-400 border border-gray-300 dark:border-dark-600 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-primary-500 focus:border-primary-500 sm:text-sm"
            >
                <span class="block truncate">{{ selected.name }}</span>
                <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
          <SelectorIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
        </span>
            </ListboxButton>

            <transition
                leave-active-class="transition ease-in duration-100" leave-from-class="opacity-100"
                leave-to-class="opacity-0"
            >
                <ListboxOptions
                    class="absolute z-10 mt-1 w-full bg-white dark:bg-dark-700 dark:text-dark-400 border border-gray-300 dark:border-dark-600 shadow-lg max-h-60 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm"
                >
                    <ListboxOption
                        as="template" v-for="tag in tags" :key="tag.id" :value="tag"
                        v-slot="{ active, selected }"
                    >
                        <li :class="[active ? 'text-white dark:text-dark-200 bg-primary-600' : 'text-gray-900 dark:text-dark-400', 'cursor-default select-none relative py-2 pl-8 pr-4']">
                            <span :class="[selected ? 'font-semibold' : 'font-normal', 'block truncate']">
                                {{ tag.name }}
                            </span>
                            <span
                                v-if="selected"
                                :class="[active ? 'text-white' : 'text-primary-600', 'absolute inset-y-0 left-0 flex items-center pl-1.5']"
                            >
                                <CheckIcon class="h-5 w-5" aria-hidden="true" />
                            </span>
                        </li>
                    </ListboxOption>
                </ListboxOptions>
            </transition>
        </div>
    </Listbox>
</template>

<script>
import {ref, watch} from 'vue'
import { Listbox, ListboxButton, ListboxLabel, ListboxOption, ListboxOptions } from '@headlessui/vue'
import { CheckIcon, SelectorIcon } from '@heroicons/vue/solid'

const tags = [
    {id: 0, name: 'Select a tag....'},
    {id: 1, name: 'PowerShell'},
    {id: 2, name: 'SSH'},
    {id: 3, name: 'Lateral Movement'},
    {id: 4, name: 'C2'},
    {id: 5, name: 'Windows'},
]

export default {
    name: "TagSelect",

    components: {
        Listbox,
        ListboxButton,
        ListboxLabel,
        ListboxOption,
        ListboxOptions,
        CheckIcon,
        SelectorIcon,
    },

    setup() {
        const selected = ref(tags[0])

        watch(
            () => selected.value,
            () => {
                console.log(selected.value)
            }
        )

        return {
            tags,
            selected,
        }
    },
}
</script>

<style scoped>

</style>
