<x-participants-layout>
<div class="">
	<h1 class="text-2xl mb-3">Survey: {{ $survey->name }}</h1>
	<p class="text-xl font-bold">{{ $survey->current_section->name }}</p>
	<small class="text-sm">Part {{ $survey->current_section->order }} of {{ $survey->total_sections}}</small>
	<form method="POST" action="{{ route('section.store') }}" >
		@csrf
		<!-- <input type="text" name="p" value="{{ $invitation->participant_id }}"> -->
		<input type="text" name="i" value="{{ $invite_hash }}">
		<input type="text" name="fs" value="{{ $survey->finalSection }}">

		@forelse($survey->current_section->questions as $question)
			<x-participants.surveys.question>
				<p class="text-lg">Q{{ $question->order }}: {{ $question->question }} (Qid={{ $question->id }})</p>
				<small class="text-xs mb-3">{{ $question->description }}</small>
				<x-participants.surveys.scale_5 :question="$question"/>
			</x-participants.surveys.question>
		@empty
			<p>No questions found</p>
		@endforelse
		<div class="text-right mr-20">
			<button type="submit" class="l px-16 py-2 my-2 mr-2 text-base text-white transition duration-500 ease-in-out transform bg-blue-600 border-blue-600 rounded-md focus:shadow-outline focus:outline-none focus:ring-2 ring-offset-current ring-offset-2 hover:bg-blue-800 "> Submit </button>
		</div>
	</div>
	</x-participants-layout>
