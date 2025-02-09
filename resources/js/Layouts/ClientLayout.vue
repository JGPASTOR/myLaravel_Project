<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
</script>
<template>
    <link rel="stylesheet" href="/assets/user_home.css" />
    <link rel="stylesheet" href="/assets/home_categories.css" />
    <link rel="stylesheet" href="/assets/home_services.css" />
    <div>
        <!-- Header -->
        <header class="header">
            <div class="contact">
                <i class="fas fa-phone-alt"></i>
                +639453467938
            </div>
        </header>

        <!-- Navbar -->
        <nav class="navbar">
            <div class="logo">
                <Link :href="route('client.dashboard')">
                    <img
                        src="/assets/img/logo.png"
                        alt="Logo"
                        style="height: 70px"
                    />
                </Link>
            </div>
            <div class="nav-links">
                <Link
                    :href="route('client.dashboard')"
                    :class="{
                        'text-blue-500 font-bold':
                            route().current('client.dashboard'),
                        'text-gray-800 hover:text-blue-500':
                            !route().current('client.dashboard'),
                    }"
                    >Home</Link
                >
                <Link
                    :href="route('client.categories')"
                    :class="{
                        'text-blue-500 font-bold':
                            route().current('client.categories'),
                        'text-gray-800 hover:text-blue-500':
                            !route().current('client.categories'),
                    }"
                    >Categories</Link
                >
                <Link
                    :href="route('client.services')"
                    :class="{
                        'text-blue-500 font-bold':
                            route().current('client.services'),
                        'text-gray-800 hover:text-blue-500':
                            !route().current('client.services'),
                    }"
                    >Services</Link
                >

                <!-- Booking Dropdown -->
                <div class="dropdown relative">
                    <Link
                        :href="route('client.booking')"
                        :class="{
                            'text-blue-500 font-bold':
                                route().current('client.booking'),
                            'text-gray-800 hover:text-blue-500':
                                !route().current('client.booking'),
                        }"
                        class="text-gray-800 hover:text-blue-500"
                    >
                        Booking
                    </Link>
                    <ul
                        class="dropdown-content hidden absolute bg-white shadow-md"
                    >
                        <li>
                            <Link
                                :href="route('client.booking')"
                                :class="{
                                    'text-blue-500 font-bold':
                                        route().current('client.booking'),
                                    'text-gray-800 hover:text-blue-500':
                                        !route().current('client.booking'),
                                }"
                                >My Bookings</Link
                            >
                        </li>
                        <li>
                            <Link
                                :href="route('client.ongoing')"
                                :class="{
                                    'text-blue-500 font-bold':
                                        route().current('client.ongoing'),
                                    'text-gray-800 hover:text-blue-500':
                                        !route().current('client.ongoing'),
                                }"
                                >Ongoing</Link
                            >
                        </li>
                        <li>
                            <Link
                                :href="route('client.completed')"
                                :class="{
                                    'text-blue-500 font-bold':
                                        route().current('client.completed'),
                                    'text-gray-800 hover:text-blue-500':
                                        !route().current('client.completed'),
                                }"
                                >Completed</Link
                            >
                        </li>
                        <li>
                            <Link
                                :href="route('client.declined')"
                                :class="{
                                    'text-blue-500 font-bold':
                                        route().current('client.declined'),
                                    'text-gray-800 hover:text-blue-500':
                                        !route().current('client.declined'),
                                }"
                                >Declined</Link
                            >
                        </li>
                    </ul>
                </div>
            </div>
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
                        <DropdownLink :href="route('client.profile')">
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
        </nav>

        <!-- Main Content -->
        <main class="content">
            <slot />
        </main>

        <!-- Footer -->
        <footer class="footer">
            <div class="logo">
                <img
                    src="/assets//img/featured_services_img/logo.png"
                    alt="Servify Surigao logo"
                    width="200"
                    height="100"
                />
            </div>
            <div class="info">
                <p>
                    "SERVIFY Instant-Service your one-stop shop for home
                    service."
                </p>
                <p>Business Inquiries | Helpline Number</p>
                <p>sp.reg@servify.ph +639453467938</p>
            </div>
            <div class="social">
                <a
                    href="https://www.facebook.com/jester.pastor.7"
                    target="_blank"
                >
                    <i class="fab fa-facebook"></i> Jester G. Pastor
                </a>
            </div>
        </footer>
    </div>
</template>

<style scoped>
.nav-links {
    display: flex;
    gap: 20px; /* Space between the links */
    align-items: center; /* Vertically align the items */
}
/* Style for the dropdown container */
.dropdown {
    position: relative;
    display: inline-block;
}

/* Style for the dropdown content */
.dropdown-content {
    display: none;
    position: absolute;
    background-color: #fff;
    box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
    z-index: 1;
    min-width: 160px;
}

/* Style for the dropdown items */
.dropdown-content li {
    padding: 8px 12px;
}

/* Dropdown hover effect */
.dropdown:hover .dropdown-content {
    display: block;
}

/* Dropdown items hover effect */
.dropdown-content li a:hover {
    background-color: #f0f0f0;
    color: #007bff;
}
</style>
