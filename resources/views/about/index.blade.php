<!-- resources/views/about.blade.php -->

<x-guest-layout>
    <div class="container mx-auto py-12 px-6 lg:px-">
        <div class="relative bg-green-600 text-white text-center py-16 md:py-24 overflow-hidden rounded-lg">
            <div class="absolute inset-0 z-0">
                <!-- Optional: Add a background image with opacity -->
                <img src="{{ asset('img/hero/about.png') }}" alt="Background" class="w-full h-full opacity-90" />
            </div>
        </div>


        <!-- Section: Our Story -->
        <div class="mb-12 mt-12">
            <div class="flex flex-col md:flex-row items-center">
                <!-- Image on the left -->
                <div class="w-full md:w-1/3 mb-6 md:mb-0">
                    <img src="{{ asset('img/story.png') }}" alt="Our Story" class="w-full h-auto rounded-xl shadow-md">
                </div>
                <!-- Text on the right -->
                <div class="w-full md:w-2/3 md:pl-6">
                    <h2 class="text-2xl font-semibold text-green-500">Our Story</h2>
                    <p class="mt-4 text-gray-600">
                        LifeLine Pharmacy was founded with a simple vision: to provide easy access to high-quality
                        medicines and healthcare products while ensuring the best customer service. With decades of
                        experience in the pharmaceutical industry, we have grown to become a leading name in community
                        healthcare, helping people live healthier, happier lives. Our commitment to excellence drives
                        everything we do, from our product selection to our customer support.
                    </p>
                </div>
            </div>
        </div>


        <!-- Section: Our Mission and Vision -->
        <div class="mb-12 grid md:grid-cols-1 gap-8">
            <!-- Mission Section -->
            <div class="flex flex-col md:flex-row items-center">
                <!-- Text on the right -->
                <div class="w-full md:w-2/3 md:pl-6">
                    <h2 class="text-2xl font-semibold text-green-500">Our Mission</h2>
                    <p class="mt-4 text-gray-600">
                        At LifeLine Pharmacy, our mission is to enhance the health and well-being of the communities we
                        serve by providing affordable, reliable, and accessible healthcare products and services. We are
                        dedicated to building long-term relationships with our customers based on trust, compassion, and
                        care.
                    </p>
                </div>
                <!-- Image on the right -->
                <div class="w-full md:w-1/3 mb-6 md:mb-0">
                    <img src="{{ asset('img/mission.png') }}" alt="Our Mission"
                        class="w-full h-auto rounded-lg shadow-md">
                </div>
            </div>

            <!-- Vision Section -->
            <div class="flex flex-col md:flex-row items-center">
                <!-- Image on the left -->
                <div class="w-full md:w-1/3 mb-6 md:mb-0">
                    <img src="{{ asset('img/vision.png') }}" alt="Our Vision"
                        class="w-full h-auto rounded-lg shadow-md">
                </div>
                <!-- Text on the right -->
                <div class="w-full md:w-2/3 md:pl-6">
                    <h2 class="text-2xl font-semibold text-green-500">Our Vision</h2>
                    <p class="mt-4 text-gray-600">
                        Our vision is to be the most customer-centric pharmacy in the Lesotho, offering innovative
                        solutions
                        for everyday health needs. We aim to empower people to take control of their health by providing
                        the
                        right advice, tools, and support.
                    </p>
                </div>
            </div>
        </div>


        <!-- Section: Our Core Values -->
        <div class="mb-12 flex flex-col-reverse md:flex-row gap-8 items-center">
            
            <!-- Text on the Left -->
            <div class="w-full md:w-2/3 md:pl-6">
                <h2 class="text-2xl font-semibold text-green-500">Our Core Values</h2>
                <ul class="mt-4 space-y-4 text-gray-600">
                    <li><strong>Compassion:</strong> We treat every customer with empathy and kindness, providing
                        personalized care and attention.</li>
                    <li><strong>Integrity:</strong> We uphold the highest ethical standards in all our dealings,
                        ensuring
                        transparency and honesty.</li>
                    <li><strong>Innovation:</strong> We are constantly looking for new ways to improve our services and
                        provide cutting-edge solutions.</li>
                    <li><strong>Excellence:</strong> We strive to exceed expectations in every interaction, delivering
                        top-tier service and products.</li>
                    <li><strong>Community:</strong> We are committed to giving back to the communities we serve,
                        promoting
                        health education and wellness.</li>
                </ul>
            </div>

            <!-- Image on the Right -->
            <div class="w-full md:w-2/3 mb-6 md:mb-0">
                <img src="{{ asset('img/Core Values.png') }}" alt="Our Core Values"
                    class="w-full h-auto rounded-lg shadow-md">
            </div>
        </div>


        <!-- Section: Services We Offer -->
<div class="mb-12">
    <h2 class="text-2xl font-semibold text-green-500">Services We Offer</h2>
    <p class="mt-4 text-gray-600">
        LifeLine Pharmacy offers a wide range of services designed to meet the diverse healthcare needs of our
        customers. Whether you need expert advice on medication or health management, we are here to help.
    </p>

    <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Service 1 -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <img src="{{ asset('img/services/prescription.png') }}" alt="Prescription Fulfillment"
                class="w-full h-48 object-cover">
            <div class="p-6">
                <h3 class="text-xl font-semibold text-green-600">Prescription Fulfillment</h3>
                <p class="mt-2 text-gray-600">
                    We provide fast, reliable prescription services, including same-day delivery options.
                </p>
            </div>
        </div>

        <!-- Service 2 -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <img src="{{ asset('img/services/consult.png') }}" alt="Online Doctor Consultation"
                class="w-full h-48 object-cover">
            <div class="p-6">
                <h3 class="text-xl font-semibold text-green-600">Online Doctor Consultation</h3>
                <p class="mt-2 text-gray-600">
                    Access expert healthcare professionals from the comfort of your home.
                </p>
            </div>
        </div>

        <!-- Service 3 -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <img src="{{ asset('img/services/products.png') }}" alt="Wellness Products"
                class="w-full h-48 object-cover">
            <div class="p-6">
                <h3 class="text-xl font-semibold text-green-600">Wellness Products</h3>
                <p class="mt-2 text-gray-600">
                    We carry a wide range of vitamins, supplements, and wellness products to keep you healthy.
                </p>
            </div>
        </div>

        <!-- Service 4 -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <img src="{{ asset('img/services/devices.jpg') }}" alt="Home Healthcare Devices"
                class="w-full h-48 object-cover">
            <div class="p-6">
                <h3 class="text-xl font-semibold text-green-600">Home Healthcare Devices</h3>
                <p class="mt-2 text-gray-600">
                    From blood pressure monitors to diabetic care supplies, we offer the latest healthcare devices.
                </p>
            </div>
        </div>

        <!-- Service 5 -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <img src="{{ asset('img/services/vaccine.jpg') }}" alt="Immunizations and Vaccinations"
                class="w-full h-48 object-cover">
            <div class="p-6">
                <h3 class="text-xl font-semibold text-green-600">Immunizations and Vaccinations</h3>
                <p class="mt-2 text-gray-600">
                    Our pharmacy offers immunization services for flu, COVID-19, and more.
                </p>
            </div>
        </div>

        <!-- Service 6 -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <img src="{{ asset('img/services/Health screening.jpg') }}" alt="Health Screenings"
                class="w-full h-48 object-cover">
            <div class="p-6">
                <h3 class="text-xl font-semibold text-green-600">Health Screenings</h3>
                <p class="mt-2 text-gray-600">
                    Get convenient health screenings and lab tests for monitoring your well-being.
                </p>
            </div>
        </div>
    </div>
</div>


        <!-- Section: Meet Our Team -->
        <div class="mb-12">
            <h2 class="text-2xl font-semibold text-green-500">Meet Our Team</h2>
            <p class="mt-4 text-gray-600">
                Our highly trained pharmacists, healthcare professionals, and staff are dedicated to providing
                top-quality care. Every team member is passionate about health and committed to ensuring our customers
                receive the best possible service. With our expert team by your side, you can trust that your health is
                in safe hands.
            </p>
        </div>

        <!-- Section: Why Choose LifeLine Pharmacy -->
        <div class="mb-12">
            <h2 class="text-2xl font-semibold text-green-500">Why Choose LifeLine Pharmacy?</h2>
            <p class="mt-4 text-gray-600">
                We understand that there are many options for healthcare providers, so why choose LifeLine Pharmacy?
            </p>
            <ul class="mt-4 space-y-4 text-gray-600">
                <li><strong>Convenience:</strong> With online ordering and home delivery, managing your health has never
                    been easier.</li>
                <li><strong>Expert Advice:</strong> Our pharmacists are always available to answer your health questions
                    and provide trusted guidance.</li>
                <li><strong>Wide Selection:</strong> We stock a comprehensive range of medications, supplements, and
                    health products.</li>
                <li><strong>Affordable Pricing:</strong> We are committed to offering competitive prices, along with
                    regular promotions and discounts.</li>
                <li><strong>Community Focused:</strong> We care deeply about the health and wellness of our community,
                    supporting local initiatives and outreach programs.</li>
            </ul>
        </div>

        <!-- Section: Contact Us -->
        <div class="mb-12">
            <h2 class="text-2xl font-semibold text-green-500">Contact Us</h2>
            <p class="mt-4 text-gray-600">
                Got questions or need assistance? We're here to help! You can reach us at any time through our website
                or by visiting our nearest location. Feel free to contact our support team for any inquiries.
            </p>
            <p class="mt-4 text-gray-600">
                <strong>Email:</strong> support@lifelinepharmacy.com <br>
                <strong>Phone:</strong> +266 2800 5333 <br>
                <strong>Address:</strong> Sefika Complex, Maseru, Lesotho
            </p>
        </div>

        <!-- Section: Footer Call to Action -->
        <div class="text-center mt-12">
            <a href="{{ route('contact') }}"
                class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition duration-300">Get in
                Touch</a>
        </div>
    </div>
</x-guest-layout>
