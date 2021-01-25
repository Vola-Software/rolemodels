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
                <strong> Училище: </strong> {{$schoolVisit->schoolVisitRequest->teacher->school->name}}, 
                    {{$schoolVisit->schoolVisitRequest->teacher->school->city->name}}
            </div>
            <div>
                <strong> Клас: </strong> {{$schoolVisit->schoolVisitRequest->classStage->name}}, {{$schoolVisit->schoolVisitRequest->classMajor->name}}
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
				<form method="POST" action="{{ url('rolemodel-poll-submit') }}">
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
                        <div class="form-group row">
                            <label for="satisfaction_rate" class="col-md-4 col-form-label text-md-right">Как би оценил преживяването? *</label>
                            <div class="col-md-6">
                                <?php $checked = Helper::is_checked(old('satisfaction_rate'), 1); ?>
                                <div class="form-check">
                                    <input type="radio" name="satisfaction_rate" class="form-check-input" value="1" id="satisfaction_rate_1" {{$checked}}>
                                    <label class="form-check-label" for="satisfaction_rate_1">1 - не ми допадна изобщо</label>
                                </div>
                                <?php $checked = Helper::is_checked(old('satisfaction_rate'), 2); ?>
                                <div class="form-check">
                                    <input type="radio" name="satisfaction_rate" class="form-check-input" value="2" id="satisfaction_rate_2" {{$checked}}>
                                    <label class="form-check-label" for="satisfaction_rate_2">2</label>
                                </div>
                                <?php $checked = Helper::is_checked(old('satisfaction_rate'), 3); ?>
                                <div class="form-check">
                                    <input type="radio" name="satisfaction_rate" class="form-check-input" value="3" id="satisfaction_rate_3" {{$checked}}>
                                    <label class="form-check-label" for="satisfaction_rate_3">3</label>
                                </div>
                                <?php $checked = Helper::is_checked(old('satisfaction_rate'), 4); ?>
                                <div class="form-check">
                                    <input type="radio" name="satisfaction_rate" class="form-check-input" value="4" id="satisfaction_rate_4" {{$checked}}>
                                    <label class="form-check-label" for="satisfaction_rate_4">4</label>
                                </div>
                                <?php $checked = Helper::is_checked(old('satisfaction_rate'), 5); ?>
                                <div class="form-check">
                                    <input type="radio" name="satisfaction_rate" class="form-check-input" value="1" id="satisfaction_rate_5" {{$checked}}>
                                    <label class="form-check-label" for="satisfaction_rate_5">5 - беше чудесно</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="most_valuable" class="col-md-4 col-form-label text-md-right">Какво ти хареса най-много?</label>
                            <div class="col-md-6">
                                <textarea name="most_valuable" class="col-md-12">{{old('most_valuable')}}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="improvement_suggestions" class="col-md-4 col-form-label text-md-right">Какво би подобрил/а в процеса?</label>
                            <div class="col-md-6">
                                <textarea name="improvement_suggestions" class="col-md-12">{{old('improvement_suggestions')}}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="rolemodel_again" class="col-md-4 col-form-label text-md-right">Би ли се включил като ролеви модел в класна стая отново?</label>
                            <div class="col-md-6">
                                <?php $checked = Helper::is_checked(old('rolemodel_again'), 1); ?>
                                <div class="form-check">
                                    <input type="radio" name="rolemodel_again" class="form-check-input" value="1" id="rolemodel_again_yes" {{$checked}}>
                                    <label class="form-check-label" for="rolemodel_again_yes">Да</label>
                                </div>
                                <?php $checked = Helper::is_checked(old('rolemodel_again'), -1); ?>
                                <div class="form-check">
                                    <input type="radio" name="rolemodel_again" class="form-check-input" value="-1" id="rolemodel_again_no" {{$checked}}>
                                    <label class="form-check-label" for="rolemodel_again_no">Не</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="other_tfb_initiatives" class="col-md-4 col-form-label text-md-right">Би ли участвал/а и в други инициативи на “Заедно в час”?</label>
                            <div class="col-md-6">
                                <?php $checked = Helper::is_checked(old('other_tfb_initiatives'), 1); ?>
                                <div class="form-check">
                                    <input type="radio" name="other_tfb_initiatives" class="form-check-input" value="1" id="other_tfb_initiatives_yes" {{$checked}}>
                                    <label class="form-check-label" for="other_tfb_initiatives_yes">Да</label>
                                </div>
                                <?php $checked = Helper::is_checked(old('other_tfb_initiatives'), -1); ?>
                                <div class="form-check">
                                    <input type="radio" name="other_tfb_initiatives" class="form-check-input" value="-1" id="other_tfb_initiatives_no" {{$checked}}>
                                    <label class="form-check-label" for="other_tfb_initiatives_no">Не</label>
                                </div>
                            </div>
                        </div>
                    </span>
                    

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <a href="{{url('/my-visits')}}" class="btn btn-default">
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