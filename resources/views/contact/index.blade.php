<x-guest-layout>
    <div class="container mx-auto py-12 px-6 lg:px-8">

        <!-- Hero Section -->
        <div class="relative bg-green-600 text-white text-center py-16 md:py-24 overflow-hidden rounded-lg">
            <div class="absolute inset-0 z-0">
                <!-- Optional: Add a background image with opacity -->
                <img src="{{ asset('img/hero/contact.png') }}" alt="Background" class="w-full h-full opacity-90" />
            </div>
        </div>

        <!-- Contact Form Section -->
        <div class="mt-12 mb-12">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <!-- Contact Form -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h2 class="text-2xl font-semibold text-green-600 mb-6">Get in Touch</h2>
                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <!-- Name Field -->
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700">Name</label>
                            <input type="text" id="name" name="name"
                                class="w-full px-4 py-2 border rounded-lg" placeholder="Your Name" required>
                        </div>

                        <!-- Email Field -->
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700">Email</label>
                            <input type="email" id="email" name="email"
                                class="w-full px-4 py-2 border rounded-lg" placeholder="Your Email" required>
                        </div>

                        <!-- Subject Field -->
                        <div class="mb-4">
                            <label for="subject" class="block text-gray-700">Subject</label>
                            <input type="text" id="subject" name="subject"
                                class="w-full px-4 py-2 border rounded-lg" placeholder="Subject" required>
                        </div>

                        <!-- Message Field -->
                        <div class="mb-4">
                            <label for="message" class="block text-gray-700">Message</label>
                            <textarea id="message" name="message" class="w-full px-4 py-2 border rounded-lg h-32" placeholder="Your Message"
                                required></textarea>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-6">
                            <button type="submit"
                                class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition duration-300">Send
                                Message</button>
                        </div>
                    </form>
                </div>

                <!-- Contact Info & Map -->
                <div class="flex flex-col justify-center">
                    <!-- Contact Information -->
                    <div class="mb-8">
                        <h2 class="text-2xl font-semibold text-green-600 mb-4">Contact Information</h2>
                        <p class="text-gray-700"><strong>Email:</strong> support@lifelinepharmacy.com</p>
                        <p class="text-gray-700"><strong>Phone:</strong> +266 2800 5333</p>
                        <p class="text-gray-700"><strong>Address:</strong> Sefika Complex, Maseru, Lesotho</p>
                    </div>

                    <!-- Social Media Section -->
                    <div class="text-center mt-6">
                        <h2 class="text-2xl font-semibold text-green-600 mb-6">Follow Us</h2>
                        <div class="flex justify-center space-x-6 text-3xl">
                            <!-- WhatsApp -->
                            <a href="https://wa.me/your-whatsapp-number" target="_blank"
                                class="text-green-500 hover:text-green-700">
                                <i class="fab fa-whatsapp"></i>
                            </a>

                            <!-- Facebook -->
                            <a href="https://facebook.com/your-facebook-page" target="_blank"
                                class="text-blue-600 hover:text-blue-800">
                                <i class="fab fa-facebook"></i>
                            </a>

                            <!-- Twitter -->
                            <a href="https://twitter.com/your-twitter-handle" target="_blank"
                                class="text-blue-400 hover:text-blue-600">
                                <i class="fab fa-twitter"></i>
                            </a>

                            <!-- YouTube -->
                            <a href="https://youtube.com/your-youtube-channel" target="_blank"
                                class="text-red-600 hover:text-red-800">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Google Map Embed -->
                    <div class="rounded-lg overflow-hidden shadow-lg">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3478.940008342191!2d27.49041347531574!3d-29.313435375299857!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1e8dcbc4855092cf%3A0xf4f828471d212b65!2sLife%20Line%20pharmaceutical%20of%20wholesale%20and%20distributor!5e0!3m2!1sen!2sus!4v1726267038334!5m2!1sen!2sus"
                            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section: Footer Call to Action -->
        <div class="text-center mt-12">
            <a href="{{ route('home') }}"
                class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition duration-300">Back to
                Home</a>
        </div>
    </div>

</x-guest-layout>
