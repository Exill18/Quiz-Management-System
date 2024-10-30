<x-layout>
    

    <div class="max-w-lg mx-auto p-6 bg-white rounded-lg shadow-lg">
        <div class="space-y-6">
            <div class="space-y-4"> <h2 class="text-xl font-semibold text-gray-700">Your Information</h2>
                <div>
                    <x-form-label for="name" class="block text-gray-700 text-sm font-medium">Name</x-form-label>
                    <div class="mt-1">
                        <p id="name" class="block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded-md py-2 px-3">{{ auth()->user()->name }}</p>
                    </div>
                </div>
                <div>
                    <x-form-label for="email" class="block text-gray-700 text-sm font-medium">Email</x-form-label>
                    <div class="mt-1">
                        <p id="email" class="block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded-md py-2 px-3">{{ auth()->user()->email }}</p>
                    </div>
                </div>
                <div>
                    <x-form-label for="password" class="block text-gray-700 text-sm font-medium">Password</x-form-label>
                    <div class="mt-1">
                        <p id="password" class="block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded-md py-2 px-3">********</p>
                    </div>
                    <button  onclick="openEditFieldDialog('password')" class="text-xs text-blue-500 mt-2 underline">Change password.</button>
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
                </div>
                <div>
                    <x-form-label for="joinDate" class="block text-gray-700 text-sm font-medium">Join Date</x-form-label>
                    <div class="mt-1">
                        <p id="joinDate" class="block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded-md py-2 px-3">{{ auth()->user()->created_at->format('d M Y') }}</p>
                    </div>
                </div>
            </div>
            <div class="space-y-4">
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
            
                <div class="flex items-center space-x-4 justify-center mt-6">
                    <a href="/" class="bg-gray-600 hover:bg-gray-700 text-white font-semibold  py-2 px-4 rounded-md">Back to Home</a>
                    <button onclick="confirmDelete({{ Auth::user()->id }})" class="bg-red-600 hover:bg-red-700  text-white font-semibold py-2 px-4 rounded-md">Delete Account</button>
                </div>

            <p class="text-xs text-gray-500 mt-4 text-center">
                By using this dashboard, you agree to our <a href="/terms" class="text-indigo-600 underline hover:text-indigo-800">Terms of Service</a> and <a href="/terms" class="text-indigo-600 underline hover:text-indigo-800">Privacy Policy</a>
            </p>
        </div>

        <!-- Last Quizzes Section -->
        
    </div>
    <div class="">
        <div class="max-w-lg mx-auto p-6 bg-white rounded-lg shadow-lg mt-8">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Last Quizzes</h2>
            <div class="space-y-4">
                <div>
                    <x-form-field>
                        <x-form-label for="recent-activity" class="block text-gray-700 text-sm font-medium">Recent Activity</x-form-label>
                        <div class="mt-1">
                            <ul id="recent-activity" class="list-disc pl-5 text-gray-700">
                                <li>Completed Quiz: Laravel Basics</li>
                                <li>Scored 85% on JavaScript Quiz</li>
                                <li>Joined the "Advanced PHP" course</li>
                            </ul>
                        </div>
                    </x-form-field>
                </div>
                <div>
                    <x-form-field>
                        <x-form-label for="upcoming-quizzes" class="block text-gray-700 text-sm font-medium">Upcoming Quizzes</x-form-label>
                        <div class="mt-1">
                            <ul id="upcoming-quizzes" class="list-disc pl-5 text-gray-700">
                                <li>React Basics - 25th Oct</li>
                                <li>Vue.js Intermediate - 30th Oct</li>
                                <li>Node.js Advanced - 5th Nov</li>
                            </ul>
                        </div>
                    </x-form-field>
                </div>
            </div>
        </div>
    </div>
 
    
</x-layout>




<x-footer />