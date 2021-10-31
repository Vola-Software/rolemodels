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
			<i class="fas fa-user-cog"></i> Профил
		</div>
	</div>
	
	<div class="card-body">
		<div class="tab-content">
			<div>
				@include('includes.validation_errors')
				<form method="POST" action="{{ url('profile/store') }}">
					@csrf
                    <input type="hidden" name="role_id" value="{{$user->role_id}}" />

                    <div class="form-group row">
                        <label for="first_name" class="col-md-1 col-form-label text-md-right">Име *</label>
                        <div class="col-md-3">
                            <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ $user->first_name }}" required autocomplete="name" autofocus>

                            @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <label for="middle_name" class="col-md-1 col-form-label text-md-right">Презиме</label>
                        <div class="col-md-3">
                            <input id="middle_name" type="text" class="form-control @error('middle_name') is-invalid @enderror" name="middle_name" value="{{ $user->middle_name }}" autocomplete="middle_name" >

                            @error('middle_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <label for="last_name" class="col-md-1 col-form-label text-md-right">Фамилия *</label>
                        <div class="col-md-3">
                            <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ $user->last_name }}" required autocomplete="last_name">

                            @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-md-4 col-form-label text-md-right">Телефон</label>
                        <div class="col-md-4">
                            <?php $required = $user->role_id === config('consts.ROLE_ID_TEACHER') ? 'required' : ''; ?>
                            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $user->phone }}" {{$required}} autocomplete="phone" autofocus>

                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    @if($user->role_id === config('consts.ROLE_ID_TEACHER'))
                        <div class="form-group row">
                           <label for="school_id" class="col-md-4 col-form-label text-md-right">Училище *</label>
                           <div class="col-md-4">
                               <select name="school_id" class="form-control" id="school_id" required>
                                   <option value="">--- Изберете училище ---</option>
                                   @foreach($data['schools'] as $school)
                                   <?php $selected = Helper::is_selected($data['teacher']->school_id, $school->id); ?>
                                   <option value="{{$school->id}}" {{$selected}}> {{$school->name}} </option>
                                   @endforeach
                               </select>

                               @error('school_id')
                               <span class="invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                               </span>
                               @enderror
                           </div>
                       </div>

                       <div class="form-group row">
                           <label for="subject_id" class="col-md-4 col-form-label text-md-right">Преподаван(и) предмет(и) *</label>
                           <div class="col-md-4">
                               <select name="subject_ids[]" class="form-control" id="subject_ids" multiple required>
                                   <option value="">--- Изберете предмет(и) ---</option>
                                   @foreach($data['subjects'] as $subject)
                                   <?php $selected = Helper::is_selected_multiple($subject->id, $data['teacher']->subjects->pluck('id')->toArray()); ?>
                                   <option value="{{$subject->id}}" {{$selected}}> {{$subject->name}} </option>
                                   @endforeach
                               </select>

                               @error('subject_ids')
                               <span class="invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                               </span>
                               @enderror
                           </div>
                       </div>
                   @elseif($user->role_id === config('consts.ROLE_ID_PROFESSIONAL'))
                       <div class="form-group row">
                            <label for="company_id" class="col-md-4 col-form-label text-md-right">Компания/Организация *</label>

                            <div class="col-md-4">
                                <select name="company_id" class="form-control" id="company_id" required>
                                    <option value="">--- Изберете компания ---</option>
                                    @foreach($data['companies'] as $company)
                                    <?php $selected = Helper::is_selected($data['professional']->company_id, $company->id); ?>
                                    <option value="{{$company->id}}" {{$selected}}> {{$company->name}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="position" class="col-md-4 col-form-label text-md-right">Длъжност/Дейност *</label>

                            <div class="col-md-4">
                                <input id="position" type="text" class="form-control" name="position" value="{{$data['professional']->position}}" required>
                            </div>
                        </div>
                @endif

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-success">
                            Запиши
                        </button>
                    </div>
                </div>
              </form>

              <hr>
              <form method="POST" action='{{ url("profile/delete/$user->id") }}'>
                @csrf
                @method('DELETE')

                <div class="form-group row mb-0">
                  <div class="col-md-6 offset-md-3">
                      <label for="confirm_delete" class="col-md-8 col-form-label text-md-right">За да изтриете профила си моля въведете думата 'delete'</label>
                      <div class="col-md-3">
                          <input id="confirm_delete" type="text" class="form-control @error('confirm_delete') is-invalid @enderror" name="confirm_delete" required >
                          @error('confirm_delete')
                             <span class="invalid-feedback" role="alert">
                                 <strong>{{ $message }}</strong>
                             </span>
                          @enderror
                      </div>
                  </div>
                </div>
                <p></p>

                  <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <input type="submit" name="delete" value="Изтрий" class="btn btn-danger">
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