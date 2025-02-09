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
    <link rel="stylesheet" href="/assets/home_provider.css" />
    <div>
        <!-- Header Section -->
        <header class="header">
            <!-- Logo -->
            <div class="logo">
                <Link :href="route('provider.dashboard')">
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
                            <DropdownLink :href="route('provider.profile')">
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
            <aside class="bg-gray-100 p-5 w-64">
    <div class="text-center mb-5">
        <img
            src="/assets/img/profile_picture.png"
            alt="Jester Pastor"
            class="w-16 h-16 rounded-full mx-auto"
        />
        <p class="text-sm text-gray-600 mt-2">
            {{ $page.props.auth.user.name }}
        </p>
    </div>
    <nav>
        <ul class="space-y-2">
            <li>
                <Link
                    :href="route('provider.dashboard')"
                    :class="{
                        'text-blue-500 font-bold': route().current('provider.dashboard'),
                        'text-gray-800 hover:text-blue-500': !route().current('provider.dashboard'),
                    }"
                >
                    Home
                </Link>
            </li>
            <li>
                <Link
                    :href="route('provider.service')"
                    :class="{
                        'text-blue-500 font-bold': route().current('provider.service'),
                        'text-gray-800 hover:text-blue-500': !route().current('provider.service'),
                    }"
                >
                    Service
                </Link>
            </li>
            <li class="dropdown relative">
                <Link
                    :href="route('provider.booking')"
                    :class="{
                        'text-blue-500 font-bold': route().current('provider.booking'),
                        'text-gray-800 hover:text-blue-500': !route().current('provider.booking'),
                    }"
                    >Booking</Link
                >
                <ul class="dropdown-content">
                    <li>
                        <Link
                            :href="route('provider.booking')"
                            :class="{
                                'text-blue-500 font-bold': route().current('provider.booking'),
                                'text-gray-800 hover:text-blue-500': !route().current('provider.booking'),
                            }"
                            >New Bookings</Link
                        >
                    </li>
                    <li>
                        <Link
                            :href="route('provider.ongoing')"
                            :class="{
                                'text-blue-500 font-bold': route().current('provider.ongoing'),
                                'text-gray-800 hover:text-blue-500': !route().current('provider.ongoing'),
                            }"
                            >Ongoing</Link
                        >
                    </li>
                    <li>
                        <Link
                            :href="route('provider.completed')"
                            :class="{
                                'text-blue-500 font-bold': route().current('provider.completed'),
                                'text-gray-800 hover:text-blue-500': !route().current('provider.completed'),
                            }"
                            >Completed</Link
                        >
                    </li>
                    <li>
                        <Link
                            :href="route('provider.declined')"
                            :class="{
                                'text-blue-500 font-bold': route().current('provider.declined'),
                                'text-gray-800 hover:text-blue-500': !route().current('provider.declined'),
                            }"
                            >Declined</Link
                        >
                    </li>
                </ul>
            </li>
            <!-- New "Reports" Navigation -->
            <li>
                <Link
                    :href="route('provider.reports')"
                    :class="{
                        'text-blue-500 font-bold': route().current('provider.reports'),
                        'text-gray-800 hover:text-blue-500': !route().current('provider.reports'),
                    }"
                >
                    Reports
                </Link>
            </li>
        </ul>
    </nav>
</aside>


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
/* Style for the dropdown container */

.dropdown {
    position: relative; /* Ensure that the dropdown menu is positioned correctly */
}
/* Dropdown content (hidden by default) */
.dropdown-content {
    display: none; /* Initially hidden */
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    z-index: 1;
}

/* Show the dropdown when the parent item is hovered */
.dropdown:hover .dropdown-content {
    display: block;
}

/* Style for the dropdown items */
.dropdown-content li {
    padding: 8px 12px;
}

.dropdown-content li a {
    text-decoration: none;
    color: #333;
    display: block;
}

/* Hover effect for dropdown items */
.dropdown-content li a:hover {
    background-color: #ddd;
}
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
