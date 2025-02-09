<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <Head title="SERVIFY Surigao - Login" />

    <div class="container">
        <div class="left">
            <h1>Welcome to SERVIFY Surigao</h1>
            <p>All in one market place for your services</p>
            <img
                alt="Illustration of two service workers with cleaning equipment"
                height="500"
                src="/assets/img/login.png"
                width="500"
            />
        </div>
        <div class="right">
            <Link :href="route('welcome')" class="back">
                <span><i class="fas fa-arrow-left"></i></span>
            </Link>
            <form @submit.prevent="submit">
                <h2>Sign In</h2>

                <!-- Email Input -->
                <div class="form-group">
                    <label for="email">
                        Email Address
                        <span style="color: red">*</span>
                    </label>
                    <TextInput
                        id="email"
                        type="email"
                        v-model="form.email"
                        placeholder="e.g. john@email.com"
                        required
                    />
                </div>

                <!-- Password Input -->
                <div class="form-group">
                    <label for="password">
                        Password
                        <span style="color: red">*</span>
                    </label>
                    <TextInput
                        id="password"
                        type="password"
                        v-model="form.password"
                        placeholder="e.g. abc123"
                        required
                    />
                </div>

                <!-- Remember Me and Forgot Password -->
                <div
                    style="
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                    "
                >
                    <div>
                        <input
                            id="remember"
                            type="checkbox"
                            v-model="form.remember"
                        />
                        <label for="remember">Remember Me</label>
                    </div>
                    <a href="#">Forgot Password?</a>
                </div>

                <!-- Login Button -->
                <div class="button">
                    <PrimaryButton class="btn" :disabled="form.processing">
                        Login
                    </PrimaryButton>
                </div>
                <!-- Error Message -->
                <p
                    class="error"
                    v-if="form.errors.email || form.errors.password"
                >
                    {{ form.errors.email || form.errors.password }}
                </p>

                <!-- Sign Up Links -->
                <div class="signup">
                    <p>
                        Don’t have an account?
                        <Link :href="route('register')">Register</Link>
                    </p>
                </div>
            </form>
        </div>
    </div>
</template>
<style>
body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
}

.container {
    display: flex;
    width: 80%;
    background-color: white;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
.left {
    flex: 1;
    padding: 50px;
    text-align: center;
}
.left h1 {
    font-size: 36px;
    margin-bottom: 20px;
}
.left p {
    font-size: 16px;
    color: #666;
    margin-bottom: 40px;
}
.left img {
    width: 100%;
}
.right {
    flex: 1;
    background-color: #d4d8ff;
    padding: 40px;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    max-width: 350px;
}
.right .back {
    transition: transform 0.3s ease;
    color: #000000;
    font-size: 25px;
    margin-bottom: 100px;
}
.back:hover {
    transform: scale(1.1);
}

.right h2 {
    font-size: 24px;
    margin-bottom: 20px;
}
.right label {
    font-size: 14px;
    color: #333;
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
.right a {
    color: #666;
    text-decoration: none;
    font-size: 14px;
}
.right a:hover {
    text-decoration: underline;
}
.right .btn {
    background-color: #7a5cf7;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    width: 100%;
}
.right .btn:hover {
    background-color: #5a3fcf;
}
.right .signup {
    margin-top: 20px;
    font-size: 14px;
}
.right .signup a {
    color: #4a90e2;
    text-decoration: none;
}
.right .signup a:hover {
    text-decoration: underline;
}
</style>
