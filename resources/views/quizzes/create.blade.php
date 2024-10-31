<!-- resources/views/quizzes/create.blade.php -->

<x-layout>
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-lg mt-6">
        <h2 class="text-2xl font-bold mb-4">Create a New Quiz</h2>

        <form action="{{ route('quizzes.store') }}" method="POST" id="quizForm">
            @csrf

            <!-- Title and Description Fields -->
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm"></textarea>
            </div>

            <!-- Tags Field -->
            <div class="mb-4">
                <label for="tags" class="block text-sm font-medium text-gray-700">Tags (separate by commas)</label>
                <input type="text" name="tags" placeholder="technology, lifestyle" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
            </div>

            <!-- Exercise Fields with Solution and Score -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Exercises</label>
                <div id="exerciseContainer">
                    <div class="exercise mb-4">
                        <input type="text" name="exercises[0][question]" placeholder="Enter exercise question" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
                        <input type="text" name="exercises[0][solution]" placeholder="Enter solution" class="mt-2 block w-full border border-gray-300 rounded-md shadow-sm" required>
                        <input type="number" name="exercises[0][score]" placeholder="Enter score" class="mt-2 block w-24 border border-gray-300 rounded-md shadow-sm" required>
                    </div>
                </div>
                <button type="button" id="addExercise" class="mt-2 text-indigo-600">Add Another Exercise</button>
            </div>

            <div class="flex justify-end mt-6">
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md">Create Quiz</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('addExercise').addEventListener('click', function() {
            const container = document.getElementById('exerciseContainer');
            const index = container.children.length;
            const exerciseField = document.createElement('div');
            exerciseField.className = 'exercise mb-4';
            exerciseField.innerHTML = `
                <input type="text" name="exercises[${index}][question]" placeholder="Enter exercise question" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
                <input type="text" name="exercises[${index}][solution]" placeholder="Enter solution" class="mt-2 block w-full border border-gray-300 rounded-md shadow-sm" required>
                <input type="number" name="exercises[${index}][score]" placeholder="Enter score" class="mt-2 block w-24 border border-gray-300 rounded-md shadow-sm" required>
            `;
            container.appendChild(exerciseField);
        });
    </script>
</x-layout>
