<!-- resources/views/quizzes/show.blade.php -->

<x-layout>
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-lg mt-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $quiz->title }}</h1>
        <p class="text-gray-600 mb-6">{{ $quiz->description }}</p>

        <form action="{{ route('quizzes.submit', $quiz) }}" method="POST" class="space-y-4">
            @csrf

            <!-- User's Name Input -->
            <div class="mb-6">
                <label for="username" class="block text-sm font-medium text-gray-700 mb-2">Enter your name:</label>
                <input 
                    type="text" 
                    name="username" 
                    id="username" 
                    required 
                    class="block w-full border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                >
            </div>

            <!-- Display Exercises with Numbering -->
            @foreach ($quiz->exercises as $index => $exercise)
                <div class="mb-4">
                    <h2 class="text-lg font-semibold text-gray-700">Question {{ $index + 1 }}</h2>
                    <p class="text-gray-800">{{ $exercise->question }}</p>
                    
                    <!-- Answer Input -->
                    <input 
                        type="text" 
                        name="answers[{{ $exercise->id }}]" 
                        placeholder="Your answer..." 
                        class="mt-2 block w-full border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    >
                </div>
            @endforeach

            <div class="flex justify-end">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-4 py-2 rounded-md">Submit Quiz</button>
            </div>
        </form>
    </div>
</x-layout>
