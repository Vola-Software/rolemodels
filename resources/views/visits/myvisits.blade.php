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
			<i class="fas fa-users"></i>Моите посещения
		</div>
	</div>
	
	<div class="card-body">
		<div class="tab-content">
			<div>
				<table style="width: 100%;" id="schoolVisitRequestsTable" class="table table-hover table-striped table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th>№</th>
                            <th>Учител</th>
                            <th>Телефон</th>
                            <th>Ел. поща</th>
                            <th>Училище</th>
                            <th>Удобно време за тел. разговор</th>
                            <th>Класове</th>
                            <th>Специалност</th>
                            <th>Брой ученици</th>
                            <th>Сфера на ролеви модел</th>
                            <th>Тип посещение</th>
                            <th>Удобно време за посещение</th>
                            <th>Статус</th>
                            <th>Ролеви модел</th>
                            <th>Дата</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($schoolVisits as $schoolVisit)
                            <?php $visitRequest = $schoolVisit->schoolVisitRequest; ?>
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    {{$visitRequest->teacher->user->fullNames}}
                                </td>
                                <td>
                                    <a href="tel:{{$visitRequest->teacher->user->phone}}"> 
                                        <i class="fas fa-phone"></i> {{$visitRequest->teacher->user->phone}} 
                                    </a>
                                </td>
                                <td>{{$visitRequest->teacher->user->email}}</td>
                                <td>{{$visitRequest->teacher->school->name}}</td>
                                <td>{{$visitRequest->phone_calls_time}}</td>
                                <td>
                                    @if($visitRequest->classStage)
                                        {{$visitRequest->classStage->name}}
                                    @endif
                                </td>
                                <td>
                                    @if($visitRequest->classMajor)
                                        {{$visitRequest->phone_calls_time}}
                                    @endif
                                </td>
                                <td>{{$visitRequest->potential_participants_count}}</td>
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
                                <td>

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

        $('.approveAllBtn').on('click',function(e){
            let answer = confirm('Сигурни ли сте, че искате да да одобрите всички непотвърдени заявки?');

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