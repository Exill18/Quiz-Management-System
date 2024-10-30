<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('logo.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <title>EasyLinks</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19">
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
                                    <x-nav-link href="/quiz" :active="request()->is('quiz')" class="text-white hover:text-blue-300">Quizzes</x-nav-link>
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
                                    <x-button onclick="openDialog()" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-1" width="1em" height="1em" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="m9.25 22l-.4-3.2q-.325-.125-.612-.3t-.563-.375L4.7 19.375l-2.75-4.75l2.575-1.95Q4.5 12.5 4.5 12.338v-.675q0-.163.025-.338L1.95 9.375l2.75-4.75l2.975 1.25q.275-.2.575-.375t.6-.3l.4-3.2h5.5l.4 3.2q.325.125.613.3t.562.375l2.975-1.25l2.75 4.75l-2.575 1.95q.025.175.025.338v.674q0 .163-.05.338l2.575 1.95l-2.75 4.75l-2.95-1.25q-.275.2-.575.375t-.6.3l-.4 3.2zM11 20h1.975l.35-2.65q.775-.2 1.438-.587t1.212-.938l2.475 1.025l.975-1.7l-2.15-1.625q.125-.35.175-.737T17.5 12t-.05-.787t-.175-.738l2.15-1.625l-.975-1.7l-2.475 1.05q-.55-.575-1.212-.962t-1.438-.588L13 4h-1.975l-.35 2.65q-.775.2-1.437.588t-1.213.937L5.55 7.15l-.975 1.7l2.15 1.6q-.125.375-.175.75t-.05.8q0 .4.05.775t.175.75l-2.15 1.625l.975 1.7l2.475-1.05q.55.575 1.213.963t1.437.587zm1.05-4.5q1.45 0 2.475-1.025T15.55 12t-1.025-2.475T12.05 8.5q-1.475 0-2.488 1.025T8.55 12t1.013 2.475T12.05 15.5M12 12" />
                                        </svg>
                                        Settings
                                    </x-button>

                                    <form method="POST" action="/logout">
                                        @csrf
                                        <x-form-button class="bg-blue-600 hover:bg-blue-400 text-white">Log Out</x-form-button>
                                    </form>

                                    <!-- Dialog box where it will show the user information -->
                                    <div id="dialog" class="hidden fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                            <div class="fixed inset-0 bg-gray-600 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                                            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                                            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                                                <div class="bg-white px-6 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                    <div class="sm:flex sm:items-start">
                                                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24" class="text-red-500">
                                                                <path fill="currentColor" d="M12 4a4 4 0 0 1 4 4a4 4 0 0 1-4 4a4 4 0 0 1-4-4a4 4 0 0 1 4-4m0 7c2.67 0 8 1.33 8 4v3H4v-3c0-2.67 5.33-4 8-4m0 1.9c-2.97 0-6.1 1.46-6.1 2.1v1.1h12.2v-1.1c0-.64-3.13-2.1-6.1-2.1Z" />
                                                            </svg>
                                                        </div>
                                                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                                            <h2 class="text-2xl font-semibold text-gray-900" id="modal-title">Account Details</h2>
                                                            <div class="mt-4">
                                                                <h3 class="text-xl leading-6 font-medium text-gray-900">User Information</h3>
                                                                <div class="mt-2">
                                                                    <p class="text-sm text-gray-500">
                                                                        <strong>Name:</strong>
                                                                        <span id="name" onclick="openEditFieldDialog('name')" class="cursor-pointer text-blue-600 hover:underline">{{ Auth::user()->name }}</span>
                                                                    </p>
                                                                    <p class="text-sm text-gray-500">
                                                                        <strong>Email:</strong>
                                                                        <span id="email" onclick="openEditFieldDialog('email')" class="cursor-pointer text-blue-600 hover:underline">{{ Auth::user()->email }}</span>
                                                                    </p>
                                                                    <p class="text-sm text-gray-500">
                                                                        <strong>Password:</strong>
                                                                        <span id="role" class="cursor-pointer text-blue-600">*************</span>
                                                                    </p>
                                                                    <p class="text-sm text-gray-500">
                                                                        <strong>Created at:</strong>
                                                                        <span>{{ auth()->user()->created_at }}</span>
                                                                    </p>
                                                                </div>
                                                                <h3 class="text-xl leading-6 font-medium text-gray-900 mt-6">Subscription</h3>
                                                                <div class="mt-2">
                                                                    @php
                                                                        $user = \App\Models\User::where('email', auth()->user()->email)->first();

                                                                        $userSubscriptions = \DB::table('users')
                                                                            ->join('subscriptions', 'users.subscription_id', '=', 'subscriptions.id')
                                                                            ->select('users.email as user_email', 'subscriptions.*')
                                                                            ->get();
                                                                        $userSubscription = $userSubscriptions->where('user_email', auth()->user()->email)->first();
                                                                    @endphp
                                                                    <p class="text-sm text-gray-500">
                                                                        <strong>Plan Name:</strong>
                                                                        <span id="subscription" class="cursor-pointer text-blue-600 hover:underline"><a href="/pricing">{{ $userSubscription->plan_name }}</a></span>
                                                                    </p>
                                                                    <p class="text-sm text-gray-500">
                                                                        <strong>Plan Price:</strong>
                                                                        <span id="subscription" class="cursor-pointer text-blue-600">{{ $userSubscription->plan_price }} €</span>
                                                                    </p>
                                                                    <p class="text-sm text-gray-500">
                                                                        <strong>Credits:</strong>
                                                                        <span id="subscription" class="cursor-pointer text-blue-600">{{ $user->credits }}</span>
                                                                    </p>
                                                                    <p class="text-sm text-gray-500">
                                                                        <strong>Plan Description:</strong>
                                                                        <span id="subscription" class="cursor-pointer text-blue-600">{{ $userSubscription->plan_description }}</span>
                                                                    </p>
                                                                    <p class="text-sm text-gray-500">
                                                                        <strong>Member since:</strong>
                                                                        <span id="subscription" class="cursor-pointer text-blue-600">{{ $userSubscription->start_date }}</span>
                                                                    </p>
                                                                    <p class="text-sm text-gray-500">
                                                                        <strong>Subscription expiration:</strong>
                                                                        <span id="subscription" class="cursor-pointer text-blue-600">{{ $userSubscription->end_date }}</span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                                    <button type="button" onclick="confirmDelete({{ Auth::user()->id }})" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                                        Delete Account
                                                    </button>
                                                    <button type="button" onclick="closeDialog()" class="absolute top-1 right-1 -mt-2 -mr-2 bg-white p-2 rounded-full text-gray-500 hover:text-gray-700 focus:outline-none">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                    <button type="button" onclick="openEditFieldDialog('name')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                                        Edit Name
                                                    </button>
                                                    <button type="button" onclick="openEditFieldDialog('email')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                                        Edit Email
                                                    </button>
                                                    <button type="button" onclick="openEditFieldDialog('password')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                                        Edit Password
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Edit password dialog -->
                                <div id="editPasswordDialog" class="hidden fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                                        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                <div class="">
                                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="editPasswordLabel">Edit Password</h3>
                                                        <div class="mt-2">
                                                            <form id="editPasswordForm" method="POST" action="/users/update-password">
                                                                @csrf
                                                                @method('PATCH')
                                                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                                <div
                                                                    class="block mt-6 text-sm font-medium text-gray-700">
                                                                    <label for="current_password" class="block mb-2 text-sm font-medium text-gray-700">Current Password</label>
                                                                    <div class="relative">
                                                                        <input name="current_password" id="current_password" type="password" required
                                                                        class="block w-full rounded-2xl border border-neutral-300 bg-transparent py-4 pl-6 pr-20 text-base/6 text-neutral-950 ring-4 ring-transparent transition placeholder:text-neutral-500 focus:border-neutral-950 focus:outline-none focus:ring-neutral-950/5"
                                                                        />
                                                                    </div>
                                                                </div>

                                                                <div class="block mt-6 text-sm font-medium text-gray-700">
                                                                        <label for="new_password" class="block mb-2 text-sm font-medium text-gray-700">New Password</label>
                                                                    <div class="relative">
                                                                        <input name="new_password" id="new_password" type="password" required
                                                                        class="block w-full rounded-2xl border border-neutral-300 bg-transparent py-4 pl-6 pr-20 text-base/6 text-neutral-950 ring-4 ring-transparent transition placeholder:text-neutral-500 focus:border-neutral-950 focus:outline-none focus:ring-neutral-950/5"
                                                                        />
                                                                    </div>
                                                                </div>

                                                                <div class="block mt-6 text-sm font-medium text-gray-700">
                                                                        <label for="new_password_confirmation" class="block mb-2 text-sm font-medium text-gray-700">Confirm Password</label>
                                                                    <div class="relative">

                                                                        <input name="new_password_confirmation" id="new_password_confirmation" type="password" required
                                                                        class="block w-full rounded-2xl border border-neutral-300 bg-transparent py-4 pl-6 pr-20 text-base/6 text-neutral-950 ring-4 ring-transparent transition placeholder:text-neutral-500 focus:border-neutral-950 focus:outline-none focus:ring-neutral-950/5  "
                                                                        />
                                                                        <div class="absolute inset-y-1 right-1 flex justify-end">
                                                                            <button
                                                                                type="submit"
                                                                                aria-label="Submit"
                                                                                class="flex aspect-square h-full items-center justify-center rounded-xl bg-neutral-950 text-white transition hover:bg-neutral-800"
                                                                            >
                                                                                <svg viewBox="0 0 16 6" aria-hidden="true" class="w-4">
                                                                                <path
                                                                                    fill="currentColor"
                                                                                    fill-rule="evenodd"
                                                                                    clip-rule="evenodd"
                                                                                    d="M16 3 10 .5v2H0v1h10v2L16 3Z"
                                                                                ></path>
                                                                                </svg>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>



                                                                <button type="button" onclick="closeEditFieldDialog()" class="absolute top-1 right-1 -mt-2 -mr-2 bg-white p-2 rounded-full text-gray-500 hover:text-gray-700 focus:outline-none">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                                    </svg>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Edit field dialog -->
                                <div id="editFieldDialog" class="hidden fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                                        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                <div class="">

                                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="editFieldLabel">Edit Field</h3>
                                                        <div class="mt-2">
                                                            <form id="editFieldForm" method="POST" action="/users/update-field">
                                                                @csrf
                                                                @method('PATCH')
                                                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                                <div class="relative mt-6">
                                                                    <input name="editFieldInput" id="editFieldInput" type="text" required
                                                                      class="block w-full rounded-2xl border border-neutral-300 bg-transparent py-4 pl-6 pr-20 text-base/6 text-neutral-950 ring-4 ring-transparent transition placeholder:text-neutral-500 focus:border-neutral-950 focus:outline-none focus:ring-neutral-950/5"
                                                                    />
                                                                    <div class="absolute inset-y-1 right-1 flex justify-end">
                                                                        <button
                                                                            type="submit"
                                                                            aria-label="Submit"
                                                                            class="flex aspect-square h-full items-center justify-center rounded-xl bg-neutral-950 text-white transition hover:bg-neutral-800"
                                                                        >
                                                                            <svg viewBox="0 0 16 6" aria-hidden="true" class="w-4">
                                                                            <path
                                                                                fill="currentColor"
                                                                                fill-rule="evenodd"
                                                                                clip-rule="evenodd"
                                                                                d="M16 3 10 .5v2H0v1h10v2L16 3Z"
                                                                            ></path>
                                                                            </svg>
                                                                        </button>
                                                                    </div>
                                                                  </div>

                                                                <button type="button" onclick="closeEditFieldDialog()" class="absolute top-1 right-1 -mt-2 -mr-2 bg-white p-2 rounded-full text-gray-500 hover:text-gray-700 focus:outline-none">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                                    </svg>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                        <a href="/quiz" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Quizzes</a>
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
                                <div class="text-sm font-medium leading-none text-gray-400">{{ Auth::user()->email }}</div>
                            </div>
                            <x-button onclick="openDialogMobile()" class="bg-blue-600 ml-4 hover:bg-blue-400 text-white cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mr-1" width="1em" height="1em" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="m9.25 22l-.4-3.2q-.325-.125-.612-.3t-.563-.375L4.7 19.375l-2.75-4.75l2.575-1.95Q4.5 12.5 4.5 12.338v-.675q0-.163.025-.338L1.95 9.375l2.75-4.75l2.975 1.25q.275-.2.575-.375t.6-.3l.4-3.2h5.5l.4 3.2q.325.125.613.3t.562.375l2.975-1.25l2.75 4.75l-2.575 1.95q.025.175.025.338v.674q0 .163-.05.338l2.575 1.95l-2.75 4.75l-2.95-1.25q-.275.2-.575.375t-.6.3l-.4 3.2zM11 20h1.975l.35-2.65q.775-.2 1.438-.587t1.212-.938l2.475 1.025l.975-1.7l-2.15-1.625q.125-.35.175-.737T17.5 12t-.05-.787t-.175-.738l2.15-1.625l-.975-1.7l-2.475 1.05q-.55-.575-1.212-.962t-1.438-.588L13 4h-1.975l-.35 2.65q-.775.2-1.437.588t-1.213.937L5.55 7.15l-.975 1.7l2.15 1.6q-.125.375-.175.75t-.05.8q0 .4.05.775t.175.75l-2.15 1.625l.975 1.7l2.475-1.05q.55.575 1.213.963t1.437.587zm1.05-4.5q1.45 0 2.475-1.025T15.55 12t-1.025-2.475T12.05 8.5q-1.475 0-2.488 1.025T8.55 12t1.013 2.475T12.05 15.5M12 12" />
                                </svg>
                            </x-button>
                            <div id="dialogMobile" class="hidden fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                <div class="flex items center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                    <div class="fixed inset-0 bg-gray-600 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                                        <div class="bg-white px-6 pt-5 pb-4 sm:p-6 sm:pb-4">
                                            <div class="sm:flex sm:items-start">
                                                <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24" class="text-red-500">
                                                        <path fill="currentColor" d="M12 4a4 4 0 0 1 4 4a4 4 0 0 1-4 4a4 4 0 0 1-4-4a4 4 0 0 1 4-4m0 7c2.67 0 8 1.33 8 4v3H4v-3c0-2.67 5.33-4 8-4m0 1.9c-2.97 0-6.1 1.46-6.1 2.1v1.1h12.2v-1.1c0-.64-3.13-2.1-6.1-2.1Z" />
                                                    </svg>
                                                </div>
                                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                                    <h2 class="text-2xl font-semibold text-gray-900" id="modal-title">Account Details</h2>
                                                    <div class="mt-4">
                                                        <h3 class="text-xl leading-6 font-medium text-gray-900">User Information</h3>
                                                        <div class="mt-2">
                                                            <p class="text-sm text-gray-500">
                                                                <strong>Name:</strong>
                                                                <span id="name" onclick="openEditFieldDialog('name')" class="cursor-pointer text-blue-600 hover:underline">{{ Auth::user()->name }}</span>
                                                            </p>
                                                            <p class="text-sm text-gray-500">
                                                                <strong>Email:</strong>
                                                                <span id="email" onclick="openEditFieldDialog('email')" class="cursor-pointer text-blue-600 hover:underline">{{ Auth::user()->email }}</span>
                                                            </p>
                                                            <p class="text-sm text-gray-500">
                                                                <strong>Password:</strong>
                                                                <span id="role" class="cursor-pointer text-blue-600">*************</span>
                                                            </p>
                                                            <p class="text-sm text-gray-500">
                                                                <strong>Created at:</strong>
                                                                <span>{{ auth()->user()->created_at }}</span>
                                                            </p>
                                                        </div>
                                                        <h3 class="text-xl leading-6 font-medium text-gray-900 mt-6">Subscription</h3>
                                                        <div class="mt-2">
                                                            @php
                                                                $user = \App\Models\User::where('name', auth()->user()->name)->first();

                                                                $userSubscriptions = \DB::table('users')
                                                                    ->join('subscriptions', 'users.subscription_id', '=', 'subscriptions.id')
                                                                    ->select('users.name as user_name', 'subscriptions.*')
                                                                    ->get();
                                                                $userSubscription = $userSubscriptions->where('user_name', auth()->user()->name)->first();
                                                            @endphp
                                                            <p class="text-sm text-gray-500">
                                                                <strong>Plan Name:</strong>
                                                                <span id="subscription" class="cursor-pointer text-blue-600 hover:underline"><a href="/pricing">{{ $userSubscription->plan_name }}</a></span>
                                                            </p>
                                                            <p class="text-sm text-gray-500">
                                                                <strong>Plan Price:</strong>
                                                                <span id="subscription" class="cursor-pointer text-blue-600">{{ $userSubscription->plan_price }} €</span>
                                                            </p>
                                                            <p class="text-sm text-gray-500">
                                                                <strong>Credits:</strong>
                                                                <span id="subscription" class="cursor-pointer text-blue-600">{{ $user->credits }}</span>
                                                            </p>
                                                            <p class="text-sm text-gray-500">
                                                                <strong>Plan Description:</strong>
                                                                <span id="subscription" class="cursor-pointer text-blue-600">{{ $userSubscription->plan_description }}</span>
                                                            </p>
                                                            <p class="text-sm text-gray-500">
                                                                <strong>Member since:</strong>
                                                                <span id="subscription" class="cursor-pointer text-blue-600">{{ $userSubscription->start_date }}</span>
                                                            </p>
                                                            <p class="text-sm text-gray-500">
                                                                <strong>Subscription expiration:</strong>
                                                                <span id="subscription" class="cursor-pointer text-blue-600">{{ $userSubscription->end_date }}</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                            <button type="button" onclick="confirmDelete({{ Auth::user()->id }})" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                                Delete Account
                                            </button>
                                            <button type="button" onclick="closeDialogMobile()" class="absolute top-1 right-1 -mt-2 -mr-2 bg-white p-2 rounded-full text-gray-500 hover:text-gray-700 focus:outline-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                            <button type="button" onclick="openEditFieldDialogMobile('name')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                                Edit Name
                                            </button>
                                            <button type="button" onclick="openEditFieldDialogMobile('email')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                                Edit Email
                                            </button>
                                            <button type="button" onclick="openEditFieldDialogMobile('password')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                                Edit Password
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Edit field dialog for mobile -->
                            <div id="editFieldDialogMobile" class="hidden fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                            <div class="">
                                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="editFieldLabel">Edit Field</h3>
                                                    <div class="mt-2">
                                                        <form id="editFieldForm" method="POST" action="/users/update-field">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                            <div class="relative mt-6">
                                                                <input name="editFieldInput" id="editFieldInput" type="text" required
                                                                  class="block w-full rounded-2xl border border-neutral-300 bg-transparent py-4 pl-6 pr-20 text-base/6 text-neutral-950 ring-4 ring-transparent transition placeholder:text-neutral-500 focus:border-neutral-950 focus:outline-none focus:ring-neutral-950/5"
                                                                />
                                                                <div class="absolute inset-y-1 right-1 flex justify-end">
                                                                    <button
                                                                        type="submit"
                                                                        aria-label="Submit"
                                                                        class="flex aspect-square h-full items-center justify-center rounded-xl bg-neutral-950 text-white transition hover:bg-neutral-800"
                                                                    >
                                                                        <svg viewBox="0 0 16 6" aria-hidden="true" class="w-4">
                                                                        <path
                                                                            fill="currentColor"
                                                                            fill-rule="evenodd"
                                                                            clip-rule="evenodd"
                                                                            d="M16 3 10 .5v2H0v1h10v2L16 3Z"
                                                                        ></path>
                                                                        </svg>
                                                                    </button>
                                                                </div>
                                                              </div>

                                                            <button type="button" onclick="closeEditFieldDialogMobile()" class="absolute top-1 right-1 -mt-2 -mr-2 bg-white p-2 rounded-full text-gray-500 hover:text-gray-700 focus:outline-none">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        

                            <form method="POST" action="/logout">
                                @csrf
                                <x-form-button class="bg-blue-600 hover:bg-blue-400 text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
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
