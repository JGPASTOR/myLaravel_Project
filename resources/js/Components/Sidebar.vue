<template>
    <aside class="bg-gray-100 p-5 w-64">
        <div class="text-center mb-5">
            <img
                src="/assets/img/profile_picture.png"
                alt="Jester Pastor"
                class="w-16 h-16 rounded-full mx-auto"
            />
            <p class="text-sm text-gray-600 mt-2">{{ $page.props.auth.user.name }}</p>
        </div>
        <nav>
            <ul class="space-y-2">
                <li>
                    <Link
                        :href="route('admin.dashboard')"
                        :class="{
                            'text-blue-500 font-bold':
                                route().current('admin.dashboard'),
                            'text-gray-800 hover:text-blue-500':
                                !route().current('admin.dashboard'),
                        }"
                    >
                        Home
                    </Link>
                </li>
                
                <li>
                    <Link
                    :href="route('admin.user')"
                        :class="{
                            'text-blue-500 font-bold':
                                route().current('admin.user'),
                            'text-gray-800 hover:text-blue-500':
                                !route().current('admin.user'),
                        }"
                        >Clients</Link
                    >
                </li>
                <li>
                    <Link
                        :href="route('admin.serviceprovider')"
                        :class="{
                            'text-blue-500 font-bold':
                                route().current('admin.serviceprovider'),
                            'text-gray-800 hover:text-blue-500':
                                !route().current('admin.serviceprovider'),
                        }"
                        >Service Providers</Link
                    >
                </li>
                <li>
                    <Link
                        :href="route('admin.bookings')"
                        :class="{
                            'text-blue-500 font-bold':
                                route().current('admin.bookings'),
                            'text-gray-800 hover:text-blue-500':
                                !route().current('admin.bookings'),
                        }"
                        >Bookings</Link>
                </li>
                <li>
                    <Link
                        :href="route('admin.servicecategories')"
                        :class="{
                            'text-blue-500 font-bold':
                                route().current('admin.servicecategories'),
                            'text-gray-800 hover:text-blue-500':
                                !route().current('admin.servicecategories'),
                        }"
                        >Service Categories</Link
                    >
                </li>
            </ul>
        </nav>
    </aside>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
</script>
