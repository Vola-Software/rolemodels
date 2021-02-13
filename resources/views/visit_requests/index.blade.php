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
			<i class="fas fa-rocket"></i> Заявки за посещение
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
                        <button class="btn btn-success approveAllBtn"> Потвърди всички </button>
                    </form>
                @endif
				<table style="width: 100%;" id="schoolVisitRequestsTable" class="table table-hover table-striped table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th>№</th>
                            @if(!$isTeacher)
                                <th>Учител</th>
                                <th>Училище</th>
                                <th>Населено място</th>
                                @if($hasAdminAccess)
                                    <th>ЗвЧ статус</th>
                                @endif
                            @endif
                            @if(\Auth::check() && !$isProfessional)
                                <th>Удобно време за тел. разговор</th>
                            @endif
                            <th>Класове</th>
                            @if($isTeacher || $isProfessional)
                                <th>Специалност</th>
                            @endif
                            <th>Сфера на ролеви модел</th>
                            @if(\Auth::check() && !$isProfessional)
                                <th>Статус</th>
                                <th>Ролеви модел</th>
                                <th>Дата</th>
                            @endif
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($visitRequests as $visitRequest)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                @if(!$isTeacher)
                                    <td>
                                        @if($visitRequest->teacher && $visitRequest->teacher->user)
                                            {{$visitRequest->teacher->user->fullNames}}
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
                                    @if($hasAdminAccess)
                                        <td>{{$visitRequest->teacher_status}}</td>
                                    @endif
                                @endif
                                @if(\Auth::check() && !$isProfessional)
                                    <td>{{$visitRequest->phone_calls_time}}</td>
                                @endif
                                <td>
                                    @if($visitRequest->classStage)
                                        {{$visitRequest->classStage->name}}
                                    @endif
                                </td>
                                 @if($isTeacher || $isProfessional)
                                    <td>
                                        @if($visitRequest->classMajor)
                                            {{$visitRequest->classMajor->name}}
                                        @endif
                                    </td>
                                @endif
                                <td>{{$visitRequest->role_model_profession}}</td>

                                @if(\Auth::check() && !$isProfessional)
                                    <td>
                                        @if($visitRequest->requestStatus)
                                            {{$visitRequest->requestStatus->name}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($visitRequest->schoolVisit && $visitRequest->schoolVisit->professional)
                                            @if($visitRequest->schoolVisit->professional->user)
                                                {{$visitRequest->schoolVisit->professional->user->fullNames}} от
                                            @endif 
                                            @if($visitRequest->schoolVisit->professional->company)
                                                {{$visitRequest->schoolVisit->professional->company->name}}
                                            @endif
                                        @endif
                                    </td>
                                    <td></td>
                                @endif
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

                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#schoolVisitModal"
                                        data-id="{{$visitRequest->id}}" 
                                        data-teacher="{{$visitRequest->teacher->user->fullNames}}"
                                        data-teacher-subjects="{{$visitRequest->teacher->subjects}}"
                                        data-school="{{($visitRequest->teacher && $visitRequest->teacher->school) ? 
                                            $visitRequest->teacher->school->name : '-'}}"
                                        data-city="{{($visitRequest->teacher && $visitRequest->teacher->school) ?
                                            $visitRequest->teacher->school->city->name : '-'}}"
                                        data-phone-call-time="{{$visitRequest->phone_calls_time}}"
                                        data-classes="{{$visitRequest->classStage ? $visitRequest->classStage->name : '-'}}"
                                        data-class-profile="{{$visitRequest->classMajor ? $visitRequest->classMajor->name : '-'}}"
                                        data-students-details="{{$visitRequest->students_details}}"
                                        data-role-model-profession="{{$visitRequest->role_model_profession}}"
                                        data-meeting-type="{{$visitRequest->meeting_type}}"
                                        data-visit-time="{{$visitRequest->visit_time}}"
                                        data-students-count="{{$visitRequest->potential_participants_count}}"
                                        data-tech-equipment="{{$visitRequest->tech_equipment}}"
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
                                <td colspan="11">Все още нямате заявки за посещения за този срок!</td>
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
        <p><strong> Преподаван(и) предмет(и): </strong> <span class="teacher-subjects"></span></p>
        <p><strong> Училище: </strong> <span class="school"></span></p>
        <p><strong>Населено място: </strong> <span class="city"></span></p>
        <p><strong>Удобно време за телефонен разговор: </strong> <span class="phone-call-time"></span></p>
        <p><strong>Класове: </strong> <span class="classes"></span></p>
        <p><strong>Профил: </strong> <span class="class-profile"></span></p>
        <p><strong>Специфика на учениците: </strong> <span class="students-details"></span></p>
        <p><strong>Сфера на ролеви модел: </strong> <span class="role-model-profession"></span></p>
        <p><strong>Тип посещение: </strong> <span class="meeting-type"></span></p>
        <p><strong>Удобно време за посещение: </strong> <span class="visit-time"></span></p>
        <p><strong>Брой ученици, които биха взели участие: </strong> <span class="students-count"></span></p>
        <p><strong>Техническо оборудване: </strong> <span class="tech-equipment"></span></p>
        <p><strong>Статус: </strong> <span class="status"></span></p>
        <p><strong>Дата на създаване: </strong> <span class="created-at"></span></p>
      </div>
      <div class="modal-footer">
        @if($isProfessional || $isCompanyAdmin)
            <strong style="background-color: #fa6"> Заявявайки посещение се съгласявате с 
            <em>
                <a href="{{url('/useful-resources/Safeguarding_Children_Policy_Final_Sep_2018.pdf')}}" style="text-decoration: underline;">
                    политиката за работа с деца в риск
                </a>
            </em>
            </strong>
        @endif
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Затвори</button>
        @if($isProfessional || $isCompanyAdmin)
            <form class="approve-request-form" action='' method="POST">
              @csrf
              <button class="btn btn-success"> Заяви посещение! </button>
            </form>
        @endif
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

        $('#schoolVisitModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          
          //Fetch modal data from html modal button
          var visitRequestId = button.data('id')
          var teacher = button.data('teacher')
          var teacherSubjectsArr = button.data('teacher-subjects')
          var teacherSubjects = ''
          for(var i = 0; i < teacherSubjectsArr.length; i++){
            teacherSubjects += teacherSubjectsArr[i].name + ' '
          }
          var school = button.data('school')
          var city = button.data('city')
          var phoneCallTime = button.data('phone-call-time')
          var classes = button.data('classes')
          var classProfile = button.data('class-profile')
          var studentsDetails = button.data('students-details')
          var roleModelProfession = button.data('role-model-profession')
          var meetingType = button.data('meeting-type')
          var visitTime = button.data('visit-time')
          var studentsCount = button.data('students-count')
          var techEquipment = button.data('tech-equipment')
          var status = button.data('status')
          var createdAt = button.data('created-at')

          var formActionUrl = '/visits/assign/' + visitRequestId

          //Fill out the data in modal
          var modal = $(this)

          modal.find('.teacher').text(teacher)
          modal.find('.teacher-subjects').text(teacherSubjects)
          modal.find('.school').text(school)
          modal.find('.city').text(city)
          modal.find('.phone-call-time').text(phoneCallTime)
          modal.find('.classes').text(classes)
          modal.find('.class-profile').text(classProfile)
          modal.find('.students-details').text(studentsDetails)
          modal.find('.role-model-profession').text(roleModelProfession)
          modal.find('.meeting-type').text(meetingType)
          modal.find('.visit-time').text(visitTime)
          modal.find('.students-count').text(studentsCount)
          modal.find('.tech-equipment').text(techEquipment)
          modal.find('.status').text(status)
          modal.find('.created-at').text(createdAt)

          modal.find('.approve-request-form').attr('action', formActionUrl)
        });
    });
</script>
@endsection