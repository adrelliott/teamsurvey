<x-participants-layout>
	<h1 class="text-2xl mb-3">Survey: {{ $survey->name }}</h1>
	<p class="text-xl font-bold">This is section: {{ $currentSection->name }}</p>
	<small class="text-sm">Section {{ $currentSection->order }} of {{ $totalSections}}</small>
	@forelse($questions as $question)
		<p class="text-lg">Q{{ $question->order }}: {{ $question->question }}</p>
		<small class="text-xs mb-3">{{ $question->description }}</small>
	@empty
		<p>No questions found</p>
	@endforelse
</x-participants-layout>
