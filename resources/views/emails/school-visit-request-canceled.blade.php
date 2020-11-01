<h1> Вашата заявка за посещение от ролеви модел беше отменена! </h1>
<p></p>
<h2>Детайли за заявката:</h2>

<div>
	<p><strong> Клас: </strong> {{$schoolVisitRequest->classStage->name}} </p>
	<p><strong>"Ролеви модел" от коя сфера искаш да ви псоети: </strong>{{$schoolVisitRequest->role_model_profession}}</p>
	<p><strong>Удобно време за посещение: </strong> {{$schoolVisitRequest->visit_time}}</p>
	<p><strong>Брой ученици, които биха взели участие: </strong> {{$schoolVisitRequest->potential_participants_count}}</p>
	<p><strong>Специфика на учениците: </strong> {{$schoolVisitRequest->students_details}}</p>
</div>

@component('mail::button', ['url' => $url])
	Виж детайли
@endcomponent