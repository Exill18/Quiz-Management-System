<x-layout>
    <x-slot name="heading">
        Payment Page
    </x-slot>

    <div class="flex justify-center items-center h-screen">
        <div class="max-w-md w-full p-6 bg-white rounded-lg shadow-md">
            <div class="mb-4">
                <hr class="border-gray-300">
                <p class="text-center text-gray-700">Pay using Credit Card</p>
                <hr class="border-gray-300">
            </div>
            
            <form id="paymentForm" action="/payment" method="POST" class="space-y-4">
                @csrf <!-- Add CSRF token for Laravel protection -->
                <div class="space-y-2">
                    <label for="cardholder_name" class="block text-sm font-medium text-gray-700">Card Holder Full Name</label>
                    <input id="cardholder_name" name="cardholder_name" type="text" class="input_field border border-black ">
                </div>

                <div class="space-y-2">
                    <label for="card_number" class="block text-sm font-medium text-gray-700">Card Number</label>
                    <input id="card_number" name="card_number" type="text" class="input_field border border-black ">
                </div>

                <div class="space-y-2">
                    <label for="expiry_date" class="block text-sm font-medium text-gray-700">Expiry Date / CVV</label>
                    <div class="flex space-x-2">
                        <input id="expiry_date" name="expiry_date" type="text" class="input_field border border-black ">
                        <input id="cvv" name="cvv" type="text" class="input_field">
                    </div>
                </div>

                <div class="space-y-2">
                    <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
                    <input id="amount" name="amount" type="text" class="input_field border border-black ">
                </div>

                

                <button id="paypalButton" type="submit" class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Checkout
                </button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('paypalButton').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent form submission
            var form = document.getElementById('paymentForm');
            var formData = new FormData(form);
        
            fetch('/payment', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (response.ok) {
                    return response.json();
                }
                throw new Error('Network response was not ok.');
            })
            .then(data => {
                console.log(data);
                // Handle successful payment here
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
        });
    </script>


</x-layout>
<x-footer />