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
			<i class="fas fa-rocket"></i>Попълни анкета за посещение
		</div>
	</div>

    <div class="card-body">
        <div class="tab-content">
            <div>
                <strong> Клас: </strong> {{$schoolVisit->schoolVisitRequest->classStage->name}}, {{$schoolVisit->schoolVisitRequest->classMajor->name}}
            </div>
            <div>
                <strong> Ролеви модел: </strong> {{$schoolVisit->professional->user->name}}, 
                    {{$schoolVisit->professional->position}}
                    от {{$schoolVisit->professional->company->name}}
            </div>
            @if(!empty($schoolVisit->date))
                <div>
                    <strong> Дата: </strong> {{$schoolVisit->date}}
                </div>
            @endif
        </div>
    </div>	
    <hr>

	<div class="card-body">
		<div class="tab-content">
			<div>
				@include('includes.validation_errors')
				<form method="POST" action="{{ url('teacher-poll-submit') }}">
					@csrf
                    <input type="hidden" name="school_visit_id" value="{{$schoolVisit->id}}">
                    <div class="form-group row">
                        <label for="did_happen" class="col-md-4 col-form-label text-md-right">Случи ли се посещението? *</label>
                        <div class="col-md-6">
                            <?php $checked = Helper::is_checked(old('did_happen'), 1); ?>
                            <div class="form-check">
                                <input type="radio" name="did_happen" class="form-check-input did_happen" value="1" id="did_happen_yes" {{$checked}} required>
                                <label class="form-check-label" for="did_happen_yes">Да</label>
                            </div>
                            <?php $checked = Helper::is_checked(old('did_happen'), -1); ?>
                            <div class="form-check">
                                <input type="radio" name="did_happen" class="form-check-input did_happen" value="-1" id="did_happen_no" {{$checked}} required>
                                <label class="form-check-label" for="did_happen_no">Не</label>
                            </div>
                        </div>
                    </div>


                    <span id="failedVisit">
                        <div class="form-group row">
                            <label for="why_failed" class="col-md-4 col-form-label text-md-right">Защо не се състоя посещението? *</label>
                            <div class="col-md-6">
                                <input id="why_failed" type="text" class="form-control @error('why_failed') is-invalid @enderror" name="why_failed" value="{{ old('why_failed') }}" maxlength="500">
                            </div>
                        </div>
                    </span>

                    <span id="accomplishedVisit">
                        @if(empty($schoolVisit->date))
                            <div class="form-group row">
                                <label for="visit_date" class="col-md-4 col-form-label text-md-right">Дата на посещение? *</label>
                                <div class="col-md-3">
                                    <input id="visit_date" type="date" class="form-control @error('visit_date') is-invalid @enderror" name="visit_date" value="{{ old('visit_date') }}">
                                </div>
                            </div>
                        @endif

                        <div class="form-group row">
                            <label for="useful_rate" class="col-md-4 col-form-label text-md-right">До каква степен посещението беше полезно за учениците и отговори на очакванията на класа? *</label>
                            <div class="col-md-6">
                                <?php $checked = Helper::is_checked(old('useful_rate'), 1); ?>
                                <div class="form-check">
                                    <input type="radio" name="useful_rate" class="form-check-input" value="1" id="useful_rate_1" {{$checked}}>
                                    <label class="form-check-label" for="useful_rate_1">1 - Не им беше полезно</label>
                                </div>
                                <?php $checked = Helper::is_checked(old('useful_rate'), 2); ?>
                                <div class="form-check">
                                    <input type="radio" name="useful_rate" class="form-check-input" value="2" id="useful_rate_2" {{$checked}}>
                                    <label class="form-check-label" for="useful_rate_2">2</label>
                                </div>
                                <?php $checked = Helper::is_checked(old('useful_rate'), 3); ?>
                                <div class="form-check">
                                    <input type="radio" name="useful_rate" class="form-check-input" value="3" id="useful_rate_3" {{$checked}}>
                                    <label class="form-check-label" for="useful_rate_3">3</label>
                                </div>
                                <?php $checked = Helper::is_checked(old('useful_rate'), 4); ?>
                                <div class="form-check">
                                    <input type="radio" name="useful_rate" class="form-check-input" value="4" id="useful_rate_4" {{$checked}}>
                                    <label class="form-check-label" for="useful_rate_4">4</label>
                                </div>
                                <?php $checked = Helper::is_checked(old('useful_rate'), 5); ?>
                                <div class="form-check">
                                    <input type="radio" name="useful_rate" class="form-check-input" value="1" id="useful_rate_5" {{$checked}}>
                                    <label class="form-check-label" for="useful_rate_5">5 - Беше много полезно</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="most_valuable" class="col-md-4 col-form-label text-md-right">Най-ценното нещо за теб и твоите ученици след тази среща е?</label>
                            <div class="col-md-6">
                                <textarea name="most_valuable" class="col-md-12">{{old('most_valuable')}}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="invite_rm_again" class="col-md-4 col-form-label text-md-right">Би ли поканил/а ролеви модел в класната си стая отново?</label>
                            <div class="col-md-6">
                                <?php $checked = Helper::is_checked(old('invite_rm_again'), 1); ?>
                                <div class="form-check">
                                    <input type="radio" name="invite_rm_again" class="form-check-input" value="1" id="invite_rm_again_yes" {{$checked}}>
                                    <label class="form-check-label" for="invite_rm_again_yes">Да</label>
                                </div>
                                <?php $checked = Helper::is_checked(old('invite_rm_again'), -1); ?>
                                <div class="form-check">
                                    <input type="radio" name="invite_rm_again" class="form-check-input" value="-1" id="invite_rm_again_no" {{$checked}}>
                                    <label class="form-check-label" for="invite_rm_again_no">Не</label>
                                </div>
                            </div>
                        </div>

                        <span id="why_not_inviting_section">
                            <div class="form-group row">
                                <label for="why_not_inviting_againt" class="col-md-4 col-form-label text-md-right">Защо не би поканил ролеви модел отново?</label>
                                <div class="col-md-6">
                                    <textarea name="why_not_inviting_againt" class="col-md-12">{{old('why_not_inviting_againt')}}</textarea>
                                </div>
                            </div>
                        </span>


                        <div class="form-group row">
                            <label for="next_steps" class="col-md-4 col-form-label text-md-right">Планира ли следващи стъпки с учениците си след посещението на ролевия модел и ако да - какви са те?</label>
                            <div class="col-md-6">
                                <textarea name="next_steps" class="col-md-12">{{old('next_steps')}}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="improvement_suggestions" class="col-md-4 col-form-label text-md-right">Какво би подобрил/а в процеса?</label>
                            <div class="col-md-6">
                                <textarea name="improvement_suggestions" class="col-md-12">{{old('improvement_suggestions')}}</textarea>
                            </div>
                        </div>
                    </span>
                    

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
        $('#failedVisit').hide();
        $('#accomplishedVisit').hide();

        $( ".did_happen" ).change(function() {
          var didHappen = $('input[name="did_happen"]:checked').val();

          if(didHappen == -1) {
            $('#failedVisit').show();
            $('#accomplishedVisit').hide();
          } else {
            $('#failedVisit').hide();
            $('#accomplishedVisit').show();
          }
        });
    });  
</script>
@endsection