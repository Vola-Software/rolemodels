<1> Вашата заявка за посещение от ролеви модел беше приета! </h1>

<div>
	Ролеви модел: 
	@if($schoolVisit->professional && $schoolVisit->professional->user)
		{{$schoolVisit->professional->user->fullNames}}
	@else
		-
	@endif
</div>

@component('mail::button', ['url' => $url])
	Виж детайли
@endcomponent