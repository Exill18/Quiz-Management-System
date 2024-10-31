<x-layout>
    <h1>{{ $quiz->title }}</h1>
    <p>{{ $quiz->description }}</p>

    <form action="{{ route('quizzes.shared.submit', $quiz->slug) }}" method="POST">
        @csrf
        <label for="username">Enter your username:</label>
        <input type="text" name="username" required>
        <button type="submit">Submit Quiz</button>
    </form>
</x-layout>


