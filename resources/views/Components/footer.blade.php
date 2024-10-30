<!-- Footer -->
<footer class="bg-gray-800 bottom-0 text-white py-4 mt-8">
    <div class="container mx-auto  px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center">
        <div class="text-sm">
            &copy; 2024 EasyLinks. All rights reserved.
        </div>
        <div class="flex space-x-4">
            <x-nav-link href="/" :active="request()->is('/')">Home</x-nav-link>
            <x-nav-link href="/quiz" :active="request()->is('quiz')">Quizzes</x-nav-link>
            <x-nav-link href="/contact" :active="request()->is('contact')">Contacts</x-nav-link>
            <x-nav-link href="/pricing" :active="request()->is('pricing')">Pricing</x-nav-link>
        </div>
    </div>
    </div>
</footer>