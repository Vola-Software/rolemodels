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
			<i class="fas fa-school"></i>Промени училище
		</div>
	</div>
	
	<div class="card-body">
		<div class="tab-content">
			<div>
				@include('includes.validation_errors')
				<form method="POST" action='{{ url("schools/$school->id") }}'>
					@csrf
                    @method('PUT')

                    <div class="form-group row">
                        <label for="name" class="col-md-3 col-form-label text-md-right">Име *</label>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $school->name }}" required autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="website" class="col-md-3 col-form-label text-md-right">Сайт</label>
                        <div class="col-md-6">
                            <input id="website" type="url" class="form-control @error('website') is-invalid @enderror" name="website" value="{{ $school->website }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="city_id" class="col-md-3 col-form-label text-md-right">Населено място *</label>
                        <div class="col-md-4">
                            <select name="city_id" id="city_id" class="form-control" required>
                                <option value=""> --- Изберете населено място ---</option>
                                @foreach($cities as $city)
                                    <?php $selected = Helper::is_selected($school->city_id, $city->id); ?>
                                    <option value="{{$city->id}}" {{$selected}}> {{$city->name}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="address" class="col-md-3 col-form-label text-md-right">Адрес *</label>
                        <div class="col-md-6">
                            <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ $school->address }}" required>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <a href="{{url('/schools')}}" class="btn btn-default">
                                Откажи
                            </a>
                            <button type="submit" class="btn btn-success">
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
        $('#city_id').select2();
    });  
</script>
@endsection