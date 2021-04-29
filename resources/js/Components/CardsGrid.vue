<template>
    <ul class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3">
        <li
            v-for="snippet in snippets" :key="snippet.slug"
            class="col-span-1 flex flex-col text-center bg-white rounded-lg shadow divide-y divide-gray-200"
        >

            <div class="flex-1 flex flex-col p-4">
                <a href="">
                    <h3 class="text-gray-900 text-sm font-medium">{{ snippet.title }}</h3>
                </a>
                <dl class="mt-1 flex-grow flex flex-col justify-between">
                    <dt class="sr-only">Description</dt>
                    <dd class="text-gray-500 text-sm">{{ snippet.description }}</dd>
                    <dt class="sr-only">Tags</dt>
                    <dd class="flex flex-wrap justify-center place-content-start mt-3">
                        <span v-for="tag in snippet.tags" :key="tag.name"
                              class="m-1 px-2 py-1 text-xs font-medium rounded-full"
                              :class="`text-${tag.color}-800 bg-${tag.color}-100`"
                        >{{ tag.name }}</span>
                    </dd>
                    <dt class="sr-only">Creator</dt>
                    <dd class="mt-4">
                        <div class="flex text-gray-500 text-xs">
                            Added by:
                        </div>
                        <user-block :user="snippet.user" />
                    </dd>
                </dl>
            </div>
            <div>
                <div class="-mt-px flex divide-x divide-gray-200">
                    <div class="w-0 flex-1 flex">
                        <a
                            :href="snippet.slug"
                            class="relative -mr-px w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 font-medium border border-transparent rounded-bl-lg hover:text-gray-500"
                        >
                            <PlusCircleIcon class="w-5 h-5 text-gray-400" aria-hidden="true" />
                            <span class="ml-3">Street Cred</span>
                        </a>
                    </div>
                    <div class="-ml-px w-0 flex-1 flex">
                        <div
                            class="relative w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 font-medium border border-transparent rounded-br-lg"
                        >
                            <FireIcon class="w-5 h-5 text-gray-400" aria-hidden="true" />
                            <span class="ml-3">{{ snippet.likes }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</template>

<script>
import { PlusCircleIcon } from '@heroicons/vue/outline'
import { FireIcon } from '@heroicons/vue/solid'
import UserBlock from "@/Components/UserBlock";

const snippets = [
    {
        slug: 'invoke-mimikatz',
        title: 'Invoke-Mimikatz',
        description: 'Dump Credentials and Secretes',
        tags: [
            {
                'name' : 'PowerShell',
                'color' : 'blue'
            }
        ],
        likes: '192',
        user: {
            handle: 'CryDeTaan',
            streetCred: 123,
            imageUrl:
                'https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
        },
        imageUrl:
            'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60',
    },
    {
        slug: 'minidump-lsass',
        title: 'MiniDump LSASS',
        description: 'Dump LSASS using comsvcs.dll',
        tags: [
            {
                'name' : 'Windows',
                'color' : 'green'
            }
        ],
        likes: '168',
        user: {
            handle: 'CryDeTaan',
            streetCred: 123,
            imageUrl:
                'https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
        },
        imageUrl:
            'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60',
    },
    {
        slug: 'disable-amsi',
        title: 'Disable AMSI',
        description: 'Bypass Antivirus for Powershell',
        tags: [
            {
                'name' : 'Windows',
                'color' : 'green'
            },
            {
                'name' : 'PowerShell',
                'color' : 'blue'
            },
            {
                'name' : 'Lateral Movement',
                'color' : 'pink'
            }
        ],
        likes: '154',
        user: {
            handle: 'CryDeTaan',
            streetCred: 123,
            imageUrl:
                'https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
        },
        imageUrl:
            'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60',
    }, {
        slug: 'invoke-command-session',
        title: 'Invoke-Command $session',
        description: 'Invoke Powershell commands remotely',
        tags: [
            {
                'name' : 'PowerShell',
                'color' : 'blue'
            }
        ],
        user: {
            handle: 'CryDeTaan',
            streetCred: 123,
            imageUrl:
                'https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
        },
        likes: '132',
        imageUrl:
            'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60',
    },
    {
        slug: 'reverse-dynamic-socks-proxy',
        title: 'Reverse Dynamic Socks Proxy',
        description: 'Expose network behind compromised Windows Host',
        tags: [
            {
                'name' : 'SSH',
                'color' : 'red'
            }
        ],
        likes: '116',
        user: {
            handle: 'CryDeTaan',
            streetCred: 123,
            imageUrl:
                'https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
        },
        imageUrl:
            'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60',
    },
    {
        slug: 'impacket-wmi-pth',
        title: 'Impacket WMI PTH',
        description: 'WMI Pass-the-Hash using Impacket',
        tags: [
            {
                'name' : 'Lateral Movement',
                'color' : 'pink'
            }
        ],
        likes: '102',
        user: {
            handle: 'CryDeTaan',
            streetCred: 123,
            imageUrl:
                'https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
        },
        imageUrl:
            'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60',
    },
    {
        slug: 'import-modules-web-client',
        title: 'Import Modules - Web Client',
        description: 'Import Modules using Powershell web client',
        tags: [
            {
                'name' : 'PowerShell',
                'color' : 'blue'
            }
        ],
        likes: '98',
        user: {
            handle: 'CryDeTaan',
            streetCred: 123,
            imageUrl:
                'https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
        },
        imageUrl:
            'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60',
    },
    {
        slug: 'start-team-server',
        title: 'Start Team Server',
        description: 'Start Cobalt Strike Team server with malleable profile ',
        tags: [
            {
                'name' : 'C2C',
                'color' : 'yellow'
            }
        ],
        likes: '87',
        user: {
            handle: 'CryDeTaan',
            streetCred: 123,
            imageUrl:
                'https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
        },
        imageUrl:
            'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60',
    },
    {
        slug: 'invoke-bloodhound',
        title: 'Invoke-Bloodhound',
        description: 'Start Bloodhound Collector using Powershell 1973 in a club, here we go again.',
        tags: [
            {
                'name' : 'PowerShell',
                'color' : 'blue'
            }
        ],
        likes: '85',
        user: {
            handle: 'CryDeTaan',
            streetCred: 123,
            imageUrl:
                'https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
        },
        imageUrl:
            'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60',
    },
    // More snippets...
]

export default {
    name: "CardsGrid",

    components: {
        UserBlock,
        PlusCircleIcon,
        FireIcon,
    },

    setup() {
        return {
            snippets,
        }
    },
}
</script>

<style scoped>

</style>
