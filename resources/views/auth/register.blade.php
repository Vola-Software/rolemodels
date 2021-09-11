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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3> Регистрация </h3></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <input type="hidden" name="role" value="{{$role}}"/>

                        <div class="form-group row">
                            <label for="first_name" class="col-md-1 col-form-label text-md-right">Име *</label>
                            <div class="col-md-3">
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="name" autofocus>

                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="middle_name" class="col-md-1 col-form-label text-md-right">Презиме</label>
                            <div class="col-md-3">
                                <input id="middle_name" type="text" class="form-control @error('middle_name') is-invalid @enderror" name="middle_name" value="{{ old('middle_name') }}" autocomplete="middle_name" >

                                @error('middle_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="last_name" class="col-md-1 col-form-label text-md-right">Фамилия *</label>
                            <div class="col-md-3">
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name">

                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Ел. Поща *</label>
                            <div class="col-md-4">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">Телефон</label>
                            <div class="col-md-4">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" autocomplete="phone">

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Парола *</label>

                            <div class="col-md-4">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Повтори паролата *</label>

                            <div class="col-md-4">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        @if($role == 'teacher')
                            <div class="form-group row">
                                <label for="school_id" class="col-md-4 col-form-label text-md-right">Училище *</label>

                                <div class="col-md-4">
                                    <select name="school_id" class="form-control" id="school_id" required>
                                        <option value="">--- Изберете училище ---</option>
                                        @foreach($schools as $school)
                                            <?php $selected = Helper::is_selected(old('school_id'), $school->id); ?>
                                            <option value="{{$school->id}}" {{$selected}}> 
                                                {{$school->name}}

                                                @if($school->id != 9999)
                                                    ,
                                                    @if($school->city->type == 1)
                                                        гр.
                                                    @else
                                                        с.
                                                    @endif 
                                                    {{$school->city->name}}
                                                @endif 
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div id="new_school_section" style="display: none;">
                                <div class="form-group row">
                                    <label for="news_school_name" class="col-md-4 col-form-label text-md-right">Добавете ново училище </label>

                                    <div class="col-md-4">
                                        <input id="news_school_name" type="text" class="form-control @error('news_school_name') is-invalid @enderror" name="news_school_name" value="{{ old('news_school_name') }}" placeholder="Име на ново училище *">
                                    </div>

                                    <div class="col-md-4">
                                        <input id="news_school_website" type="url" class="form-control @error('news_school_name') is-invalid @enderror" name="news_school_website" value="{{ old('news_school_website') }}" placeholder="Уеб сайт на ново училище">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="offset-md-4 col-md-4">
                                        <select name="new_school_city_id" class="form-control city-select2" id="new_school_city_id">
                                            <option value="">--- Изберете населено място * ---</option>
                                            @foreach($cities as $city)
                                                <?php $selected = Helper::is_selected($city->id, old('new_school_city_id')); ?>
                                                <option value="{{$city->id}}" {{$selected}}> 
                                                    @if($city->type == 1)
                                                        град 
                                                    @else 
                                                        село
                                                    @endif
                                                    
                                                    {{$city->name}} 
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="subject_ids" class="col-md-4 col-form-label text-md-right">Преподаван(и) предмет(и) *</label>

                                <div class="col-md-4">
                                    <select name="subject_ids[]" class="form-control subjects-select2" id="subject_ids" multiple required>
                                        <option value="">--- Изберете предмет(и) ---</option>
                                        @foreach($subjects as $subject)
                                            <?php $selected = Helper::is_selected_multiple($subject->id, old('subject_ids')); ?>
                                            <option value="{{$subject->id}}" {{$selected}}> {{$subject->name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @else
                            <div class="form-group row">
                                <label for="company_id" class="col-md-4 col-form-label text-md-right">Компания/Организация *</label>

                                <div class="col-md-4">
                                    <select name="company_id" class="form-control" id="company_id" required>
                                        <option value="">--- Изберете компания ---</option>
                                        @foreach($companies as $company)
                                            <?php $selected = Helper::is_selected(old('company_id'), $company->id); ?>
                                            <option value="{{$company->id}}" {{$selected}}> {{$company->name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="position" class="col-md-4 col-form-label text-md-right">Длъжност/Дейност *</label>

                                <div class="col-md-4">
                                    <input id="position" type="text" class="form-control" name="position" value="{{old('position')}}" required>
                                </div>
                            </div>
                        @endif
                        

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Регистрирай се
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('footer_scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('#school_id').select2();
        $('#subject_ids').select2();
        $('#new_school_city_id').select2();

        $('#school_id').change(function() {
            var schoolId = $('#school_id').val();
            //if school is Other
            if(schoolId == 9999) {
                $('#new_school_section').show();
                $('#news_school_name').prop('required',true);
                $('#new_school_city_id').prop('required',true);
            } else {
                $('#news_school_name').val('');
                $('#news_school_website').val('');
                $('#new_school_city_id').val('');
                $('#news_school_name').prop('required',false);
                $('#new_school_city_id').prop('required',false);
                $('#new_school_section').hide();

            }
        });
    });  
</script>
@endsection
