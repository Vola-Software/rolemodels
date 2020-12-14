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
                            <th>Удобно време за тел. разговор</th>
                            <th>Ел. поща</th>
                            <th>Училище</th>
                            <th>Населено място</th>
                            <th>Удобно време за посещение</th>
                            <th>Статус</th>
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
                                    @if($visitRequest->teacher && $visitRequest->teacher->user)
                                        {{$visitRequest->teacher->user->fullNames}}
                                    @endif
                                </td>
                                <td>
                                    @if($visitRequest->teacher && $visitRequest->teacher->user)
                                        <a href="tel:{{$visitRequest->teacher->user->phone}}"> 
                                            <i class="fas fa-phone"></i> {{$visitRequest->teacher->user->phone}} 
                                        </a>
                                    @endif
                                </td>
                                <td>{{$visitRequest->phone_calls_time}}</td>
                                <td>
                                    @if($visitRequest->teacher && $visitRequest->teacher->user)
                                        {{$visitRequest->teacher->user->email}}
                                    @endif
                                </td>
                                <td>
                                    @if($visitRequest->teacher && $visitRequest->teacher->school)
                                        {{$visitRequest->teacher->school->name}}
                                    @endif
                                </td>
                                <td>
                                    @if($visitRequest->teacher && $visitRequest->teacher->school)
                                        @if($visitRequest->teacher->school->city->type == 1)
                                            гр.
                                        @else
                                            с.
                                        @endif
                                        {{$visitRequest->teacher->school->city->name}}, обл. {{$visitRequest->teacher->school->city->region->name}}
                                    @endif
                                </td>
                                <td>{{$visitRequest->visit_time}}</td>

                                <td>
                                    @if($visitRequest->requestStatus)
                                        {{$visitRequest->requestStatus->name}}
                                    @endif
                                </td>
                                <td>{{$schoolVisit->date}}</td>
                                <td>
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#schoolVisitModal"
                                            data-id="{{$visitRequest->id}}" 
                                            data-teacher="{{$visitRequest->teacher->user->fullNames}}"
                                            data-school="{{($visitRequest->teacher && $visitRequest->teacher->school) ? $visitRequest->teacher->school->name : '-'}}"
                                            data-city="{{($visitRequest->teacher && $visitRequest->teacher->school) ?
                                            $visitRequest->teacher->school->city->name : '-'}}"
                                            data-phone-call-time="{{$visitRequest->phone_calls_time}}"
                                            data-classes="{{$visitRequest->classStage ? $visitRequest->classStage->name : '-'}}"
                                            data-class-profile="{{$visitRequest->classMajor ? $visitRequest->classMajor->name : '-'}}"
                                            data-role-model-profession="{{$visitRequest->role_model_profession}}"
                                            data-meeting-type="{{$visitRequest->meeting_type}}"
                                            data-visit-time="{{$visitRequest->visit_time}}"
                                            data-students-count="{{$visitRequest->potential_participants_count}}"
                                            data-logged-user-id="{{Auth::id()}}"
                                            data-role-model-id="{{$schoolVisit->professional->user->id}}"
                                            data-role-model="{{$schoolVisit->professional->user->fullNames}}"
                                            data-role-model-position="{{$schoolVisit->professional->position}}"
                                            data-status="{{$visitRequest->requestStatus ? $visitRequest->requestStatus->name : '-'}}"
                                            data-created-at="{{$visitRequest->created_at}}"
                                            >
                                          Детайли
                                    </button>

                                    
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td></td>
                                <td colspan="11">Все още нямате потвърдени посещения за този срок!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="schoolVisitModal" tabindex="-1" role="dialog" aria-labelledby="schoolVisitModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="schoolVisitModalLabel">Заявка за посещение</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><strong> Учител: </strong> <span class="teacher"></span></p>
        <p><strong> Училище: </strong> <span class="school"></span></p>
        <p><strong>Населено място: </strong> <span class="city"></span></p>
        <p><strong>Удобно време за телефонен разговор: </strong> <span class="phone-call-time"></span></p>
        <p><strong>Класове: </strong> <span class="classes"></span></p>
        <p><strong>Профил: </strong> <span class="class-profile"></span></p>
        <p><strong>Сфера на ролеви модел: </strong> <span class="role-model-profession"></span></p>
        <p><strong>Тип посещение: </strong> <span class="meeting-type"></span></p>
        <p><strong>Удобно време за посещение: </strong> <span class="visit-time"></span></p>
        <p><strong>Брой ученици, които биха взели участие: </strong> <span class="students-count"></span></p>
        <p><strong>Ролеви модел: </strong> <span class="role-model"></span></p>
        <p><strong>Статус: </strong> <span class="status"></span></p>
        <p><strong>Дата на създаване: </strong> <span class="created-at"></span></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Затвори</button>

        <form action='' method="POST" class="cancel-request-form">
            @csrf
            <button class="btn btn-primary cancelVisitBtn" title="Откажи"> Откажи посещение </button>
        </form>
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

        $('.cancelVisitBtn').on('click',function(e){
            let answer = confirm('Сигурни ли сте, че искате да откажете избраното посещение?');

            if(answer){
             $(this).parents("form").submit();
            }
            else{
             e.preventDefault();      
            }
        });

        $('#schoolVisitModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          
          //Fetch modal data from html modal button
          var visitRequestId = button.data('id')
          var teacher = button.data('teacher')
          var school = button.data('school')
          var city = button.data('city')
          var phoneCallTime = button.data('phone-call-time')
          var classes = button.data('classes')
          var classProfile = button.data('class-profile')
          var roleModelProfession = button.data('role-model-profession')
          var meetingType = button.data('meeting-type')
          var visitTime = button.data('visit-time')
          var studentsCount = button.data('students-count')
          var roleModel = button.data('role-model')
          var roleModelPosition = button.data('role-model-position')
          var rmWithPosition = roleModel + ', ' + roleModelPosition
          var status = button.data('status')
          var createdAt = button.data('created-at')

          var roleModelId = button.data('role-model-id')
          var loggedUserId = button.data('logged-user-id')

          var formActionUrl = '/visits/cancel/' + visitRequestId

          //Fill out the data in modal
          var modal = $(this)

          modal.find('.teacher').text(teacher)
          modal.find('.school').text(school)
          modal.find('.city').text(city)
          modal.find('.phone-call-time').text(phoneCallTime)
          modal.find('.classes').text(classes)
          modal.find('.class-profile').text(classProfile)
          modal.find('.role-model-profession').text(roleModelProfession)
          modal.find('.meeting-type').text(meetingType)
          modal.find('.visit-time').text(visitTime)
          modal.find('.students-count').text(studentsCount)
          modal.find('.role-model').text(rmWithPosition)
          modal.find('.status').text(status)
          modal.find('.created-at').text(createdAt)

          modal.find('.cancel-request-form').attr('action', formActionUrl)
          if(roleModelId != loggedUserId){
            modal.find('.cancel-request-form').hide();
          } else {
            modal.find('.cancel-request-form').show();
          }
          
        });
    });
</script>
@endsection