require('./bootstrap');

// Import modules...
import { createApp, h } from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';

// Global components
import BaseButton from '@/Components/UI/BaseButton';
import BaseInput from "@/Components/UI/BaseInput";
import BaseTextArea from "@/Components/UI/BaseTextArea";

const el = document.getElementById('app');

createApp({
    render: () =>
        h(InertiaApp, {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: (name) => require(`./Pages/${name}`).default,
        }),
})
    .mixin({ methods: { route } })
    .use(InertiaPlugin)
    .component('base-button', BaseButton)
    .component('base-input', BaseInput)
    .component('base-text-area', BaseTextArea)
    .mount(el);

InertiaProgress.init({color: '#E11D48' });
