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
			<i class="fas fa-city"></i>Добави ново населено място
		</div>
	</div>
	
	<div class="card-body">
		<div class="tab-content">
			<div>
				@include('includes.validation_errors')
				<form method="POST" action="{{ url('cities') }}">
					@csrf

                    <div class="form-group row">
                        <label for="name" class="col-md-3 col-form-label text-md-right">Име *</label>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="type" class="col-md-3 col-form-label text-md-right">
                            Тип населено място *
                        </label>
                        <div class="col-md-6">
                            <div class="form-check">
                                <input type="radio" name="type" class="form-check-input" value="1" id="1"  required> 
                                <label class="form-check-label" for="1">град</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="type" class="form-check-input" value="2" id="2"  required> 
                                <label class="form-check-label" for="2">село</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="region_id" class="col-md-3 col-form-label text-md-right">Регион *</label>
                        <div class="col-md-4">
                            <select name="region_id" id="region_id" class="form-control" required>
                                <option value=""> --- Изберете регион ---</option>
                                @foreach($regions as $region)
                                <?php $selected = Helper::is_selected(old('region_id'), $region->id); ?>
                                <option value="{{$region->id}}" {{$selected}}> {{$region->name}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <a href="{{url('/cities')}}" class="btn btn-default">
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
            $('#region_id').select2();
        });  
    </script>
    @endsection