@props(['question'])
<div class="mt-4">
	<div class="flex flex-wrap">
		<div class="flex items-center mr-4">
			<input name="responses[{{ $question->id }}]" type="radio" id="option1" value=1 responseType="integer" class="appearance-none w-6 h-6 border border-gray-300 rounded-full outline-none cursor-pointer checked:bg-blue-400" required>
			<label class="ml-2 text-sm" for="option1">Very unlikely</label>
		</div>
		<div class="flex items-center mr-4">
			<input name="responses[{{ $question->id }}]" type="radio" id="option2" value=2 responseType="integer" class="appearance-none w-6 h-6 border border-gray-300 rounded-full outline-none cursor-pointer checked:bg-blue-400" required >
			<label class="ml-2 text-sm" for="option2">Somewhat likely</label>
		</div>
		<div class="flex items-center mr-4">
			<input name="responses[{{ $question->id }}]" type="radio" id="option3" value=3 responseType="integer" class="appearance-none w-6 h-6 border border-gray-300 rounded-full outline-none cursor-pointer checked:bg-blue-400" required>
			<label class="ml-2 text-sm" for="option3">Don't know</label>
		</div>
		<div class="flex items-center mr-4">
			<input name="responses[{{ $question->id }}]" type="radio" id="option4" value=4 responseType="integer" class="appearance-none w-6 h-6 border border-gray-300 rounded-full outline-none cursor-pointer checked:bg-blue-400" required>
			<label class="ml-2 text-sm" for="option4">Somewhat likely</label>
		</div>
		<div class="flex items-center mr-4">
			<input name="responses[{{ $question->id }}]" type="radio" id="option5" value=5 responseType="integer" class="appearance-none w-6 h-6 border border-gray-300 rounded-full outline-none cursor-pointer checked:bg-blue-400" required>
			<label class="ml-2 text-sm" for="option5">Very likely</label>
		</div>
	</div>
</div>

