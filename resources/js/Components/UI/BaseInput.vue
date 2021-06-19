-- Meta --
Based of Input with validation error
https://tailwindui.com/components/application-ui/forms/input-groups#component-7a5297f99a5ed22df80939dd1986de5f
Usage:
    <base-input
        v-model="form.email"
        label="Email Address"
        id="email"
        type="email"
        :error="errors.email"
    />
--

<template>
    <div>
        <label :for="id" class="block text-sm font-medium text-gray-700 dark:text-dark-400">
            {{ label }}
        </label>
        <div class="mt-1 relative rounded-md shadow-sm">
            <input :type="type"
                   @input="$emit('update:modelValue', $event.target.value)"
                   :value="modelValue"
                   :name="id"
                   :id="id"
                   :class="inputClasses"
                   aria-invalid="true" :aria-describedby="id"
                   :ref="id"
            />
            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                <ExclamationCircleIcon v-if="error" class="h-5 w-5 text-red-600" aria-hidden="true" />
            </div>
        </div>
        <p v-if="error" class="mt-2 text-sm text-red-600" :id="`${id}-error`">{{ error }}</p>
    </div>
</template>

<script>
import { ExclamationCircleIcon } from '@heroicons/vue/solid'
import { computed } from "vue";

export default {
    name: "BaseInput",
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
        id: {
            type: String,
            required: true,
        },
        type: {
            type: String,
            default: 'text'
        },
        error: {
            type: String,
            default: null,
        }
    },

    setup(props) {
        const inputClasses = computed(function() {
            let inputClasses = "block w-full rounded-md shadow-sm sm:text-sm dark:bg-dark-700 dark:text-dark-300 "

            if (!props.error) {
                inputClasses += "border-gray-300 dark:border-dark-600 " +
                    "focus:ring-primary-500 focus:border-primary-500 dark:focus:text-neutral-300"
            } else {
                inputClasses += "pr-10 border-red-300 dark:border-red-600 dark:bg-dark-700 " +
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
