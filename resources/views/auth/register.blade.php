<x-layout>
    <x-slot name="heading">
        Register
    </x-slot>

    <div class="max-w-md mx-auto p-4 pt-6 pb-8 mb-4 bg-white rounded shadow-md">
        <form method="POST" action="/register" class="">
            @csrf

            <div class="space-y-6">
                <div class="border-b border-white pb-6">
                    <div class="w-full px-3 mb-6 md:mb-0">
                        <x-form-field>
                            <x-form-label for="name" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Name</x-form-label>
                            <div class="mt-2">
                                <input name="name" id="name" type="text" :value="old('name')" required class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-2 px-4 focus:outline-none focus:bg-white focus:border-gray-500"/>
                                <x-form-error name="name" class="text-red-500 text-xs italic"/>
                            </div>
                        </x-form-field>
                    </div>
                    <div class="w-full px-3 mb-6 md:mb-0">
                        <x-form-field>
                            <x-form-label for="email" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Email</x-form-label>
                            <div class="mt-2">
                                <input name="email" id="email" type="email" :value="old('email')" required class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-2 px-4 focus:outline-none focus:bg-white focus:border-gray-500"/>
                                @error('email')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                        </x-form-field>
                    </div>

                    <div class="w-full px-3 mb-6 md:mb-0">
                        <x-form-field>
                            <x-form-label for="password" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Password</x-form-label>
                            <div class="mt-2">
                                <input name="password" type="password" id="password" required class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-2 px-4 focus:outline-none focus:bg-white focus:border-gray-500"/>

                                <x-form-error name="password" class="text-red-500 text-xs italic"/>
                            </div>
                        </x-form-field>
                    </div>
                    <div class="w-full px-3 mb-6 md:mb-0">
                        <x-form-field>
                            <x-form-label for="password_confirmation" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Confirm Password</x-form-label>
                            <div class="mt-2">
                                <input name="password_confirmation" type="password" id="password_confirmation" required class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-2 px-4 focus:outline-none focus:bg-white focus:border-gray-500"/>

                                <x-form-error name="password_confirmation" class="text-red-500 text-xs italic"/>
                            </div>
                        </x-form-field>
                    </div>


                </div>

            </div>

            <div class="flex items-center justify-center gap-x-6">
                <button class="bg-gray-950 hover:bg-gray-700 text-white px-32 py-2 font-bold rounded">Register</button>
            </div>



            <div class="flex justify-center items-center mt-6 mb-4">
                <div class="text-gray-400">───────── Already have an account? ─────────</div>

            </div>

            <div class="flex items-center justify-center gap-x-6">
                <a href="/login" class="bg-gray-950 hover:bg-gray-700 text-white px-32 py-2 font-bold rounded">Log In</a>
            </div>



            <p class="text-xs text-gray-600 mt-4">
                By clicking continue, you agree to our <a href="/terms" class="text-gray-600 underline hover:text-gray-900">Terms of Service</a> and <a href="/terms" class="text-gray-600 underline underline-indigo-400 hover:text-gray-900">Privacy Policy</a>
            </p>
        </form>
    </div>
</x-layout>
<!-- Footer -->
<footer class="bg-gray-800 fixed w-full bottom-0 text-white py-4 mt-8">
    <div class="container mx-auto  px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <div class="text-sm">
                &copy; 2024 OMGS. All rights reserved.
            </div>
            <div class="flex space-x-4">
                <x-nav-link href="/" :active="request()->is('/')">Home</x-nav-link>
                <x-nav-link href="/quiz" :active="request()->is('quiz')">Quizes</x-nav-link>
                <x-nav-link href="/contact" :active="request()->is('contact')">Contacts</x-nav-link>
                <x-nav-link href="/pricing" :active="request()->is('pricing')">Pricing</x-nav-link>
            </div>
        </div>
    </div>
</footer>
