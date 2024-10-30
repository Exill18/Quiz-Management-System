<!-- resources/views/contact.blade.php -->
<x-layout>
    <x-slot name="heading">
        Contact our team
    </x-slot>


    <div class="box flex justify-center items-center mb-10">
        <form action="{{ route('contact.submit') }}" method="POST" class="bg-white shadow-lg rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            <div class="mb-4">
                <x-form-label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name:</x-form-label>
                <x-form-input type="text" id="name" name="name" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></x-form-input>
            </div>
            <div class="mb-4">
                <x-form-label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</x-form-label>
                <x-form-input type="email" id="email" name="email" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></x-form-input>
            </div>
            <div class="mb-6">
                <x-form-label for="message" class="block text-gray-700 text-sm font-bold mb-2">Message:</x-form-label>
                <textarea id="message" rows="10" cols="60" name="message"  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Feel free to reach out to us using this form" required></textarea>
            </div>
            <x-button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Submit</x-button>
        </form>
    </div>
</x-layout>

<style>
    /* Add CSS styles for responsiveness */
    @media (max-width: 768px) {
        /* Adjust the layout for smaller screens */
        form {
            display: flex;
            flex-direction: column;
        }
        x-form-label,
        x-form-input,
        textarea {
            width: 100%;
        }
        x-button {
            margin-top: 10px;
        }
    }
</style>
<!-- Footer -->
<footer class="bg-gray-800 fixed w-full bottom-0 text-white py-4 mt-8">
    <div class="container mx-auto  px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center">
        <div class="text-sm">
            &copy; 2024 OMGS. All rights reserved.
        </div>
        <div class="flex space-x-4">
            <x-nav-link href="/" :active="request()->is('/')">Home</x-nav-link>
            <x-nav-link href="/quizzes" :active="request()->is('quiz')">Quiz</x-nav-link>
            <x-nav-link href="/contact" :active="request()->is('contact')">Contacts</x-nav-link>
            <x-nav-link href="/pricing" :active="request()->is('pricing')">Pricing</x-nav-link>
        </div>
    </div>
    </div>
</footer>
