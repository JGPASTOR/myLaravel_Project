<script setup>
import ClientLayout from "@/Layouts/ClientLayout.vue";
import { Head } from "@inertiajs/vue3";
import { ref, computed } from "vue";
import { Link } from "@inertiajs/vue3";

// Search Query
const searchQuery = ref("");

const props = defineProps({
    services: Array,
});

const filteredServices = computed(() =>
    props.services.filter((service) =>
        service.title.toLowerCase().includes(searchQuery.value.toLowerCase())
    )
);

// Methods
const performSearch = () => {
    // Optional reset or trigger logic if needed
};
</script>

<template>
    <ClientLayout>
        <div class="search-bar">
            <input
                v-model="searchQuery"
                @input="performSearch"
                placeholder="Search..."
                type="text"
            />
            <i class="fas fa-search"></i>
        </div>

        <div class="service-container">
            <div
                v-for="service in filteredServices"
                :key="service.id"
                class="service-card"
            >
                <Link
                    :href="route('client.confirmBook', { service: service.id })"
                >
                    <img
                        :src="'/serviceImage/' + service.image"
                        height="150"
                        width="200"
                    />
                    <h3>{{ service.title }}</h3>
                    <p>₱{{ service.price }}</p>
                    <div class="provider">
                        <i class="fas fa-user"></i>
                        {{ service.provider_name }}
                    </div>
                </Link>
            </div>
        </div>
    </ClientLayout>
</template>
