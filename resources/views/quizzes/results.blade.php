<!-- resources/views/quizzes/results.blade.php -->

<x-layout>
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-lg mt-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Results for {{ $quiz->title }}</h1>

        <ul class="space-y-3">
            @forelse($results as $result)
                <li class="flex justify-between p-4 border border-gray-300 rounded-md">
                    <span class="font-semibold">{{ $result->username }}</span>
                    <span class="text-indigo-600 font-medium">Score: {{ $result->score }}</span>
                </li>
            @empty
                <p class="text-gray-600">No results available for this quiz yet.</p>
            @endforelse
        </ul>
    </div>
</x-layout>
