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
			<i class="fas fa-school"></i>Училища
        </div>
	</div>
	
	<div class="card-body">
        <div class="tab-content">
            <div>
                <a href="{{url('schools/create')}}" class="btn-shadow btn btn-wide btn-success" id="btn-add-visit">
                    <span class="btn-icon-wrapper pr-1 opacity-7">
                        <i class="fa fa-plus"></i>
                    </span>
                    Добави училище 
                </a>

				<table style="width: 100%;" id="schoolsTable" class="table table-hover table-striped table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th>№</th>
                            <th>Училище</th>
                            <th>Сайт</th>
                            <th>Населено място</th>
                            <th>Адрес</th>
                            <th>Брой учители</th>
                            <th>Брой заявки</th>
                            <th>Дата на регистрация</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($schools as $school)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$school->name}}</td>
                                <td>
                                    @if($school->website)
                                        <a href="{{$school->website}}" target="_blank"> {{$school->website}} </a>
                                    @endif
                                </td>
                                <td>{{$school->city->name}}</td>
                                <td>{{$school->address}}</td>
                                <td>
                                    @if($school->teachers)
                                        {{$school->teachers->count()}}
                                    @endif
                                </td>
                                <td>
                                    
                                </td>
                                <td>{{$school->created_at}}</td>
                                <td>
                                    @if($school->is_approved == 0)
                                        <form action='{{ url("/schools/$school->id/approve") }}' method="POST">
                                            @csrf
                                            <button class="btn btn-warning approveBtn" title="Потвърди"> Потвърди </button>
                                        </form>
                                    @endif

                                    <a href='{{url("/schools/$school->id/edit")}}' class="btn btn-success" title="Промени"> <i class="fas fa-pencil-alt"></i> </a>
                                    <form action='{{ url("/schools/$school->id") }}' method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-warning deleteBtn" title="Изтрий"> <i class="fas fa-trash-alt"></i> </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td></td>
                                <td colspan="8">Няма регистрирани училища!</td>
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
        $('#schoolsTable').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Bulgarian.json"
            },
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

        $('.approveBtn').on('click',function(e){
            let answer = confirm('Сигурни ли сте, че искате да потвърдите това училище?');

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