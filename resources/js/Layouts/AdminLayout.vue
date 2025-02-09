<script setup>
import { ref } from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { Link, usePage } from "@inertiajs/vue3";
import Sidebar from "@/Components/Sidebar.vue";

// State for showing dropdown
const showingNavigationDropdown = ref(false);

// State for dropdown visibility
const isDropdownOpen = ref(false);

// Access page props (optional if you need user data)
const { props } = usePage();
</script>

<template>
    <link rel="stylesheet" href="/assets/home_admin.css" />
    <div>
        <!-- Header Section -->
        <header class="header">
            <!-- Logo -->
            <div class="logo">
                <Link :href="route('admin.dashboard')">
                    <img
                        src="/assets/img/logo.png"
                        alt="Logo"
                        style="height: 70px"
                    />
                </Link>
            </div>

            <!-- Profile Dropdown -->
            <div class="hidden sm:ms-6 sm:flex sm:items-center">
                <div class="relative ms-3">
                    <Dropdown align="right" width="48">
                        <template #trigger>
                            <span class="inline-flex rounded-md">
                                <!-- Profile Picture Trigger -->
                                <button
                                    type="button"
                                    class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none"
                                >
                                    <img
                                        src="/assets/img/profile_picture.png"
                                        alt="Jester Pastor"
                                        class="profile-pic h-12 w-12 rounded-full"
                                    />
                                </button>
                            </span>
                        </template>

                        <template #content>
                            <DropdownLink :href="route('admin.profile')">
                                Profile
                            </DropdownLink>
                            <DropdownLink
                                :href="route('logout')"
                                method="post"
                                as="button"
                            >
                                Log Out
                            </DropdownLink>
                        </template>
                    </Dropdown>
                </div>
            </div>
        </header>

        <!-- Main Container -->
        <div class="container">
            <!-- Sidebar -->
            <Sidebar />

            <!-- Main Content -->
            <main class="content">
                <slot />
            </main>
        </div>

        <!-- Footer -->
        <footer>
            <p>&copy; 2024 All Rights Reserved by BSICT 3B1</p>
        </footer>
    </div>
</template>

<style scoped>
/* Ensure your CSS here aligns with your project requirements. */

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 20px;
    background-color: #f8f9fa;
    border-bottom: 1px solid #ddd;
}

.logo img {
    height: 40px;
}

.container {
    display: flex;
    flex-direction: row;
}

.content {
    flex: 1;
    padding: 20px;
    background-color: #ffffff;
}

footer {
    text-align: center;
    padding: 20px;
    background-color: #f8f9fa;
    border-top: 1px solid #ddd;
}

.profile-pic {
    object-fit: cover;
}
</style>
