<!-- resources/views/service/index.blade.php -->

<x-guest-layout>
    <div class="container mx-auto py-12 px-6 lg:px-8">

        <!-- Hero Section -->
        <div class="relative bg-green-600 text-white text-center py-16 md:py-24 overflow-hidden rounded-lg">
            <div class="absolute inset-0 z-0">
                <!-- Optional: Add a background image with opacity -->
                <img src="{{ asset('img/hero/Our Services.png') }}" alt="Background" class="w-full h-full opacity-90" />
            </div>
        </div>

        <!-- Section: Introduction to Services -->
        <div class="mt-12 mb-12">
            <div class="text-center">
                <h2 class="text-3xl font-semibold text-green-500">LifeLine Pharmacy Services</h2>
                <p class="mt-4 text-gray-600">
                    At LifeLine Pharmacy, we provide comprehensive healthcare services to ensure that all your health
                    needs are met under one roof. From prescription fulfillment to personalized health advice, our services are tailored to help you achieve optimal health.
                </p>
            </div>
        </div>

        <!-- Section: Services We Offer -->
        <div class="mb-12">
            <h2 class="text-2xl font-semibold text-green-500 text-center">Our Services</h2>
            <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

                <!-- Service 1 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="{{ asset('img/services/prescription.png') }}" alt="Prescription Fulfillment"
                        class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-green-500">Prescription Fulfillment</h3>
                        <p class="mt-2 text-gray-600">
                            Fast and reliable prescription services, ensuring you receive your medications promptly.
                        </p>
                    </div>
                </div>

                <!-- Service 2 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="{{ asset('img/services/consult.png') }}" alt="Online Doctor Consultation"
                        class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-green-500">Online Doctor Consultation</h3>
                        <p class="mt-2 text-gray-600">
                            Access professional healthcare advice from certified doctors online at your convenience.
                        </p>
                    </div>
                </div>

                <!-- Service 3 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="{{ asset('img/services/products.png') }}" alt="Wellness Products"
                        class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-green-500">Wellness Products</h3>
                        <p class="mt-2 text-gray-600">
                            Explore our extensive collection of wellness products for your health and vitality.
                        </p>
                    </div>
                </div>

                <!-- Service 4 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="{{ asset('img/services/devices.jpg') }}" alt="Home Healthcare Devices"
                        class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-green-500">Home Healthcare Devices</h3>
                        <p class="mt-2 text-gray-600">
                            We offer a range of healthcare devices to support your health from the comfort of your home.
                        </p>
                    </div>
                </div>

                <!-- Service 5 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="{{ asset('img/services/vaccine.jpg') }}" alt="Immunizations and Vaccinations"
                        class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-green-500">Immunizations and Vaccinations</h3>
                        <p class="mt-2 text-gray-600">
                            We provide a variety of vaccines including flu, COVID-19, and other essential immunizations.
                        </p>
                    </div>
                </div>

                <!-- Service 6 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="{{ asset('img/services/Health screening.jpg') }}" alt="Health Screenings"
                        class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-green-500">Health Screenings</h3>
                        <p class="mt-2 text-gray-600">
                            Convenient health screenings and lab tests to monitor your well-being.
                        </p>
                    </div>
                </div>

                <!-- Add more services as needed -->

            </div>
        </div>

        <!-- Section: Why Choose Our Services -->
        <div class="mb-12">
            <h2 class="text-2xl font-semibold text-green-500">Why Choose Our Services?</h2>
            <ul class="mt-4 space-y-4 text-gray-600">
                <li><strong>Expert Healthcare:</strong> Our services are provided by certified professionals dedicated to your health.</li>
                <li><strong>Convenience:</strong> We offer online consultations, home delivery, and easy prescription refills to save you time.</li>
                <li><strong>Comprehensive Care:</strong> From medication management to health advice, we cover all aspects of healthcare.</li>
                <li><strong>Affordable Pricing:</strong> We ensure that our services are accessible with competitive pricing and discounts.</li>
                <li><strong>Customer-Centric Approach:</strong> We prioritize your well-being with personalized care tailored to your needs.</li>
            </ul>
        </div>

        <!-- Section: Call to Action -->
        <div class="text-center mt-12">
            <a href="{{ route('contact') }}" class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition duration-300">Contact Us Today</a>
        </div>
    </div>
</x-guest-layout>
