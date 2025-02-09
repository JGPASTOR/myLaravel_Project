<template>
    <AdminLayout>
        <h1>Clients List</h1>
        <button class="add-btn" @click="openAddClient">➕ Add Client</button>
        <section class="table-section">
            <table>
                <thead>
                    <tr>
                        <th>ID #</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>User Name</th>
                        <th>Email Addresses</th>
                        <th>Date Registered</th>
                        <th>Tools</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="filteredUsers.length === 0">
                        <td colspan="6" class="no-data">
                            No clients available.
                        </td>
                    </tr>
                    <tr v-for="user in filteredUsers" :key="user.id">
                        <td>{{ user.id }}</td>
                        <td>{{ user.firstName }}</td>
                        <td>{{ user.lastName }}</td>
                        <td>{{ user.name }}</td>
                        <td>{{ user.email }}</td>
                        <td>{{ formatDate(user.created_at) }}</td>
                        <td>
                            <!-- Edit Button -->
                            <button
                                class="edit-btn"
                                style="margin-right: 10px"
                                @click="openEditClient(user)"
                            >
                                <i
                                    class="fas fa-user-edit"
                                    style="color: blue"
                                ></i>
                            </button>

                            <!-- Delete Button -->
                            <button
                                class="delete-btn"
                                @click="deleteClient(user)"
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
        <el-dialog
            v-model="dialogVisible"
            :title="isAddClient ? 'Add Client' : 'Edit Client'"
            width="500"
            :before-close="handleClose"
        >
            <!-- Modal for Adding User -->
            <form @submit.prevent="submit">
                <div class="form-group">
                    <label for="first-name">First Name</label>
                    <input
                        type="text"
                        id="first-name"
                        v-model="form.firstName"
                    />
                    <InputError class="mt-2" :message="form.errors.firstName" />
                </div>
                <div class="form-group">
                    <label for="last-name">Last Name</label>
                    <input type="text" id="last-name" v-model="form.lastName" />
                    <InputError class="mt-2" :message="form.errors.lastName" />
                </div>
                <div class="form-group">
                    <label for="username">User Name</label>
                    <input type="text" id="username" v-model="form.name" />
                    <InputError class="mt-2" :message="form.errors.name" />
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" v-model="form.email" />
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input
                        id="password"
                        type="password"
                        v-model="form.password"
                    />
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>
                <button type="submit" class="add-button">
                     {{ isAddClient ? "Save" : "Update" }}
                </button>

                <button type="button" class="close-button" @click="closeModal">
                    Close
                </button>
            </form>
        </el-dialog>
    </AdminLayout>
</template>

<script setup>
import Swal from "sweetalert2";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { ref, defineProps, computed } from "vue";
import InputError from "@/Components/InputError.vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    users: Object,
});


const filteredUsers = computed(() => {
    return props.users.filter((user) => user.role === "client");
});

const isAddClient = ref(false);
const isEditClient = ref(false);
const dialogVisible = ref(false);

const form = useForm({
    firstName: "",
    lastName: "",
    name: "",
    email: "",
    password: "",
});

const openAddClient = () => {
    isAddClient.value = true;
    dialogVisible.value = true;
    form.reset();
};

const openEditClient = (user) => {
    isAddClient.value = false;
    isEditClient.value = user;
    dialogVisible.value = true;
    form.firstName = user.firstName;
    form.lastName = user.lastName;
    form.name = user.name;
    form.email = user.email;
};


const deleteClient = (user) => {
    Swal.fire({
        title: "Are you sure?",
        text: "Are you sure you want to delete this client?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            
            form.delete(route("delete.client", user.id), {
                onSuccess: () => {
                    Swal.fire({
                        title: "Deleted!",
                        text: "Client has been deleted successfully.",
                        icon: "success",
                    });
                },
            });
        }
    });
};


const submit = () => {
    if (isAddClient.value) {
        
        form.post(route("save.client"), {
            onSuccess: () => {
                closeModal();
                Swal.fire({
                    title: "Success!",
                    text: "Client has been created successfully",
                    icon: "success",
                });
            },
        });
    } else {
        
        form.patch(route("update.client", isEditClient.value.id), {
            onSuccess: () => {
                closeModal();
                Swal.fire({
                    title: "Success!",
                    text: "Client has been updated successfully.",
                    icon: "success",
                });
            },
        });
    }
};

const closeModal = () => {
    dialogVisible.value = false;
    form.reset();
    isEditClient.value = null;
};

function formatDate(dateString) {
    if (!dateString) return "N/A"; 
    const date = new Date(dateString);
    return `${date.getMonth() + 1}/${date.getDate()}/${date.getFullYear()}`;
}
</script>

<style scoped>

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}


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
    z-index: 2000; 
}

.modal {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    width: 400px;
    z-index: 2001; 
}


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


.delete-btn {
    background: none;
    border: none;
    cursor: pointer;
    font-size: 18px;
    color: #f44336;
}


.no-data {
    text-align: center;
    font-size: 14px;
    color: #666;
    padding: 20px 0;
}
</style>
