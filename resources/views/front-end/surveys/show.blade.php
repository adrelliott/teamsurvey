<x-participants-layout>
<div class="">
	<h1 class="text-2xl mb-3">Survey: {{ $survey->name }}</h1>
		<p class="text-xl font-bold">{{ $survey->sections[$survey->current_section]->name }}</p>
		<small class="text-sm">Part {{ $survey->current_section + 1 }} of {{ $survey->sections_count}}</small>
		<form method="POST" action="{{ route('ask.store', ['invitation' => $invitation->invite_hash]) }}" >
			@csrf
			<input type="text" name="c" value="{{ $survey->current_section }}">
			<input type="text" name="t" value="{{ $survey->sections_count }}">
			@forelse($survey->sections[$survey->current_section]->questions as $question)
				<x-front-end.surveys.question>
					<p class="text-lg">Q{{ $question->order }}: {{ $question->question }} (Qid={{ $question->id }})</p>
					<small class="text-xs mb-3">{{ $question->description }}</small>
					<x-front-end.surveys.scale_5 :question="$question"/>
				</x-front-end.surveys.question>
			@empty
				<p>No questions found</p>
			@endforelse
			<div class="text-right mr-20">
				<button type="submit" class="l px-16 py-2 my-2 mr-2 text-base text-white transition duration-500 ease-in-out transform bg-blue-600 border-blue-600 rounded-md focus:shadow-outline focus:outline-none focus:ring-2 ring-offset-current ring-offset-2 hover:bg-blue-800 "> Submit </button>
			</div>
		</div>
	<div>total sections: {{ $survey->sections_count }}</div>
	<div>current section id: {{ $survey->current_section }}</div>
	<div class="mb-12"></div>
</x-participants-layout>
