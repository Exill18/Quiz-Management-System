<x-layout>
    <x-slot name="heading">
        Edit Information, Hello {{ auth()->user()->name }}
    </x-slot>

    <div class="max-w-lg mx-auto p-6 bg-white rounded-lg shadow-lg">
        <form method="POST" action="/user_dash/{{auth()->user()->id}}" class="space-y-6">

            @csrf
            @method('PATCH')

            <div class="space-y-4">
                <div>
                    <x-form-field>
                        <x-form-label for="name" class="block text-gray-700 text-sm font-medium">Name</x-form-label>
                        <div class="mt-1">
                            <input name="name" id="name" type="text" value="{{ auth()->user()->name }}" required class="block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"/>
                            <x-form-error name="name" class="text-red-500 text-sm"/>
                        </div>
                    </x-form-field>
                </div>
                <div>
                    <x-form-field>
                        <x-form-label for="email" class="block text-gray-700 text-sm font-medium">Email</x-form-label>
                        <div class="mt-1">
                            <input name="email" id="email" type="email" value="{{ auth()->user()->email }}" required class="block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"/>
                            <x-form-error name="email" class="text-red-500 text-sm"/>
                        </div>
                    </x-form-field>
                </div>
                <div>
                    <x-form-field>
                        <x-form-label for="password" class="block text-gray-700 text-sm font-medium">Password</x-form-label>
                        <div class="mt-1">
                            <input name="password" type="password" id="password" required class="block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"/>
                            <x-form-error name="password" class="text-red-500 text-sm"/>
                        </div>
                    </x-form-field>
                </div>
                <div>
                    <x-form-field>
                        <x-form-label for="password_confirmation" class="block text-gray-700 text-sm font-medium">Confirm Password</x-form-label>
                        <div class="mt-1">
                            <input name="password_confirmation" type="password" id="password_confirmation" required class="block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"/>
                            <x-form-error name="password_confirmation" class="text-red-500 text-sm"/>
                        </div>
                    </x-form-field>
                </div>
            </div>

            <div class="flex items-center justify-between mt-6">
                <button class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-md">Update</button>
                <a href="/" class="bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded-md">Cancel</a>
            </div>

            <p class="text-xs text-gray-500 mt-4 text-center">
                By clicking continue, you agree to our <a href="/terms" class="text-indigo-600 underline hover:text-indigo-800">Terms of Service</a> and <a href="/terms" class="text-indigo-600 underline hover:text-indigo-800">Privacy Policy</a>
            </p>
        </form>
    </div>
</x-layout>
<x-footer></x-footer>
