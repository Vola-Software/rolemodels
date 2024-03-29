@extends('layouts.admin')

@section('header_scripts')
<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
@endsection

@section('content')
@include('includes.flash_msgs')
<div class="main-card mb-3 card mt-4">
	<div class="card-header-tab card-header-tab-animation card-header">
		<div class="card-header-title font-size-lg text-capitalize font-weight-normal">
			<i class="fas fa-rocket"></i>Създай заявка за посещение от ролеви модел
		</div>
	</div>
	
	<div class="card-body">
		<div class="tab-content">
			<div>
				@include('includes.validation_errors')
				<form method="POST" action="{{ url('visits') }}">
					@csrf

                    <div class="form-group row">
                        <label for="teacher_status" class="col-md-4 col-form-label text-md-right">Аз съм *</label>
                        <div class="col-md-4">
                            <select name="teacher_status" id="teacher_status" class="form-control" required>
                                <option value=""> --- Изберете опция ---</option>
                                @foreach($teacherStatuses as $key => $value)
                                    <?php $selected = Helper::is_selected(old('teacher_status'), $key); ?>
                                    <option value="{{$key}}" {{$selected}}> {{$value}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone_calls_time" class="col-md-4 col-form-label text-md-right">Удобно време за телефонен разговор (при необходимност) *</label>
                        <div class="col-md-6">
                            <input id="phone_calls_time" type="text" class="form-control @error('phone_calls_time') is-invalid @enderror" name="phone_calls_time" value="{{ old('phone_calls_time') }}" maxlength="250" required autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="class_stage_id" class="col-md-4 col-form-label text-md-right">В кой клас са учениците, с които ще срещне ролевият модел? *</label>
                        <div class="col-md-4">
                            <select name="class_stage_id" id="class_stage_id" class="form-control" required>
                                <option value=""> --- Изберете класове ---</option>
                                @foreach($classStages as $classStage)
                                    <?php $selected = Helper::is_selected(old('class_stage_id'), $classStage->id); ?>
                                    <option value="{{$classStage->id}}" {{$selected}}> {{$classStage->name}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="students_details" class="col-md-4 col-form-label text-md-right">Специфика на учениците? *</label>
                        <div class="col-md-6">
                            <textarea id="students_details" name="students_details" class="form-control" maxlength="1200" rows="3" placeholder="разкажете ни повече за учениците : какви са техните интереси, профил, занимания. Каква е целта на посещението на ролеви модел в класната стая? Тази информация ще помогне на ролевия модел да избере посещението си" required>{{old('students_details')}}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="role_model_profession_id" class="col-md-4 col-form-label text-md-right">Сфера на ролеви модел: *</label>
                        <div class="col-md-6">
                            <select name="role_model_profession_id" id="role_model_profession_id" class="form-control">
                                <option value=""> --- Изберете сфера на ролеви модел ---</option>
                                @foreach($roleModelProfessions as $roleModelProfession)
                                    <?php $selected = Helper::is_selected(old('role_model_profession_id'), $roleModelProfession->id); ?>
                                    <option value="{{$roleModelProfession->id}}" {{$selected}}> {{$roleModelProfession->name}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="meeting_type" class="col-md-4 col-form-label text-md-right">Тип посещение: *</label>
                        <div class="col-md-6">
                            @foreach($meetingTypes as $key => $value)
                                <?php $checked = Helper::is_checked(old('meeting_type'), $key); ?>
                                <div class="form-check">
                                    <input type="radio" name="meeting_type" class="form-check-input" value="{{$key}}" id="{{$key}}" {{$checked}} required>
                                    <label class="form-check-label" for="{{$key}}">{{$value}}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="visit_time" class="col-md-4 col-form-label text-md-right">Удобно време за посещение - ден и час *</label>
                        <div class="col-md-8">
                            <input id="visit_time" type="text" class="form-control @error('visit_time') is-invalid @enderror" name="visit_time" value="{{ old('visit_time') }}" maxlength="250" placeholder="кога имаш часове с този клас или кое е удобно извънкласно време; можеш да добавиш няколко опции" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="potential_participants_count" class="col-md-4 col-form-label text-md-right">
                            Брой ученици, които биха взели участие *
                        </label>
                        <div class="col-md-6">
                            @foreach($participantsCount as $key => $value)
                                <?php $checked = Helper::is_checked(old('potential_participants_count'), $key); ?>
                                <div class="form-check">
                                    <input type="radio" name="potential_participants_count" class="form-check-input" value="{{$key}}" id="{{$key}}" {{$checked}} required> 
                                    <label class="form-check-label" for="{{$key}}">{{$value}}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tech_equipment" class="col-md-4 col-form-label text-md-right">Техническо оборудване: </label>
                        <div class="col-md-8">
                            <input id="tech_equipment" type="text" class="form-control @error('tech_equipment') is-invalid @enderror" name="tech_equipment" value="{{ old('tech_equipment') }}" placeholder="мултимедия, телевизор, тон колонки, друго, което би било необходимо за срещата">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="teacher_notes" class="col-md-4 col-form-label text-md-right">Допълнителни бележки</label>
                        <div class="col-md-6">
                            <textarea id="teacher_notes" name="teacher_notes" class="form-control" maxlength="1200" rows="3" placeholder="Има ли нещо друго, което искаш да споделиш?">{{old('teacher_notes')}}</textarea>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <a href="{{url('/visits')}}" class="btn btn-default">
                                Откажи
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Запиши
                            </button>
                        </div>
                    </div>
				</form>
				</div>
			</div>
		</div>

@endsection

@section('footer_scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('#subject_ids').select2();
    });  
</script>
@endsection