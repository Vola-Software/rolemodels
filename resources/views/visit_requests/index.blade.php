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
			<i class="fas fa-rocket"></i>Заявки за посещение
		</div>
	</div>
	
	<div class="card-body">
		<div class="tab-content">
			<div>
                @if($isTeacher)
                    <a href="{{url('visits/create')}}" class="btn-shadow btn btn-wide btn-success" id="btn-add-visit">
                        <span class="btn-icon-wrapper pr-1 opacity-7">
                            <i class="fa fa-plus"></i>
                        </span>
                        Добави заявка за посещение 
                    </a>
                @endif
                @if($hasAdminAccess && $pendingRequestsCount > 0)
                    <form action='{{ url("/visits/approve-all") }}' method="POST">
                        @csrf
                        <button class="btn btn-primary approveAllBtn"> Потвърди всички </button>
                    </form>
                @endif
				<table style="width: 100%;" id="schoolVisitRequestsTable" class="table table-hover table-striped table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th>№</th>
                            @if(!$isTeacher)
                                <th>Учител</th>
                                <th>Училище</th>
                            @endif
                            <th>Удобно време за тел. разговор</th>
                            <th>Класове</th>
                            @if($isTeacher)
                                <th>Специалност</th>
                                <th>Брой ученици</th>
                            @endif
                            <th>Сфера на ролеви модел</th>
                            <th>Тип посещение</th>
                            <th>Удобно време за посещение</th>
                            <th>Статус</th>
                            <th>Ролеви модел</th>
                            <th>Дата</th>
                            <th>Дата на създаване</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($visitRequests as $visitRequest)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                @if(!$isTeacher)
                                    <td>
                                        {{$visitRequest->teacher->user->fullNames}}
                                    </td>
                                    <td>{{$visitRequest->teacher->school->name}}</td>
                                @endif
                                <td>{{$visitRequest->phone_calls_time}}</td>
                                <td>
                                    @if($visitRequest->classStage)
                                        {{$visitRequest->classStage->name}}
                                    @endif
                                </td>
                                 @if($isTeacher)
                                    <td>
                                        @if($visitRequest->classMajor)
                                            {{$visitRequest->phone_calls_time}}
                                        @endif
                                    </td>
                                    <td>{{$visitRequest->potential_participants_count}}</td>
                                @endif
                                <td>{{$visitRequest->role_model_profession}}</td>
                                <td>{{$visitRequest->meeting_type}}</td>
                                <td>{{$visitRequest->visit_time}}</td>

                                
                                <td>
                                    @if($visitRequest->requestStatus)
                                        {{$visitRequest->requestStatus->name}}
                                    @endif
                                </td>
                                <td>
                                    @if($visitRequest->schoolVisit)
                                        {{$visitRequest->schoolVisit->professional->user->fullNames}} от {{$visitRequest->schoolVisit->professional->company->name}}
                                    @endif
                                </td>
                                <td></td>
                                <td>{{$visitRequest->created_at}}</td>
                                <td>
                                    @if(($hasAdminAccess || Auth::id() === $visitRequest->created_by) && $visitRequest->request_status_id < config('consts.REQUEST_STATUS_APPROVED'))
                                        <a href='{{url("/visits/$visitRequest->id/edit")}}'class="btn btn-success" title="Промени"> <i class="fas fa-pencil-alt"></i>  </a>
                                        
                                        <form action='{{ url("/visits/$visitRequest->id") }}' method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-warning deleteBtn" title="Изтрий"> <i class="fas fa-trash-alt"></i> </button>
                                        </form>
                                    @endif

                                    @if($hasAdminAccess && $visitRequest->request_status_id < config('consts.REQUEST_STATUS_APPROVED'))
                                        <form action='{{ url("/visits/approve/$visitRequest->id") }}' method="POST">
                                          @csrf
                                          <button class="btn btn-primary"> Потвърди </button>
                                      </form>
                                    @endif

                                    @if($isProfessional)
                                        <form action='{{ url("/visits/assign/$visitRequest->id") }}' method="POST">
                                          @csrf
                                          <button class="btn btn-success"> Посети! </button>
                                      </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td></td>
                                <td colspan="11">Все още нямате заявки за посещения за този срок!</td>
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
<script type="text/javascript">
    $(document).ready( function () {
        $('#schoolVisitRequestsTable').DataTable({
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

        $('.approveAllBtn').on('click',function(e){
            let answer = confirm('Сигурни ли сте, че искате да одобрите всички непотвърдени заявки?');

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