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
                        <label for="teacher_status" class="col-md-6 col-form-label text-md-right">Аз съм *</label>
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
                        <label for="phone_calls_time" class="col-md-6 col-form-label text-md-right">Удобно време за телефонен разговор (при необходимност) *</label>
                        <div class="col-md-6">
                            <input id="phone_calls_time" type="text" class="form-control @error('phone_calls_time') is-invalid @enderror" name="phone_calls_time" value="{{ old('phone_calls_time') }}" maxlength="250" required autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="class_stage_id" class="col-md-6 col-form-label text-md-right">Клас, който желаеш да запишеш и "Ролевия модел" може да посети *</label>
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
                        <label for="class_major_id" class="col-md-6 col-form-label text-md-right">Ако учениците са гимназиален курс - моля запиши профила им.</label>
                        <div class="col-md-4">
                            <select name="class_major_id" id="class_major_id" class="form-control">
                                <option value=""> --- Изберете специалност ---</option>
                                @foreach($classMajors as $classMajor)
                                    <?php $selected = Helper::is_selected(old('class_major_id'), $classMajor->id); ?>
                                    <option value="{{$classMajor->id}}" {{$selected}}> {{$classMajor->name}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="students_details" class="col-md-6 col-form-label text-md-right">Специфика на учениците? (нещо, което желаеш "Ролевият модел" да знае предварително, специални потребности, интереси, цели на класната стая, личната ти визия...) *</label>
                        <div class="col-md-6">
                            <textarea id="students_details" name="students_details" class="form-control" maxlength="1200" required>{{old('students_details')}}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="role_model_profession" class="col-md-6 col-form-label text-md-right">"Ролеви модел" от коя сфера искаш да ви псоети? *</label>
                        <div class="col-md-6">
                            <input id="role_model_profession" type="text" class="form-control @error('role_model_profession') is-invalid @enderror" name="role_model_profession" value="{{ old('role_model_profession') }}" maxlength="190" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="meeting_type" class="col-md-6 col-form-label text-md-right">Как предпочиташ да се включи "Ролевият модел" *</label>
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
                        <label for="visit_time" class="col-md-6 col-form-label text-md-right">Удобно време за посещение - ден и час (кога имаш часове с този клас или кое е удобно извънкласно време; можеш да добавиш няколко възможности) *</label>
                        <div class="col-md-6">
                            <input id="visit_time" type="text" class="form-control @error('visit_time') is-invalid @enderror" name="visit_time" value="{{ old('visit_time') }}" maxlength="250" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="potential_participants_count" class="col-md-6 col-form-label text-md-right">
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
                        <label for="tech_equipment" class="col-md-6 col-form-label text-md-right">Училището има ли техническо оборудване? Ако да - какво? (мултимедия, телевизор, тон колонки, друго, което би било необходимо за срещата)</label>
                        <div class="col-md-6">
                            <input id="tech_equipment" type="text" class="form-control @error('tech_equipment') is-invalid @enderror" name="tech_equipment" value="{{ old('tech_equipment') }}">
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