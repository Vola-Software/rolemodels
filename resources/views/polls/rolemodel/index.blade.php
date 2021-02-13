@extends('layouts.admin')

@section('header_scripts')
<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>

<script 
    src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script> 
@endsection

@section('content')
@include('includes.flash_msgs')
<div class="main-card mb-3 card mt-4">
	<div class="card-header-tab card-header-tab-animation card-header">
		<div class="card-header-title font-size-lg text-capitalize font-weight-normal">
			<i class="fas fa-rocket"></i>Анкети от ролеви модели
		</div>
	</div>
	
	<div class="card-body">
		<div class="tab-content">
			<div>
				<table style="width: 100%;" id="rolemodelPollsTable" class="table table-hover table-striped table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th>№</th>
                            <th>Учител, Училище</th>
                            <th>Клас</th>
                            <th>Ролеви модел</th>
                            <th>Дата на посещение</th>
                            <th>Оценка на преживяването?</th>
                            <th>Би ли се включил отново?</th>
                            <th>Участие в други инициативи на ЗвЧ?</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rolemodelPolls as $rolemodelPoll)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    @if($rolemodelPoll->schoolVisit && $rolemodelPoll->schoolVisit->schoolvisitRequest)
                                        @if($rolemodelPoll->schoolVisit->schoolvisitRequest->teacher->user)
                                            {{$rolemodelPoll->schoolVisit->schoolvisitRequest->teacher->user->fullNames}}, 
                                        @endif
                                        @if($rolemodelPoll->schoolVisit->schoolvisitRequest->teacher->school)
                                            {{$rolemodelPoll->schoolVisit->schoolvisitRequest->teacher->school->name}}
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    @if(!empty($rolemodelPoll->schoolVisit->schoolVisitRequest))
                                        @if(!empty($rolemodelPoll->schoolVisit->schoolVisitRequest->classStage))
                                            {{$rolemodelPoll->schoolVisit->schoolVisitRequest->classStage->name}}, 
                                        @endif

                                        @if(!empty($rolemodelPoll->schoolVisit->schoolVisitRequest->classMajor))
                                            {{$rolemodelPoll->schoolVisit->schoolVisitRequest->classMajor->name}}
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    @if(!empty($rolemodelPoll->schoolVisit->professional))
                                        {{$rolemodelPoll->schoolVisit->professional->user->fullNames}}, 
                                        {{$rolemodelPoll->schoolVisit->professional->position}}
                                    @endif

                                    @if(!empty($rolemodelPoll->schoolVisit->professional) &&!empty($rolemodelPoll->schoolVisit->professional->company))
                                        от {{$rolemodelPoll->schoolVisit->professional->company->name}}
                                    @endif
                                </td>
                                <td>
                                    @if($rolemodelPoll->did_happen == 1)
                                        @if(!empty($rolemodelPoll->schoolVisit->date))
                                            {{\Carbon\Carbon::parse($rolemodelPoll->schoolVisit->date)->formatLocalized('%d.%m.%Y')}}
                                        @else
                                            ???
                                        @endif
                                    @else
                                        не се случи
                                    @endif
                                </td>
                                <td>
                                    @if($rolemodelPoll->did_happen == 1)
                                        {{$rolemodelPoll->satisfaction_rate}}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if($rolemodelPoll->did_happen == 1)
                                        @if($rolemodelPoll->rolemodel_again == 1)
                                            да
                                        @else
                                            не
                                        @endif
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if($rolemodelPoll->did_happen == 1)
                                        @if($rolemodelPoll->other_tfb_initiatives == 1)
                                            да
                                        @else
                                            не
                                        @endif
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <a href='{{url("/rolemodel-poll-show/{$rolemodelPoll->id}")}}' class="btn btn-info" target="_blank">
                                        Детайли
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td></td>
                                <td colspan="9">Все още няма попълнени анкети!</td>
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
        $('#rolemodelPollsTable').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Bulgarian.json"
            }
        });
    });
</script>
@endsection