<template>
    <div class="min-h-screen bg-neutral-100 dark:bg-dark-800">

        <Popover as="template" v-slot="{ open }">
            <header
                :class="[open ? 'fixed inset-0 z-40 overflow-y-auto' : '', 'bg-white dark:bg-dark-800 shadow-sm lg:static lg:overflow-y-visible']"
            >
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="relative flex justify-between xl:grid xl:grid-cols-12 lg:gap-8">
                        <div class="flex md:absolute md:left-0 md:inset-y-0 lg:static xl:col-span-2">
                            <div class="flex-shrink-0 flex items-center">
                                <inertia-link :href="route('home')">
                                    <CubeTransparentIcon class="h-12 w-12 text-primary-600" aria-hidden="true" />
                                </inertia-link>
                            </div>
                        </div>
                        <div class="min-w-0 flex-1 md:px-8 lg:px-0 xl:col-span-5">
                            <div
                                class="flex items-center px-6 py-4 md:max-w-3xl md:mx-auto lg:max-w-none lg:mx-0 xl:px-0"
                            >
                                <div class="w-full">
                                    <search-input />
                                </div>
                            </div>
                        </div>
                        <div class="hidden lg:flex lg:items-center xl:col-span-1">
                            <div
                                class="flex items-center py-4 md:max-w-3xl md:mx-auto lg:max-w-none lg:mx-0 xl:px-0"
                            >
                                <inertia-link
                                    :href="route('about')"
                                    class="flex-shrink-0 bg-white dark:bg-dark-800 rounded-full text-neutral-400 hover:text-neutral-500 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:ring-primary-500"
                                >
                                    <span class="sr-only">Help</span>
                                    <QuestionMarkCircleIcon class="h-6 w-6" aria-hidden="true" />
                                </inertia-link>
                            </div>
                        </div>
                        <div class="flex items-center md:absolute md:right-0 md:inset-y-0 lg:hidden">
                            <!-- Mobile menu button -->
                            <PopoverButton
                                class="-mx-2 rounded-md p-2 inline-flex items-center justify-center text-neutral-400 dark:bg-dark-800 hover:bg-neutral-100 dark:hover:bg-dark-700 hover:text-neutral-500 dark:hover:text-dark-400 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary-500"
                            >
                                <span class="sr-only">Open menu</span>
                                <MenuIcon v-if="!open" class="block h-6 w-6" aria-hidden="true" />
                                <XIcon v-else class="block h-6 w-6" aria-hidden="true" />
                            </PopoverButton>
                        </div>
                        <div class="hidden lg:flex lg:items-center lg:justify-end xl:col-span-4">
                            <base-button as="link" :href="route('snippets.create')">
                                New Snippet
                            </base-button>
                            <!--
                             Once notifications are ready I will add this again
                            <a
                                href="#"
                                class="ml-5 flex-shrink-0 bg-white dark:bg-dark-800 rounded-full p-1 text-neutral-400 hover:text-neutral-500 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:ring-primary-500"
                            >
                                <span class="sr-only">View notifications</span>
                                <BellIcon class="h-6 w-6" aria-hidden="true" />
                            </a>
                            -->

                            <!-- Profile dropdown -->
                            <Menu as="div" class="flex-shrink-0 relative ml-5">
                                <div>
                                    <MenuButton
                                        class="bg-white dark:bg-dark-800 rounded-full flex focus:outline-none focus:ring-2 focus:ring-offset-0 focus:ring-primary-500"
                                    >
                                        <span class="sr-only">Open user menu</span>
                                        <img
                                            v-if="$page.props.user && $page.props.user.email" class="h-8 w-8 rounded-full"
                                            :src="$page.props.user.profile_photo_url" alt=""
                                        />
                                        <UserCircleIcon
                                            v-else class="h-9 w-9 text-neutral-500 hover:text-neutral-600"
                                            aria-hidden="true"
                                        />
                                    </MenuButton>
                                </div>
                                <transition
                                    enter-active-class="transition ease-out duration-100"
                                    enter-from-class="transform opacity-0 scale-95"
                                    enter-to-class="transform opacity-100 scale-100"
                                    leave-active-class="transition ease-in duration-75"
                                    leave-from-class="transform opacity-100 scale-100"
                                    leave-to-class="transform opacity-0 scale-95"
                                >
                                    <MenuItems
                                        class="origin-top-right absolute z-10 right-0 mt-2 w-48 rounded-md shadow-lg bg-white dark:bg-dark-700 dark:text-dark-400 ring-1 ring-black ring-opacity-5 py-1 focus:outline-none">
                                        <MenuItem v-slot="{ active }">
                                            <button @click="toggleDarkMode" type="button" :class="[active ? 'bg-neutral-100 dark:bg-dark-600' : '', 'w-full group flex items-center px-4 py-2 text-sm text-neutral-700 dark:text-dark-300 focus:outline-none']">
                                                <SunIcon v-if="theme === 'light'" class="mr-3 h-5 w-5 text-neutral-700" aria-hidden="true" />
                                                <MoonIcon v-else class="mr-3 h-5 w-5 dark:text-dark-400" aria-hidden="true" />
                                                Mode
                                            </button>
                                        </MenuItem>
                                        <template v-if="$page.props.user">
                                            <MenuItem
                                                v-for="item in userNavigation" :key="item.name" v-slot="{ active }"
                                            >
                                                <inertia-link
                                                    :href="item.href"
                                                    :method="item.method ? item.method : 'GET'"
                                                    as="button"
                                                    :class="[active ? 'bg-neutral-100 dark:bg-dark-600' : '', 'w-full block py-2 px-4 text-left text-sm text-neutral-700 dark:text-dark-300 focus:outline-none']"
                                                >{{ item.name }}
                                                </inertia-link>
                                            </MenuItem>
                                        </template>
                                        <template v-else>
                                            <MenuItem v-for="item in notAuthed" :key="item.name" v-slot="{ active }">
                                                <inertia-link
                                                    :href="item.href"
                                                    :method="item.method ? item.method : 'GET'"
                                                    as="button"
                                                    :class="[active ? 'bg-neutral-100 dark:bg-dark-600' : '', 'w-full block py-2 px-4 text-left text-sm text-neutral-700 dark:text-dark-300 focus:outline-none']"
                                                >{{ item.name }}
                                                </inertia-link>
                                            </MenuItem>
                                        </template>
                                    </MenuItems>
                                </transition>
                            </Menu>

                        </div>
                    </div>
                </div>

                <PopoverPanel as="nav" class="lg:hidden" aria-label="Global">
                    <div class="max-w-3xl mx-auto px-2 pt-2 pb-3 space-y-1 sm:px-4">
                        <a
                            v-for="item in navigation" :key="item.name" :href="item.href"
                            :aria-current="item.current ? 'page' : undefined"
                            :class="[item.current ? 'bg-neutral-100 dark:bg-dark-700 text-neutral-900 dark:text-dark-300' : 'hover:bg-neutral-50 dark:hover:bg-dark-600 dark:text-dark-400', 'block rounded-md py-2 px-3 text-base font-medium']"
                        >{{ item.name }}</a>
                        <button @click="toggleDarkMode" :class="[active ? 'bg-neutral-100 dark:bg-dark-700 text-neutral-900 dark:text-dark-300' : 'hover:bg-neutral-50 dark:hover:bg-dark-600 dark:text-dark-400', 'w-full group flex items-center block rounded-md py-2 px-3 text-base font-medium focus:outline-none']">
                            <SunIcon v-if="theme === 'light'" class="mr-3 h-5 w-5 group-hover:text-neutral-900" aria-hidden="true" />
                            <MoonIcon v-else class="mr-3 h-5 w-5 dark:group-hover:text-dark-400" aria-hidden="true" />
                            Mode
                        </button>
                    </div>
                    <div v-if="$page.props.user" class="border-t border-neutral-300 pt-4 pb-3">
                        <div class="max-w-3xl mx-auto px-4 flex items-center sm:px-6">
                            <div class="flex-shrink-0">
                                <img class="h-10 w-10 rounded-full" :src="$page.props.user.profile_photo_url" alt="" />
                            </div>
                            <div class="ml-3">
                                <div class="text-base font-medium text-neutral-800 dark:text-dark-400">{{ $page.props.user.name }}</div>
                                <div class="text-sm font-medium text-neutral-500 dark:text-dark-300">{{ $page.props.user.email }}</div>
                            </div>
                            <!--
                            Once notifications are ready I will add this again
                            <button
                                type="button"
                                class="ml-auto flex-shrink-0 bg-white dark:bg-dark-800 rounded-full p-1 text-neutral-400 hover:text-neutral-500 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:ring-primary-500"
                            >
                                <span class="sr-only">View notifications</span>
                                <BellIcon class="h-6 w-6" aria-hidden="true" />
                            </button>
                            -->
                        </div>
                        <div class="mt-3 max-w-3xl mx-auto px-2 space-y-1 sm:px-4">
                            <inertia-link
                                v-for="item in userNavigation" :key="item.name" :href="item.href"
                                :method="item.method ? item.method : 'GET'"
                                as="span"
                                class="block rounded-md py-2 px-3 text-base font-medium text-neutral-500 hover:bg-neutral-50 dark:hover:bg-dark-600 hover:text-neutral-900 dark:hover:text-dark-400"
                            >{{ item.name }}</inertia-link>
                        </div>
                    </div>
                    <div v-else class="border-t border-neutral-300 pt-4 pb-3">
                        <div class="mt-3 max-w-3xl mx-auto px-2 space-y-1 sm:px-4">
                            <inertia-link
                                :href="route('login')"
                                class="block rounded-md py-2 px-3 text-base font-medium text-neutral-500 hover:bg-neutral-50 dark:hover:bg-dark-600 hover:text-neutral-900 dark:hover:text-dark-400"
                            >Login</inertia-link>
                            <inertia-link
                                :href="route('register')"
                                class="block rounded-md py-2 px-3 text-base font-medium text-neutral-500 hover:bg-neutral-50 dark:hover:bg-dark-600 hover:text-neutral-900 dark:hover:text-dark-400"
                            >Register</inertia-link>
                        </div>
                    </div>
                </PopoverPanel>
            </header>
        </Popover>
        <div class="py-6">
            <slot></slot>
        </div>
    </div>
</template>

<script>
import {Menu, MenuButton, MenuItem, MenuItems, Popover, PopoverButton, PopoverPanel} from '@headlessui/vue'
import {QuestionMarkCircleIcon} from '@heroicons/vue/solid'
import {BellIcon, CubeTransparentIcon, MenuIcon, MoonIcon, SunIcon, UserCircleIcon, XIcon} from '@heroicons/vue/outline'
import SearchInput from "@/Components/SearchInput";
import {ref} from "vue";

const navigation = [
    {name: 'New Snippet', href: '/snippets/create', current: false},
    // TODO: Add this if useful.
    // {name: 'Leaderboard', href: '#', current: false},
    {name: 'About', href: '/about', current: false},
]
const userNavigation = [
    {name: 'Your Profile', href: '/user/profile'},
    {name: 'Sign out', href: '/logout', method: 'post'},
]

const notAuthed = [
    {name: 'Login', href: '/login'},
    {name: 'Register', href: '/register'},
]

export default {
    components: {
        SearchInput,
        Menu,
        MenuButton,
        MenuItem,
        MenuItems,
        Popover,
        PopoverButton,
        PopoverPanel,
        BellIcon,
        MenuIcon,
        XIcon,
        CubeTransparentIcon,
        QuestionMarkCircleIcon,
        UserCircleIcon,
        MoonIcon,
        SunIcon,
    },

    setup() {
        const theme = ref('')

        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
            localStorage.theme = 'dark'
            theme.value = 'dark'
        } else {
            document.documentElement.classList.remove('dark')
            localStorage.theme = 'light'
            theme.value = 'light'
        }

        const toggleDarkMode = function () {
            if (localStorage.theme === 'dark' ) {
                document.documentElement.classList.remove('dark')
                localStorage.theme = 'light'
                theme.value = 'light'
            } else {
                document.documentElement.classList.add('dark')
                localStorage.theme = 'dark'
                theme.value = 'dark'
            }
        }

        return {
            navigation,
            userNavigation,
            notAuthed,
            theme,
            toggleDarkMode,
        }
    },
}
</script>
