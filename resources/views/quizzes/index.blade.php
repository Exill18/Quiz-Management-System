<x-layout>
    <div class="create-quiz ">
        <a href="{{ route('quizzes.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create a New Quiz</a>
    </div>

    <div class="available-quizzes mt-8">
        <h1 class="text-2xl font-bold mb-4">Available Quizzes</h1>
        @foreach($quizzes as $quiz)
            <div class="bg-white shadow-md rounded-lg p-6 mb-4">
                <h2 class="text-xl font-semibold mb-2">{{ $quiz->title }}</h2>
                <p class="text-gray-700 mb-4">{{ $quiz->description }}</p>
                <a href="{{ route('quizzes.show', $quiz) }}" class="text-blue-500 hover:underline">Take Quiz</a>
                <p class="text-gray-500 mt-2">Tags: {{ $quiz->tags->pluck('name')->join(', ') }}</p>
            </div>
        @endforeach
    </div>
</x-layout>