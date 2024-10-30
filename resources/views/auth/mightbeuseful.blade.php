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









                                <!-- mobile menus -->

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