<!--
    To use this component include it like this
    <template>
        ....
        <over-lay :showOverlay="showOverlay" @close="showOverlay = false"/>
        ....
    </template>

    <script>
    import OverLay from "@/Components/OverLay";
    import {ref} from "vue";

    export default {
        setup() {
            const showOverlay = ref(false)

            return {
                showOverlay,
            },
    </script>
 -->
<template>
    <TransitionRoot as="template" :show="open">
        <Dialog as="section" static class="fixed inset-0 overflow-hidden" @close="close" :open="open">
            <div class="absolute inset-0 overflow-hidden">
                <DialogOverlay class="absolute inset-0" />

                <div class="fixed inset-y-0 right-0 pl-10 max-w-full flex sm:pl-16">
                    <TransitionChild as="template" enter="transform transition ease-in-out duration-500 sm:duration-700" enter-from="translate-x-full" enter-to="translate-x-0" leave="transform transition ease-in-out duration-500 sm:duration-700" leave-from="translate-x-0" leave-to="translate-x-full">
                        <div class="w-screen max-w-7xl">
                            <div class="h-full flex flex-col py-6 bg-white shadow-xl overflow-y-scroll">
                                <div class="px-4 sm:px-6">
                                    <div class="flex items-start justify-between">
                                        <DialogTitle class="text-lg font-medium text-gray-900">
                                            Panel title
                                        </DialogTitle>
                                        <div class="ml-3 h-7 flex items-center">
                                            <button class="bg-white rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" @click="close">
                                                <span class="sr-only">Close panel</span>
                                                <XIcon class="h-6 w-6" aria-hidden="true" />
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-6 relative flex-1 px-4 sm:px-6">
                                    <!-- Replace with your content -->
                                    <div class="absolute inset-0 px-4 sm:px-6">
                                        <div class="h-full border-2 border-dashed border-gray-200" aria-hidden="true" />
                                    </div>
                                    <!-- /End replace -->
                                </div>
                            </div>
                        </div>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script>
import { ref, watchEffect  } from 'vue'
import { Dialog, DialogOverlay, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { XIcon } from '@heroicons/vue/outline'

export default {
    components: {
        Dialog,
        DialogOverlay,
        DialogTitle,
        TransitionChild,
        TransitionRoot,
        XIcon,
    },

    props: {
        showOverlay: Boolean,
    },

    setup(props, { emit }) {
        const open = ref(false)

        watchEffect(showOverlay => {
            open.value = props.showOverlay
        })

        const close = () => {
            open.value = false
            emit('close')
        }

        return {
            open,
            close,
        }
    },
}
</script>
