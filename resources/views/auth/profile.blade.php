<x-layout>
    t>

    <h2 class="font-bold text-lg">User Dashboard</h2>

    <div>
        <div>
            <x-form-label for="name">Name:</x-form-label>
            <x-form-input type="text" id="name" name="name" value="{{ auth()->user()->name }}" disabled/>
        </div>

        <div>
            <x-form-label for="email">Email:</x-form-label>
            <x-form-input type="email" id="email" name="email" value="{{ auth()->user()->email }}" disabled/>
        </div>
    </div>


</x-layout>
<x-footer> </x-footer>  