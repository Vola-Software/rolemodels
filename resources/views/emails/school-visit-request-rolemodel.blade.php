<p>
	Благодарим ти, че искаш бъдеш ролеви модел в класна стая! 
</p>

<p> 
	Учителят очаква да се свържеш с него, ще намериш координатите му по-долу. Молим те да осъществите контакт в следващите 2 седмици, за да можете да планирате от рано посещението, което е препоръчително да се случи в рамките на учебния срок. Срещите с ролеви модели са изключително вълнуващи за учениците и ти благодарим да подходиш към тях като към професионален ангажимент. 
</p>

<p>
	Учител:
	@if($schoolVisitRequest->teacher && $schoolVisitRequest->teacher->user)
		{{$schoolVisitRequest->teacher->user->fullNames}}, 
		{{$schoolVisitRequest->teacher->user->email}}, 
		{{$schoolVisitRequest->teacher->user->phone}}
	@else
		-
	@endif
</p>

<p>
	Ако срещаш трудности в комуникацията или имаш нужда от допълнителна информация, свържи се с нас на role_models@zaednovchas.bg
</p>

<p>
	<div>Поздрави,</div>
	Екип “Ролеви модели”
</p>