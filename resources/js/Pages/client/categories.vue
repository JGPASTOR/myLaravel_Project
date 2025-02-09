<script setup>
import ClientLayout from "@/Layouts/ClientLayout.vue";
import { Head } from "@inertiajs/vue3";
import { ref, computed } from "vue";
import { Link } from "@inertiajs/vue3";

// Search Query
const searchQuery = ref("");

const props = defineProps({
    categories: Array,
});

const filteredCategories = computed(() =>
    props.categories.filter((category) =>
        category.title.toLowerCase().includes(searchQuery.value.toLowerCase())
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

        <div class="categories">
            <div
                v-for="category in filteredCategories"
                :key="category.id"
                class="category-card"
            >
                <img
                    :src="'/categoriesImage/' + category.image"
                    width="200"
                    height="150"
                />
                <p>{{ category.title }}</p>
            </div>
        </div>
    </ClientLayout>
</template>
