<script setup>
import ClientLayout from "@/Layouts/ClientLayout.vue";
import { ref, defineProps } from "vue";
import { Link } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import { useForm } from "@inertiajs/vue3";
import Swal from "sweetalert2";

const props = defineProps({
    service: Object,
});

// Define the form data model
const form = useForm({
  
    date: "",  
    time: "",  
    message: "", 
});

// Submit function
const submit = (service) => {
    form.post(route("client.bookService", service.id), {
     
            onSuccess: () => {
                closeModal();
                Swal.fire({
                    title: "Success!",
                    text: "Booked",
                    icon: "success",
                });
            },
        });
};


const closeModal = () => {
    dialogVisible.value = false;
    form.reset();

};

</script>

<template>
    <Head title="Confirm Booking" />

    <ClientLayout>
        <div class="container">
            <div class="service-header">
                <img
                    alt="Aircon cleaning service image"
                    height="150"
                    :src="'/serviceImage/' + service.image"
                    width="200"
                />
                <div class="service-details">
                    <h2>{{ service.title }}</h2>
                    <p>Category:</p>
                    <div class="category">
                        <ul>
                            <li>{{ service.title }}</li>
                            <li>Window Type</li>
                        </ul>
                    </div>
                    <div class="provider">
                        <img
                            alt="Provider image"
                            height="30"
                            src="/assets/img/profile_picture.png"
                            width="30"
                        />
                        <a href="#"> {{ service.provider_name }} </a>
                        <span> 0 (0 reviews) </span>
                    </div>
                </div>
                <div class="service-price">₱{{ service.price }}</div>
            </div>
        </div>
        <div class="container">
            <form @submit.prevent="submit">
                <div class="schedule-price-container">
                    <div class="schedule-service">
                        <h3>Schedule Service</h3>
                        <div class="content">
                         
                            <!-- Date Picker -->
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input
                                    v-model="form.date"
                                    type="date"
                                    id="date"
                                    class="form-control"
                                    
                                />
                                <InputError class="mt-2" :message="form.errors.date" />
                            </div>
                            <!-- Time Picker -->
                            <div class="form-group">
                                <label for="time">Time</label>
                                <input
                                    v-model="form.time"
                                    type="time"
                                    id="time"
                                    class="form-control"
                                    
                                />
                                <InputError class="mt-2" :message="form.errors.time" />
                            </div>

                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea
                                    v-model="form.message"
                                    type="message"
                                    id="message"
                                    class="form-control"
                                    
                                ></textarea>
                                <InputError class="mt-2" :message="form.errors.message" />
                            </div>

                            <div class="location">
                                <label for="message">Address: </label>
                                {{ service.provider_address }}
                            </div>
                        </div>
                    </div>
                    <div class="price-detail">
                        <h3>Price Detail</h3>
                        <div class="price-item">
                            <span> Price </span>
                            <span> {{ service.price }} </span>
                        </div>
                        <div class="price-item">
                            <span> Subtotal </span>
                            <span> {{ service.price }} </span>
                        </div>
                        <div class="price-item total">
                            <span> Total </span>
                            <span> {{ service.price }} </span>
                        </div>
                        <div class="buttons">
                            <Link :href="route('client.dashboard')">
                                <button class="previous">Previous</button>
                            </Link>
                            <button @click="submit(service)" class="book-now">Book Now</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </ClientLayout>
</template>

<style scoped>
.header {
    background-color: #b3a7f7;
    padding: 10px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header .contact {
    color: black;
    font-size: 16px;
}

.header .contact i {
    margin-right: 10px;
}

.navbar {
    background-color: white;
    padding: 10px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #ddd;
}

.navbar .logo img {
    height: 50px;
}
.container {
    width: 80%;
    margin: 20px auto;
    background-color: white;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
.service-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 2px solid #e6e6fa;
    padding-bottom: 10px;
}
.service-header img {
    width: 200px;
    height: auto;
    border-radius: 10px;
}
.service-details {
    flex-grow: 1;
    margin-left: 20px;
}
.service-details h2 {
    margin: 0;
}
.service-details p {
    margin: 5px 0;
}
.service-details .category {
    margin: 10px 0;
}
.service-details .category ul {
    padding: 0;
    list-style: none;
}
.service-details .category ul li {
    margin: 5px 0;
}
.service-details .provider {
    display: flex;
    align-items: center;
}
.service-details .provider img {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    margin-right: 10px;
}
.service-details .provider a {
    color: #0000ee;
    text-decoration: none;
}
.service-details .provider a:hover {
    text-decoration: underline;
}
.service-price {
    color: #0000ee;
    font-size: 24px;
}
.schedule-price-container {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
}
.schedule-service {
    width: 60%;
}
.schedule-service h3 {
    margin: 0 0 10px 0;
}
.schedule-service .content {
    width: 75%;
    margin: 0;
}
.calendar {
    background-color: #f0f0f0;
    padding: 10px;
    border-radius: 10px;
    text-align: center;
}
.calendar .month {
    font-weight: bold;
    margin-bottom: 10px;
}
.calendar .days {
    display: flex;
    justify-content: space-between;
}
.calendar .days div {
    width: 30px;
    text-align: center;
    cursor: pointer;
    border-radius: 50%;
}
.calendar .days div.selected {
    background-color: #b3a7f7;
    color: #ffffff;
}
.available-slots {
    margin: 10px 0;
}
.available-slots h4 {
    margin: 0 0 10px 0;
}
.available-slots div {
    display: flex;
    justify-content: space-between;
}
.available-slots .slot {
    display: block;
    background-color: #e6e6fa;
    padding: 10px;
    border-radius: 10px;
    text-align: center;
    cursor: pointer;
    width: 20%;
}
.available-slots .slot.selected {
    background-color: #b3a7f7;
    color: white;
}
.location {
    margin: 10px 0;
}
.location input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 10px;
}
.price-detail {
    width: 35%;
    border: 1px solid #ccc;
    border-radius: 10px;
    padding: 20px;
}
.price-detail h3 {
    margin: 0 0 10px 0;
}
.price-detail .price-item {
    display: flex;
    justify-content: space-between;
    margin: 5px 0;
}
.price-detail .total {
    font-weight: bold;
    color: #0000ee;
}
.buttons {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
}
.buttons button {
    padding: 10px 20px;
    border: none;
    border-radius: 10px;
    cursor: pointer;
}
.buttons .previous {
    background-color: #ccc;
}
.buttons .book-now {
    background-color: #0000ee;
    color: white;
}

/* Container Styling */
.container {
    width: 80%;
    margin: 20px auto;
    background-color: white;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

/* Service Header */
.service-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 2px solid #e6e6fa;
    padding-bottom: 10px;
}
.service-header img {
    width: 200px;
    height: auto;
    border-radius: 10px;
}
.service-details {
    flex-grow: 1;
    margin-left: 20px;
}
.service-details h2 {
    margin: 0;
}
.service-details .category ul {
    padding: 0;
    list-style: none;
}
.service-price {
    color: #0000ee;
    font-size: 24px;
}

/* Form Styling */
.schedule-price-container {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
}

/* Service Details */
.schedule-service {
    width: 60%;
}
.schedule-service h3 {
    margin: 0 0 10px 0;
}
.schedule-service .content {
    width: 75%;
    margin: 0;
}

/* Form Elements Styling */
.form-group {
    margin-bottom: 20px;
}

.form-group label {
    font-size: 14px;
    font-weight: bold;
    color: #333;
    margin-bottom: 8px;
    display: inline-block;
}

.form-control {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 10px;
    font-size: 14px;
    margin-bottom: 8px;
    transition: border-color 0.3s;
}

.form-control:focus {
    border-color: #0000ee;
    outline: none;
}

select.form-control {
    height: 40px;
}

input[type="date"].form-control,
input[type="time"].form-control {
    height: 40px;
}

/* Buttons Styling */
.buttons {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
}

.buttons button {
    padding: 10px 20px;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    font-weight: bold;
    transition: background-color 0.3s;
}

.buttons .previous {
    background-color: #ccc;
    color: #333;
}

.buttons .previous:hover {
    background-color: #b3a7f7;
}

.buttons .book-now {
    background-color: #0000ee;
    color: white;
}

.buttons .book-now:hover {
    background-color: #0041b5;
}

/* Price Details */
.price-detail {
    width: 35%;
    border: 1px solid #ccc;
    border-radius: 10px;
    padding: 20px;
}

.price-detail h3 {
    margin: 0 0 10px 0;
}

.price-detail .price-item {
    display: flex;
    justify-content: space-between;
    margin: 5px 0;
}

.price-detail .total {
    font-weight: bold;
    color: #0000ee;
}
</style>
