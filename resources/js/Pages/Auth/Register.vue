<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, useForm } from "@inertiajs/vue3";

const form = useForm({
    firstName: "",
    lastName: "",
    contactNumber: "09",
    address: "edit..",
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
});

const submit = () => {
    form.post(route("register"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
    <div class="container">
        <div class="left">
            <h1>Welcome to SERVIFY Surigao</h1>
            <p>
              All in one market place for your services
            </p>
            <img
                src="/assets/img/register.png"
                alt="Illustration of two service workers with cleaning equipment"
            />
        </div>
        <div class="right">
            <a href="/" class="back">
                <span><i class="fas fa-arrow-left"></i></span>
            </a>
            <h2>Register</h2>
            <form @submit.prevent="submit">
                <div class="form-group">
                    <InputLabel for="firstName" value="firstName" />
                    <TextInput
                        id="firstName"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.firstName"
                        
                        placeholder="jesster"
                    />
                    <InputError class="mt-2" :message="form.errors.firstName" />
                </div>


                <div class="form-group" style="display: none;">
                    <InputLabel for="contactNumber" value="contactNumber" />
                    <TextInput
                        id="contactNumber"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.contactNumber"
                        
                        placeholder="jesster"
                    />
                    <InputError class="mt-2" :message="form.errors.contactNumber" />
                </div>

                <div class="form-group" style="display: none;">
                    <InputLabel for="address" value="address" />
                    <TextInput
                        id="address"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.address"
                        
                        placeholder="jesster"
                    />
                    <InputError class="mt-2" :message="form.errors.address" />
                </div>
                <div class="form-group">
                    <InputLabel for="lastName" value="lastName" />
                    <TextInput
                        id="lastName"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.lastName"
                        
                        placeholder="pastor"
                    />
                    <InputError class="mt-2" :message="form.errors.lastName" />
                </div>
            
                <div class="form-group">
                    <InputLabel for="name" value="User Name" />
                    <TextInput
                        id="name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.name"
                        
                        placeholder="jester01"
                    />
                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div class="form-group mt-4">
                    <InputLabel for="email" value="Email Address" />
                    <TextInput
                        id="email"
                        type="email"
                        class="mt-1 block w-full"
                        v-model="form.email"
                        
                        placeholder="jester01@email.com"
                    />
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="form-group mt-4">
                    <InputLabel for="password" value="Password" />
                    <TextInput
                        id="password"
                        type="password"
                        class="mt-1 block w-full"
                        v-model="form.password"
                        
                        placeholder="123456"
                    />
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div class="form-group mt-4">
                    <InputLabel
                        for="password_confirmation"
                        value="Confirm Password"
                    />
                    <TextInput
                        id="password_confirmation"
                        type="password"
                        class="mt-1 block w-full"
                        v-model="form.password_confirmation"
                        
                        placeholder="123456"
                    />
                    <InputError
                        class="mt-2"
                        :message="form.errors.password_confirmation"
                    />
                </div>

                <div class="mt-4 flex items-center justify-end">
                    <Link
                        :href="route('login')"
                        class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    >
                        Already registered?
                    </Link>

                    <div class="button">
                        <PrimaryButton class="btn" :disabled="form.processing">
                            Register
                        </PrimaryButton>
                    </div>
                </div>
            </form>
            <p class="hint">
                Already Have Account? <a href="/login">Sign In</a>
            </p>
        </div>
    </div>
</template>

<style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f5f5f5;
}

.container {
    display: flex;
    width: 100%;
    max-width: 1200px;
    background-color: white;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.left {
    flex: 1;
    padding: 40px;
    text-align: center;
}

.left h1 {
    font-size: 32px;
    margin-bottom: 20px;
}

.left p {
    font-size: 16px;
    color: #666;
    margin-bottom: 40px;
}

.left img {
    width: 100%;
    max-width: 500px;
}

.right {
    flex: 1;
    background-color: #D4D8FF;
    padding: 40px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    max-width: 350px;
}

.right .back {
    transition: transform 0.3s ease;
    color: #000000;
    font-size: 25px;
}

.back:hover {
    transform: scale(1.1);
}

.right h2 {
    font-size: 24px;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    font-size: 14px;
    margin-bottom: 5px;
}

.form-group input {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.form-group input::placeholder {
    color: #ccc;
}

.form-group input:focus {
    border-color: #7a5cf7;
    outline: none;
}

.form-group .required {
    color: red;
}

.hint {
    font-size: 17px;
    color: #999;
    text-align: center;
}

.hint a {
    color: #7a5cf7;
    text-decoration: none;
}

.hint a:hover {
    text-decoration: underline;
}

/* Ensuring button width is 100% */
.button .btn {
    background-color: #7a5cf7;
    color: white;
    width: 100%; /* Ensure it takes the full width */
    padding: 10px;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.btn:hover {
    background-color: #5a3fcf;
}
</style>
