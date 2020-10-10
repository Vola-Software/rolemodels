@extends('layouts.admin')

@section('header_scripts')
<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
@endsection

@section('content')
@include('includes.flash_msgs')
<div class="main-card mb-3 card mt-4">
	<div class="card-header-tab card-header-tab-animation card-header">
		<div class="card-header-title font-size-lg text-capitalize font-weight-normal">
			<i class="fas fa-city"></i>Населени места
        </div>
	</div>
	
	<div class="card-body">
        <div class="tab-content">
            <div>
                <a href="{{url('cities/create')}}" class="btn-shadow btn btn-wide btn-success" id="btn-add-visit">
                    <span class="btn-icon-wrapper pr-1 opacity-7">
                        <i class="fa fa-plus"></i>
                    </span>
                    Добави населено място 
                </a>

				<table style="width: 100%;" id="citiesTable" class="table table-hover table-striped table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th>№</th>
                            <th>Населено място</th>
                            <th>Регион</th>
                            <th>Брой училища</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cities as $city)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$city->name}}</td>
                                <td>{{$city->region->name}}</td>
                                <td>{{$city->schools->count()}}</td>
                                <td>
                                    <a href='{{url("/cities/$city->id/edit")}}' class="btn btn-success" title="Промени"> <i class="fas fa-pencil-alt"></i> </a>
                                    <form action='{{ url("/cities/$city->id") }}' method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-warning deleteBtn" title="Изтрий"> <i class="fas fa-trash-alt"></i> </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td></td>
                                <td colspan="4">Няма създадени населени места!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
			</div>
		</div>
	</div>
</div>
@endsection

@section('footer_scripts')
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" />
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('js/custom.js') }}"></script>

<script type="text/javascript">
    $(document).ready( function () {
        $('#citiesTable').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Bulgarian.json"
            }
        });

        $('.deleteBtn').on('click',function(e){
            let answer = confirm('Сигурни ли сте, че искате да изтриете този запис?');

            if(answer){
             $(this).parents("form").submit();
            }
            else{
             e.preventDefault();      
            }
        });
    });
</script>
@endsection