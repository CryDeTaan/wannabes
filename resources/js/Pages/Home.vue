<template>
    <app-layout>
        <div class="max-w-3xl mx-auto px-6 md:max-w-7xl md:px-8 md:grid md:grid-cols-12 lg:gap-8">
            <main class="md:col-span-12 lg:col-span-9">
                <cards-grid :snippets="snippets"/>
                <div class="mt-6">
                    <pagination />
                </div>
            </main>
            <aside class="hidden lg:block lg:col-span-3">
                <div class="sticky top-6 space-y-4">
                    <div class="px-4 pt-2 bg-white dark:bg-dark-700 rounded-lg shadow">
                        <div class="text-gray-700 dark:text-dark-400 text-md font-medium">Leader Board:</div>
                        <div class="grid grid-cols-1 divide-y divide-gray-200 dark:divide-dark-500">
                            <div v-for="user in leaderBoard">
                                <user-block :user="user" />
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import CardsGrid from "@/Components/CardsGrid";
import UserBlock from "@/Components/UserBlock";
import Pagination from "@/Components/Pagination";

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
const leaderBoard = [
    {
        handle: 'CryDeTaan',
        streetCred: 123,
        imageUrl:
            'https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
    },
    {
        handle: 'CryDeTaan',
        streetCred: 123,
        imageUrl:
            'https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
    },
    {
        handle: 'CryDeTaan',
        streetCred: 123,
        imageUrl:
            'https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
    },
]

export default {
    components: {
        Pagination,
        UserBlock,
        CardsGrid,
        AppLayout,
    },

    setup() {
        return {
            snippets,
            leaderBoard,
        }
    },
}
</script>
