@extends('layouts.admin')

@section('content')
@include('includes.flash_msgs')
<div class="main-card mb-3 card mt-4">
	<div class="card-header-tab card-header-tab-animation card-header">
		<div class="card-header-title font-size-lg text-capitalize font-weight-normal">
			<i class="fas fa-rocket"></i>Анкета за посещение от Учител 
		</div>
	</div>

    <div class="card-body">
        <div class="tab-content">
            <div>
                <strong> Учител: </strong> {{$teacherPoll->teacher->user->fullNames}}, {{$teacherPoll->teacher->school->name}},  
            </div>
            <div>
                <strong> Клас: </strong> 
                @if(!empty($schoolVisit->schoolVisitRequest))
                    @if(!empty($schoolVisit->schoolVisitRequest->classStage))
                        {{$schoolVisit->schoolVisitRequest->classStage->name}}, 
                    @endif

                    @if(!empty($schoolVisit->schoolVisitRequest->classMajor))
                        {{$schoolVisit->schoolVisitRequest->classMajor->name}}
                    @endif
                @endif
            </div>
            <div>
                <strong> Ролеви модел: </strong> 
                @if(!empty($schoolVisit->professional))
                    {{$schoolVisit->professional->user->name}}, 
                    {{$schoolVisit->professional->position}}
                @endif

                @if(!empty($schoolVisit->professional) &&!empty($schoolVisit->professional->company))
                    от {{$schoolVisit->professional->company->name}}
                @endif
            </div>
            @if(!empty($schoolVisit->date))
                <div>
                    <strong> Дата: </strong> {{$schoolVisit->date}}
                </div>
            @endif
        </div>
    </div>	
    <hr>

	<div class="card-body">
		<div class="tab-content">
			<div>
				Състоя ли се посещението: 
                <strong>
                @if($teacherPoll->did_happen)
                    Да
                @else
                    Не
                @endif
                </strong>
			</div>
            @if($teacherPoll->did_happen == -1)
                <div>
                    Защо не се състоя посещението?
                    <strong>{{$teacherPoll->why_failed}}</strong>
                </div>
            @else
                <div>
                    До каква степен посещението беше полезно за учениците и отговори на очакванията на класа?
                    <strong>{{$teacherPoll->useful_rate}}</strong>
                </div>
                <div>
                    Най-ценното нещо за теб и твоите ученици след тази среща е?
                    <strong>{{$teacherPoll->most_valuable}}</strong>
                </div>
                <div>
                    Би ли поканил/а ролеви модел в класната си стая отново?
                    <strong>
                    @if($teacherPoll->invite_rm_again)
                        Да
                    @else
                        Не
                    @endif
                    </strong>
                </div>

                @if($teacherPoll->invite_rm_again == -1)
                    <div>
                        Защо не би поканил ролеви модел отново?
                        <strong>{{$teacherPoll->why_not_inviting_againt}}</strong>
                    </div>
                @endif

                <div>
                    Планира ли следващи стъпки с учениците си след посещението на ролевия модел и ако да - какви са те?
                    <strong>{{$teacherPoll->next_steps}}</strong>
                </div>
                <div>
                    Какво би подобрил/а в процеса?
                    <strong>{{$teacherPoll->improvement_suggestions}}</strong>
                </div>
            @endif
		</div>
        <a href="{{url('/visits')}}" class="btn btn-success">
            Обратно
        </a>
	</div>

@endsection

@section('footer_scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('#failedVisit').hide();
        $('#accomplishedVisit').hide();

        $( ".did_happen" ).change(function() {
          var didHappen = $('input[name="did_happen"]:checked').val();

          if(didHappen == -1) {
            $('#failedVisit').show();
            $('#accomplishedVisit').hide();
          } else {
            $('#failedVisit').hide();
            $('#accomplishedVisit').show();
          }
        });
    });  
</script>
@endsection