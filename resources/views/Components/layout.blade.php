<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--favicon-->
    <link rel="icon" type="image/x-icon" href="{{ asset('logo.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <title>OMGS</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>
<body>
    <script>
        function openDialog() {
            document.getElementById('dialog').classList.remove('hidden');
        }

        function closeDialog() {
            document.getElementById('dialog').classList.add('hidden');
        }

        function openDialogMobile(){
            document.getElementById('dialogMobile').classList.remove('hidden');
        }

        function closeDialogMobile(){
            document.getElementById('dialogMobile').classList.add('hidden');
        }

        function confirmDelete(userId) {
            if (!confirm("Are you sure you want to delete your account?")) {
                return;
            }

            fetch(`/users/${userId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }).then(response => {
                console.log("Account deleted successfully");
                window.location.href = '/';
            }).catch(error => {
                console.error("Error:", error);
            });
        }

        function openEditFieldDialog(field) {
            if (field === 'password') {
                document.getElementById('editPasswordDialog').classList.remove('hidden');
            } else {
                document.getElementById('editFieldDialog').classList.remove('hidden');
                document.getElementById('editFieldLabel').innerText = `Edit ${field.charAt(0).toUpperCase() + field.slice(1)}`;
                document.getElementById('editFieldInput').name = field;
            }
        }

        function closeEditFieldDialog() {
            document.getElementById('editPasswordDialog').classList.add('hidden');
            document.getElementById('editFieldDialog').classList.add('hidden');
        }

        function openEditFieldDialogMobile(field) {
            if (field === 'password') {
                document.getElementById('editPasswordDialogMobile').classList.remove('hidden');
            } else {
                document.getElementById('editFieldDialogMobile').classList.remove('hidden');
                document.getElementById('editFieldLabel').innerText = `Edit ${field.charAt(0).toUpperCase() + field.slice(1)}`;
                document.getElementById('editFieldInput').name = field;
            }
        }

        function closeEditFieldDialogMobile() {
            document.getElementById('editPasswordDialogMobile').classList.add('hidden');
            document.getElementById('editFieldDialogMobile').classList.add('hidden');
        }

        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }
    </script>

    <div class="min-h-full">
        <nav class="bg-teal-700 p-1.5 shadow-lg">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <a href="/" class=""><img class="h-10 w-10 rounded-full shadow-md" src="{{ asset('logo.png') }}"></a>
                        </div>
                        <div class="hidden md:block">
                            @auth
                                <div class="ml-10 flex items-baseline space-x-4">
                                    <x-nav-link href="/" :active="request()->is('/')" class="text-white hover:text-blue-300">Home</x-nav-link>
                                    <x-nav-link href="/quizzes" :active="request()->is('quiz')" class="text-white hover:text-blue-300">Quizzes</x-nav-link>
                                    <x-nav-link href="/contact" :active="request()->is('contact')" class="text-white hover:text-blue-300">Contacts</x-nav-link>
                                </div>
                            @endauth
                            @guest
                                    <div class="ml-10 flex items-baseline space-x-4">
                                        <x-nav-link href="/" :active="request()->is('/')" class="text-white hover:text-blue-300">Home</x-nav-link>
                                        <x-nav-link href="/pricing" :active="request()->is('pricing')" class="text-white hover:text-blue-300">Pricing</x-nav-link>
                                        <x-nav-link href="/contact" :active="request()->is('contact')" class="text-white hover:text-blue-300">Contacts</x-nav-link>
                                    </div>
                            @endguest
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-4 flex items-center md:ml-6">
                            @guest
                                <x-nav-link href="/login" :active="request()->is('login')" class="text-white hover:text-blue-300">Log In</x-nav-link>
                                <x-nav-link href="/register" :active="request()->is('register')" class="text-white hover:text-blue-300">Register</x-nav-link>
                            @endguest
                            @auth
                                    <x-button href="{{ route('users.userDash') }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-1" width="1em" height="1em" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="m9.25 22l-.4-3.2q-.325-.125-.612-.3t-.563-.375L4.7 19.375l-2.75-4.75l2.575-1.95Q4.5 12.5 4.5 12.338v-.675q0-.163.025-.338L1.95 9.375l2.75-4.75l2.975 1.25q.275-.2.575-.375t.6-.3l.4-3.2h5.5l.4 3.2q.325.125.613.3t.562.375l2.975-1.25l2.75 4.75l-2.575 1.95q.025.175.025.338v.674q0 .163-.05.338l2.575 1.95l-2.75 4.75l-2.95-1.25q-.275.2-.575.375t-.6.3l-.4 3.2zM11 20h1.975l.35-2.65q.775-.2 1.438-.587t1.212-.938l2.475 1.025l.975-1.7l-2.15-1.625q.125-.35.175-.737T17.5 12t-.05-.787t-.175-.738l2.15-1.625l-.975-1.7l-2.475 1.05q-.55-.575-1.212-.962t-1.438-.588L13 4h-1.975l-.35 2.65q-.775.2-1.437.588t-1.213.937L5.55 7.15l-.975 1.7l2.15 1.6q-.125.375-.175.75t-.05.8q0 .4.05.775t.175.75l-2.15 1.625l.975 1.7l2.475-1.05q.55.575 1.213.963t1.437.587zm1.05-4.5q1.45 0 2.475-1.025T15.55 12t-1.025-2.475T12.05 8.5q-1.475 0-2.488 1.025T8.55 12t1.013 2.475T12.05 15.5M12 12" />
                                        </svg>
                                        Profile
                                    </x-button>

                                    <form method="POST" action="/logout">
                                        @csrf
                                        <x-form-button class="bg-blue-600 hover:bg-blue-400 text-white">Log Out</x-form-button>
                                    </form>

                                    

                                
                            @endauth
                        </div>
                    </div>
                    
                </div>
            </div>

            <!-- Mobile menu, show/hide based on menu state. -->
            <div class="md:hidden" id="mobile-menu">
                <!-- Mobile menu dropdown -->
                <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
                    @auth
                        <a href="/" class="bg-gray-900 text-white block rounded-md px-3 py-2 text-base font-medium" aria-current="page">Home</a>
                        <a href="/quizzes" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Quizzes</a>
                        <a href="/contact" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Contact</a>
                    @endauth
                    @guest
                        <a href="/" class="bg-gray-900 text-white block rounded-md px-3 py-2 text-base font-medium" aria-current="page">Home</a>
                        <a href="/pricing" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Pricing</a>
                        <a href="/contact" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Contact</a>
                    @endguest
                </div>
                <div class="border-t border-gray-700 pb-3 pt-4">
                    <div class="flex items-center px-5">
                        @auth
                        <!-- Profile dropdown -->
                            <div class="ml-3">
                                <div class="text-base font-medium leading-none text-white">{{ Auth::user()->name }}</div>
                                <div class="text-sm font-medium leading-none text-gray-300">{{ Auth::user()->email }}</div>
                            </div>
                            <x-button href="{{route('users.userDash')}}" class="bg-blue-600 ml-24 hover:bg-blue-400 text-white cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M14.81 12.28a3.73 3.73 0 0 0 1-2.5a3.78 3.78 0 0 0-7.56 0a3.73 3.73 0 0 0 1 2.5A5.94 5.94 0 0 0 6 16.89a1 1 0 0 0 2 .22a4 4 0 0 1 7.94 0A1 1 0 0 0 17 18h.11a1 1 0 0 0 .88-1.1a5.94 5.94 0 0 0-3.18-4.62M12 11.56a1.78 1.78 0 1 1 1.78-1.78A1.78 1.78 0 0 1 12 11.56M19 2H5a3 3 0 0 0-3 3v14a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V5a3 3 0 0 0-3-3m1 17a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1Z" />
                                </svg>
                            </x-button>
                            

                            <form method="POST" action="/logout">
                                @csrf
                                <x-form-button class="bg-blue-600 hover:bg-blue-400 text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h7v2H5v14h7v2zm11-4l-1.375-1.45l2.55-2.55H9v-2h8.175l-2.55-2.55L16 7l5 5z" />
                                    </svg>
                                </x-form-button>
                            </form>
                        @endauth
                        <!-- Mobile menu, guest -->
                        @guest
                            <div class="flex items-center px-8">
                                <div class="text-sm font-medium leading-none text-gray-400">You are not logged in</div>
                                <div class="flex items-center">
                                    <a href="/login" class="bg-blue-600 ml-4 hover:bg-blue-400 text-white block rounded-md px-3 py-2 text-base font-medium">Login</a>
                                    <a href="/register" class="bg-blue-600 ml-4 hover:bg-blue-400 text-white block rounded-md px-3 py-2 text-base font-medium">Register</a>
                                </div>
                            </div>
                        @endguest

                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>
</div>
</nav>
<header class="bg-white shadow">
<div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 sm:flex sm:justify-between">
<h1 class="text-3xl font-bold tracking-tight text-gray-900">{{ $heading }}</h1>
@if(request()->is('quiz'))
<!-- Create Link Button -->
<div class="flex justify-end">
    <button id="openCreateModal" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create New Link</button>
</div>
@endif
</div>

</header>
<main>
<div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
{{$slot}}
</div>
</main>

</div>
</body>
</html>
