<script setup>
import ClientLayout from "@/Layouts/ClientLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { ref, defineProps, computed } from "vue";

// Slideshow images
const slides = ref([
    { image: "/assets/img/user_home/airconTech.jpg", alt: "Aircon Technician" },
    { image: "/assets/img/user_home/plumber.jpg", alt: "Plumber" },
    {
        image: "/assets/img/user_home/swedish-massage.jpg",
        alt: "Swedish Massage",
    },
]);

const props = defineProps({
    categories: Array,
    services: Array,
});
</script>

<template>
    <Head title="Dashboard" />

    <ClientLayout>
        <div class="main-content">
            <div class="text-content">
                <h1>Servify Surigao Instant-Services Booking App</h1>
                <p>
                    Your Instant Link to the Perfect Service Provider. "Tired of
                    searching for reliable help? Servify Surigao Instant-Service
                    connects you with certified professionals for all your
                    household needs. Book instantly, relax knowing everyone's
                    background-checked, and enjoy convenient service at your
                    home."
                </p>
            </div>

            <!-- Slideshow -->
            <div class="slideshow-container">
                <div
                    v-for="(slide, index) in slides"
                    :key="index"
                    class="slides"
                >
                    <img
                        :src="slide.image"
                        :alt="slide.alt"
                        height="500"
                        width="700"
                    />
                </div>
            </div>
        </div>

        <!-- Top Categories -->
        <section class="top-categories">
            <h1>Our Top Categories</h1>
            <div class="categories">
                <div
                    v-for="category in categories"
                    :key="category.id"
                    class="category"
                >
                    <img
                        :src="'/categoriesImage/' + category.image"
                        alt="Category Image"
                        width="200"
                        height="200"
                    />
                    <p>{{ category.title }}</p>
                </div>
            </div>
        </section>

        <!-- Top Services -->
        <section class="top-services">
            <h2>Top Rated Services</h2>
            <div
                v-for="service in services.slice(0, 1)"
                :key="service.id"
                class="card"
            >
                <Link
                    :href="route('client.confirmBook', { service: service.id })"
                >
                    <img
                        :src="'/serviceImage/' + service.image"
                        alt="Service Image"
                        width="200"
                        height="150"
                    />
                    <div class="card-content">
                        <h3>{{ service.title }}</h3>
                        <p class="price">{{ service.price }}</p>
                    </div>
                </Link>
            </div>
        </section>

        <!-- Featured Services -->
        <section class="featured-services">
            <h2>Featured Services</h2>
            <div class="card-services">
                <div v-for="service in services" :key="service.id" class="card">
                    <Link
                        :href="
                            route('client.confirmBook', { service: service.id })
                        "
                    >
                        <img
                            :src="'/serviceImage/' + service.image"
                            alt="Service Image"
                            height="200"
                            width="300"
                        />
                        <div class="card-title">{{ service.title }}</div>
                        <div class="card-price">{{ service.price }}</div>
                        <div class="card-provider">
                            <span>{{ service.provider_name }}</span>
                        </div>

                        <div class="card-rating">
                            <i class="fas fa-star"></i>
                            <span>{{ service.rating }}</span>
                        </div>
                    </Link>
                </div>
            </div>
        </section>

        <!-- About -->
        <section class="about">
            <div class="description">
                <div class="description-left">
                    <h2>
                        Sophisticated Solutions and Streamlined Professional...
                    </h2>
                </div>
                <div class="description-right">
                    <p>
                        Streamlined Workflow: Plan, Execute, Collaborate, Adapt.
                        Embrace Automation, Communication, and Flexibility for
                        Peak Productivity.
                    </p>
                </div>
            </div>
            <div class="service_img">
                <img
                    src="/assets/img/spamassage.jpg"
                    alt="Service"
                    height="200"
                    width="300"
                />
                <div class="text">
                    <ul>
                        <li>
                            <strong>client To Provider</strong>
                            <p>
                                The client facilitates user bookings and
                                coordinates with providers to ensure successful
                                service fulfillment.
                            </p>
                        </li>
                        <li>
                            <strong>Provider To Handyman</strong>
                            <p>
                                The provider arranges user bookings and then
                                communicates with handyman to ensure successful
                                service completion.
                            </p>
                        </li>
                        <li>
                            <strong>Handyman To User</strong>
                            <p>The handyman completes the user booking.</p>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
    </ClientLayout>
</template>
