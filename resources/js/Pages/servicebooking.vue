<script setup>
import { Link } from "@inertiajs/vue3";
import { defineProps } from 'vue';

const props = defineProps({
    service: Object,
});
</script>

<template>
    <link rel="stylesheet" href="/assets/home_servicebooking.css" />
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
                <Link :href="route('welcome')">
                    <img
                        src="/assets/img/logo.png"
                        alt="Servify Surigao Logo"
                        width="100"
                        height="50"
                    />
                </Link>
            </div>
            <div class="nav-links">
                <Link :href="route('welcome')">Home</Link>
                <Link :href="route('welcome')">Categories</Link>
                <Link :href="route('welcome')">Services</Link>
            </div>
            <Link :href="route('login')" class="login">
                <span>Login</span>
                <i class="fas fa-sign-in-alt"></i>
            </Link>
        </nav>

        <!-- Main Content -->
        <div class="container">
            <div class="left-side">
                <div class="title">   {{ service.title }}</div>
                <div class="image-container">
                    <img :src="'/serviceImage/' + service.image" alt="Service Image" width="300" height="200" />
                </div>
                <div class="about-services">About Services</div>
                <div class="service-description">
                    {{ service.title }}
                </div>
            </div>

            <div class="right-side">
                <div class="info-box">
                    <div class="price">{{ service.price }}</div>
                    <div class="description">
                        {{ service.title }}
                    </div>
                    <!-- Replace button with Inertia.js Link -->
                    <Link :href="route('login')" class="login-button">
                        Login to Continue
                    </Link>
                </div>
            </div>

            <!-- Available Location -->
            <div class="location-box">
                <div>Available Location</div>
                <div class="location">
                    <div class="location-item">
                       {{ service.provider_address }}
                    </div>
                </div>
            </div>

            <!-- Available Days (Now below the Login Button) -->
            <div class="days-box">
                <div>Available Days</div>
                <div class="days">
                    <div class="day">Mon</div>
                    <div class="day">Tue</div>
                    <div class="day">Wed</div>
                    <div class="day">Thu</div>
                    <div class="day">Fri</div>
                    <div class="day">Sat</div>
                    <div class="day">Sun</div>
                </div>
            </div>

            <!-- About Provider and Order Detail -->
            <div class="provider_container">
                <div class="section">
                    <h2>About Provider</h2>
                    <div class="provider-info">
                        <img
                            alt="Avatar of the provider"
                            height="80"
                            src="/assets/img/profile_picture.png"
                            width="80"
                        />
                        <div>
                            <p>{{ service.provider_name }}</p>
                            <p>(0 reviews)</p>
                            <p>Member Since: Sept. 30, 2024</p>
                            <p>
                                Completed Project: 0 Project Complete Till Now
                            </p>
                        </div>
                    </div>
                </div>

                <div class="section">
                    <h2>Booking Details</h2>
                    <div class="order-detail">
                        <div>
                            <p>Aircon Cleaning</p>
                            <p>{{ service.title }}</p>
                            <p>{{ service.price }}</p>
                            <p class="price">{{ service.price }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <div class="footer">
        <div class="logo">
            <img
                alt="Servify Surigao logo"
                height="100"
                src="/assets/img/featured_services_img/logo.png"
                width="200"
            />
        </div>
        <div class="info">
            <p>
                "SERVIFY Instant-Service your one stop shop for home service."
            </p>
            <p>Business Inquiries | Helpline Number</p>
            <p>sp.reg@servify.ph +639453467938</p>
        </div>
        <div class="social">
            <a href="https://www.facebook.com/rensu.buenaflor">
                <i class="fab fa-facebook"></i> Rensu Buenaflor
            </a>
            <a href="https://www.facebook.com/jester.pastor.7">
                <i class="fab fa-facebook"></i> Jester G. Pastor
            </a>
        </div>
    </div>
</template>

<style scoped>
body {
    margin: 0;
    font-family: Arial, sans-serif;
    min-height: auto;
}
.container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1500px;
    margin: 0 auto;
    padding: 100px;
}
.left-side {
    flex: 1;
    margin-right: 20px;
}
.right-side {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
}
.title {
    font-size: 24px;
    font-weight: bold;
    margin: 20px 0;
}
.image-container {
    width: 100%;
    max-width: 800px;
    border-radius: 20px;
    overflow: hidden;
    margin-bottom: 20px;
}
.image-container img {
    width: 100%;
    height: auto;
    border-radius: 15px;
}
.about-services {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 10px;
}
.service-description {
    font-size: 16px;
    margin-bottom: 20px;
}
.info-box {
    background-color: #EFF4FD;
    border-radius: 15px;
    padding: 50px;
    margin-top: 50px;
    margin-bottom: 50px;
    width: 100%;
    max-width: 400px;
    text-align: center;
}
.info-box .price {
    font-size: 34px;
    font-weight: bold;
    color: #4a4aff;
    margin-bottom: 10px;
}
.info-box .description {
    font-size: 20px;
    margin-bottom: 20px;
}
.info-box .login-button {
    background-color: #4a4aff;
    color: white;
    padding: 20px 30px;
    border: none;
    border-radius: 10px;
    font-size: 20px;
    cursor: pointer;
}
.days-box, .location-box {
    background-color: #EFF4FD;
    border-radius: 15px;
    padding: 50px;
    margin-bottom: 50px;
    width: 100%;
    max-width: 400px;
    text-align: center;
}
.days-box .days, .location-box .location {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
}
.days-box .day, .location-box .location-item {
    background-color: white;
    border: 1px solid #4a4aff;
    border-radius: 10px;
    padding: 10px 15px;
    margin: 5px;
    font-size: 20px;
    color: #4a4aff;
}
.location-box .location-item {
    padding: 20px 30px;
}


.provider_container {
    display: inline-block;
    max-width: 600px;
    margin: 0 auto;
    margin-left: 200px;
}
.section {
    background-color: #EFF4FD;
    padding: 20px;
    border-radius: 10px;
    margin-bottom: 20px;
}
.section h2 {
    font-size: 18px;
    margin-top: 0;
}
.provider-info, .order-detail {
    display: flex;
    align-items: center;
}
.provider-info img, .order-detail img {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    margin-right: 20px;
}
.provider-info div, .order-detail div {
    flex: 1;
}
.provider-info div p, .order-detail div p {
    margin: 5px 0;
}
.price {
    color: #0000FF;
    font-weight: bold;
}
</style>