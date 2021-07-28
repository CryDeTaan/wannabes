--
Usage:
<base-text-area
    v-model="form.text"
    label="Text Area"
    :label-src-only="true"
    id="text"
    rows="30"
    :error="errors.text"
    :placeholder="placeholder"
/>
--
<template>
    <div>
        <label
            :for="id"
            class="block text-sm font-medium text-gray-700 dark:text-dark-400"
            :class="labelSrcOnly ? 'sr-only' : ''"
        >
            {{ label }}
        </label>
        <div class="mt-1 relative rounded-md shadow-sm">
            <textarea
                :id="id"
                :name="id"
                :rows="rows"
                @input="$emit('update:modelValue', $event.target.value)"
                :value="modelValue"
                :class="inputClasses"
                :placeholder="placeholder"
            />
            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                <ExclamationCircleIcon v-if="error" class="h-5 w-5 text-red-600" aria-hidden="true" />
            </div>
        </div>
        <p v-if="error" class="mt-2 text-sm text-red-600" id="markdown-error">{{
                error
            }}</p>
    </div>
</template>

<script>
import {ExclamationCircleIcon} from '@heroicons/vue/solid'
import {computed} from "vue";

export default {
    name: "BaseTextArea",

    components: {
        ExclamationCircleIcon,
    },
    emits: ['update:modelValue'],

    props: {
        modelValue: {
            type: String,
        },
        label: {
            type: String,
            required: true,
        },
        labelSrcOnly: {
            type: Boolean,
            default: false
        },
        id: {
            type: String,
            required: true,
        },
        error: {
            type: String,
            default: null,
        },
        rows: {
            type: String,
            default: 15,
        },
        placeholder: {
            type: String,
            required: false,
        }
    },

    setup(props) {
        const inputClasses = computed(function () {
            let inputClasses = "block w-full pr-10 rounded-md shadow-sm sm:text-base dark:bg-dark-700 dark:text-dark-300 "

            if (!props.error) {
                inputClasses += "border-gray-300 dark:border-dark-600 " +
                    "focus:ring-primary-500 focus:border-primary-500 dark:focus:text-neutral-300"
            } else {
                inputClasses += "border-red-300 dark:border-red-600 dark:bg-dark-700 " +
                    "focus:outline-none focus:ring-red-500 focus:border-red-500"
            }

            return inputClasses
        })

        return {
            inputClasses,
        }

    },
}
</script>

<style scoped>

</style>
