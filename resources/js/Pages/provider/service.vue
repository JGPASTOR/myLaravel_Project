<script setup>
import ProviderLayout from "@/Layouts/ProviderLayout.vue";
import { ref, defineProps, computed } from "vue";
import InputError from "@/Components/InputError.vue";
import { useForm, Head } from "@inertiajs/vue3";
import Swal from "sweetalert2";

const props = defineProps({
    services: Array,
});

const isAddService = ref(false);
const isEditService = ref(false);
const dialogVisible = ref(false);

const form = useForm({
    image: null,
    title: "",
    price: "",
});

const openAddService = () => {
    isAddService.value = true;
    dialogVisible.value = true;
    form.reset();
};

const openEditService = (service) => {
    isAddService.value = false;
    dialogVisible.value = true;
    isEditService.value = service;

    form.image = null;
    form.title = service.title;
    form.price = service.price;
};

// Submit form (handles both add and edit)
const submit = () => {
    if (isAddService.value) {
        // Handle add user
        form.post(route("save.service"), {
            onSuccess: () => {
                closeModal();
                Swal.fire({
                    title: "Success!",
                    text: "Service has been created successfully",
                    icon: "success",
                });
            },
        });
    } else {
        // Handle edit user
        form.post(route("update.service", isEditService.value.id), {
            onSuccess: () => {
                closeModal();
                Swal.fire({
                    title: "Success!",
                    text: "Service has been updated successfully.",
                    icon: "success",
                });
            },
        });
    }
};

const closeModal = () => {
    dialogVisible.value = false;
    form.reset();
    isEditService.value = null;
};

const deleteService = (service) => {
    Swal.fire({
        title: "Are you sure?",
        text: "Are you sure you want to delete this category?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            // Perform the delete request
            form.delete(route("delete.service", service.id), {
                onSuccess: () => {
                    Swal.fire({
                        title: "Deleted!",
                        text: "Service has been deleted successfully.",
                        icon: "success",
                    });
                },
            });
        }
    });
};
</script>

<template>
    <el-dialog
        v-model="dialogVisible"
        :title="isAddService ? 'Add Service' : 'Edit Service'"
        width="500"
        :before-close="handleClose"
    >
        <!-- Modal for Adding User -->
        <form @submit.prevent="submit">
            <div class="form-group">
                <label for="image">image</label>
                <input
                    type="file"
                    id="image"
                    name="image"
                    @input="form.image = $event.target.files[0]"
                />
                <InputError class="mt-2" :message="form.errors.image" />
            </div>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" v-model="form.title" />
                <InputError class="mt-2" :message="form.errors.title" />
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" id="price" v-model="form.price" />
                <InputError class="mt-2" :message="form.errors.price" />
            </div>
            <!-- <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" v-model="form.description"></textarea>
                <InputError class="mt-2" :message="form.errors.description" />
            </div> -->

            <button
                type="submit"
                :disabled="form.processing"
                class="add-button"
            >
                Save
            </button>
            <button type="button" class="close-button" @click="closeModal">
                Close
            </button>
        </form>
    </el-dialog>
    <Head title="Service" />

    <ProviderLayout>
        <h1>Provider Service</h1>
        <button class="add-btn" @click="openAddService">➕ Add Service</button>
        <section class="table-section">
            <table>
                <thead>
                    <tr>
                        <th>image</th>
                        <th>title</th>
                        <th>price</th>
                        <th>status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="service in services" :key="service.id">
                        <td>
                            <img
                              :src="'/serviceImage/' + service.image"
                            alt="Category Image" class="images-section" />
                        </td>
                        <td>{{ service.title }}</td>
                        <td>{{ service.price }}</td>
                        <td>{{ service.status }}</td>

                        <td>
                            <!-- Edit Button -->
                            <button class="edit-btn" 
                                 @click="openEditService(service)"
                            style="margin-right: 10px">
                                <i
                                    class="fas fa-pencil-alt"
                                    style="color: blue"
                                ></i>
                            </button>

                            <!-- Delete Button -->
                            <button class="delete-btn"
                                 @click="deleteService(service)"
                            >
                                <i
                                    class="fas fa-trash-alt"
                                    style="color: red"
                                ></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
    </ProviderLayout>
</template>

<style scoped>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.add-button {
    background-color: #28a745;
    color: #fff;
    border: none;
    padding: 10px 15px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
    margin-right: 10px;
}
.add-button:hover {
    background-color: #218838;
}

.close-button {
    background-color: #dc3545;
    color: #fff;
    border: none;
    padding: 10px 15px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
}
.close-button:hover {
    background-color: #c82333;
}

/* Modal Styles */
.modal-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 2000; /* High enough to cover other elements */
}

.modal {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    width: 400px;
    z-index: 2001; /* Ensure above backdrop */
}

/* Modal Content */
h2 {
    margin-bottom: 20px;
    font-size: 18px;
}

.form-group {
    margin-bottom: 15px;
}

label {
    display: block;
    margin-bottom: 5px;
    font-size: 14px;
}

input {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 14px;
}

/* Table Section */
.table-section {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

table {
    width: 100%;
    border-collapse: collapse;
}

th,
td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #e0e0e0;
}

th {
    background-color: #a593ff;
    color: white;
}

tr:hover {
    background-color: hsl(120, 6%, 81%);
}

/* Delete button */
.delete-btn {
    background: none;
    border: none;
    cursor: pointer;
    font-size: 18px;
    color: #f44336;
}

/* No data row */
.no-data {
    text-align: center;
    font-size: 14px;
    color: #666;
    padding: 20px 0;
}

/* Buttons */
.add-btn {
    margin-bottom: 20px;
    padding: 10px 15px;
    background-color: #37d03f;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
}
.add-btn:hover {
    background-color: #0056b3;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;
    color: #333;
}

/* Header */
.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0px 20px;
    background-color: #fff;
    border-bottom: 2px solid #e0e0e0;
}

.logo img {
    width: 150px;
}

.header_profile {
    display: flex;
    align-items: center;
}

.header_profile .profile-pic {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin-right: 10px;
}

/* Layout */
.container {
    display: flex;
    min-height: calc(90vh - 60px);
}

/* Sidebar */
.sidebar {
    background-color: #f9f9f9;
    padding: 20px;
    width: 250px;
}

.sidebar .header_profile {
    text-align: center;
    margin-bottom: 20px;
}

.sidebar .profile-pic {
    width: 70px;
    height: 70px;
    border-radius: 50%;
}

.email {
    font-size: 14px;
    color: #666;
    margin-top: 10px;
}

.nav ul {
    list-style: none;
    margin-top: 20px;
}

.nav ul li {
    font-size: 16px;
    padding: 10px;
    cursor: pointer;
    color: #333;
    margin-bottom: 15px;
}

.nav ul li ul {
    margin-left: 15px;
    font-size: 14px;
    color: #666;
    font-weight: normal;
    margin-top: 5px;
}
.nav ul li:hover {
    background-color: hsl(120, 6%, 81%);
    border-radius: 5px;
}

/* Main Content */
.content {
    flex: 1;
    padding: 20px;
}

h1 {
    font-size: 24px;
    margin-bottom: 20px;
}

/* Table Section */
.table-section {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

table {
    width: 100%;
    border-collapse: collapse;
}

th,
td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #e0e0e0;
}

th {
    background-color: #a593ff;
    color: white;
}

tr {
    background-color: #ffffff;
}
tr:hover {
    background-color: hsl(120, 6%, 81%);
}

.edit-btn,
.delete-btn {
    background: none;
    border: none;
    cursor: pointer;
    font-size: 18px;
}

.edit-btn {
    color: #4caf50;
}

.delete-btn {
    color: #f44336;
}

.images-section {
    display: flex; /* Align images in a row */
    gap: 20px; /* Add space between the images */
    margin-top: 20px;
    width: 200px;
}

/* Footer */
footer {
    text-align: center;
    padding: 10px;
    background-color: #fff;
    border-top: 2px solid #e0e0e0;
    position: relative;
    bottom: 0;
    width: 100%;
}

footer p {
    font-size: 12px;
    color: #666;
}
</style>
