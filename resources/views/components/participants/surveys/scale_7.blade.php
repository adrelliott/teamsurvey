@props(['question_no'])
<!-- components.participants.surveys.scale_7 -->
<div>
	<div class="main flex overflow-hidden m-4 select-none">
		<div class="title py-3 my-auto px-5 bg-blue-500 text-white text-sm font-semibold mr-3">Gender</div>
		<label class="flex flex-wrap radio p-2 cursor-pointer">
			<input type="radio" name="{{ $questionNo }}[]" class="my-auto transform scale-125" />
			<div class="title px-2">Very Unlikely</div>
		</label>
		<label class="flex radio p-2 cursor-pointer">
			<input type="radio" name="{{ $questionNo }}[]" class="my-auto transform scale-125" />
			<div class="title px-2">Unlikely</div>
		</label>
		<label class="flex radio p-2 cursor-pointer">
			<input type="radio" name="{{ $questionNo }}[]" class="my-auto transform scale-125" />
			<div class="title px-2">Quite unlikely</div>
		</label>
		<label class="flex radio p-2 cursor-pointer">
			<input type="radio" name="{{ $questionNo }}[]" class="my-auto transform scale-125" />
			<div class="title px-2">Don't know</div>
		</label>
		<label class="flex radio p-2 cursor-pointer">
			<input type="radio" name="{{ $questionNo }}[]" class="my-auto transform scale-125" />
			<div class="title px-2">Quite likely</div>
		</label>

		<label class="flex radio p-2 cursor-pointer">
			<input type="radio" name="{{ $questionNo }}[]" class="my-auto transform scale-125" />
			<div class="title px-2">Likely</div>
		</label>
		<label class="flex radio p-2 cursor-pointer">
			<input type="radio" name="{{ $questionNo }}[]" class="my-auto transform scale-125" />
			<div class="title px-2">Very likely</div>
		</label>
	</div>
</div>
<!-- /components.participants.surveys.scale_7 -->
