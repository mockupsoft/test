<script setup>
import { Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';

const showingNavigationDropdown = ref(false);
const sidebarOpen = ref(false); // Changed to false for mobile

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <div class="min-h-screen bg-gray-100">
        <!-- Mobile sidebar -->
        <div class="lg:hidden">
            <div class="fixed inset-0 flex z-40">
                <div 
                    v-show="sidebarOpen"
                    class="fixed inset-0 bg-gray-600 bg-opacity-75"
                    @click="sidebarOpen = false"
                ></div>
                <div 
                    v-show="sidebarOpen"
                    class="relative flex-1 flex flex-col max-w-xs w-full bg-white"
                >
                    <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
                        <div class="flex-shrink-0 flex items-center px-4">
                            <ApplicationLogo class="h-8 w-auto" />
                        </div>
                        <nav class="mt-5 px-2 space-y-1">
                            <NavLink 
                                :href="route('admin.dashboard')" 
                                :active="route().current('admin.dashboard')"
                            >
                                Dashboard
                            </NavLink>
                            <NavLink 
                                :href="route('admin.categories.index')" 
                                :active="route().current('admin.categories.*')"
                            >
                                Categories
                            </NavLink>
                            <NavLink 
                                :href="route('admin.products.index')" 
                                :active="route().current('admin.products.*')"
                            >
                                Products
                            </NavLink>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Desktop sidebar - Always visible on lg screens -->
        <div class="hidden lg:flex lg:w-64 lg:flex-col lg:fixed lg:inset-y-0">
            <div class="flex flex-col flex-grow bg-indigo-700 pt-5 pb-4 overflow-y-auto">
                <div class="flex items-center flex-shrink-0 px-4">
                    <ApplicationLogo class="h-8 w-auto text-white" />
                </div>
                <nav class="mt-5 flex-1 px-2 space-y-1">
                    <NavLink 
                        :href="route('admin.dashboard')" 
                        :active="route().current('admin.dashboard')"
                        class="text-white hover:bg-indigo-600"
                        active-class="bg-indigo-800"
                    >
                        Dashboard
                    </NavLink>
                    <NavLink 
                        :href="route('admin.categories.index')" 
                        :active="route().current('admin.categories.*')"
                        class="text-white hover:bg-indigo-600"
                        active-class="bg-indigo-800"
                    >
                        Categories
                    </NavLink>
                    <NavLink 
                        :href="route('admin.products.index')" 
                        :active="route().current('admin.products.*')"
                        class="text-white hover:bg-indigo-600"
                        active-class="bg-indigo-800"
                    >
                        Products
                    </NavLink>
                </nav>
            </div>
        </div>

        <!-- Main content area -->
        <div class="lg:pl-64 flex flex-col min-h-screen">
            <!-- Top navigation -->
            <div class="sticky top-0 z-10 flex-shrink-0 flex h-16 bg-white shadow">
                <button
                    type="button"
                    class="px-4 border-r border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 lg:hidden"
                    @click="sidebarOpen = true"
                >
                    <span class="sr-only">Open sidebar</span>
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <div class="flex-1 px-4 flex justify-end">
                    <div class="ml-4 flex items-center md:ml-6">
                        <Dropdown align="right" width="48">
                            <template #trigger>
                                <button class="max-w-xs flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <span class="sr-only">Open user menu</span>
                                    <div class="h-8 w-8 rounded-full bg-indigo-500 flex items-center justify-center text-white">
                                        {{ $page.props.auth.user.name.charAt(0) }}
                                    </div>
                                </button>
                            </template>

                            <template #content>
                                <DropdownLink :href="route('profile.edit')">
                                    Profile
                                </DropdownLink>
                                <form @submit.prevent="logout">
                                    <DropdownLink as="button">
                                        Log Out
                                    </DropdownLink>
                                </form>
                            </template>
                        </Dropdown>
                    </div>
                </div>
            </div>

            <!-- Page content -->
            <main class="flex-1 bg-gray-100">
                <div class="py-6">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <slot />
                    </div>
                </div>
            </main>
        </div>
    </div>
</template>