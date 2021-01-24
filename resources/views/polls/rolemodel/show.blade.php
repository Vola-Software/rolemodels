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
                <strong> Ролеви модел: </strong> {{$schoolVisit->professional->user->fullNames}}, 
                    {{$schoolVisit->professional->position}}
                    от {{$schoolVisit->professional->company->name}}
            </div>
            <div>
                <strong> Училище: </strong> {{$schoolVisit->schoolVisitRequest->teacher->school->name}}, 
                    {{$schoolVisit->schoolVisitRequest->teacher->school->city->name}}
            </div>
            <div>
                <strong> Учител: </strong> {{$schoolVisit->schoolVisitRequest->teacher->user->fullNames}}, {{$schoolVisit->schoolVisitRequest->teacher->school->name}},  
            </div>
            <div>
                <strong> Клас: </strong> {{$schoolVisit->schoolVisitRequest->classStage->name}}, {{$schoolVisit->schoolVisitRequest->classMajor->name}}
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
                @if($roleModelPoll->did_happen)
                    Да
                @else
                    Не
                @endif
                </strong>
			</div>
            @if($roleModelPoll->did_happen == -1)
                <div>
                    Защо не се състоя посещението?
                    <strong>{{$roleModelPoll->why_failed}}</strong>
                </div>
            @else
                <div>
                    Как би оценил преживяването?
                    <strong>{{$roleModelPoll->satisfaction_rate}}</strong>
                </div>
                <div>
                    Какво ти хареса най-много?
                    <strong>{{$roleModelPoll->most_valuable}}</strong>
                </div>
                <div>
                    Какво би подобрил/а в процеса?
                    <strong>{{$roleModelPoll->improvement_suggestions}}</strong>
                </div>
                <div>
                    Би ли се включил като ролеви модел в класна стая отново?
                    <strong>
                    @if($roleModelPoll->rolemodel_again)
                        Да
                    @else
                        Не
                    @endif
                    </strong>
                </div>

                <div>
                    Би ли участвал/а и в други инициативи на “Заедно в час”?
                    <strong>
                        @if($roleModelPoll->other_tfb_initiatives)
                            Да
                        @else
                            Не
                        @endif
                    </strong>
                </div>
                
            @endif
		</div>

        @if($isFromCompany)
            <?php $urlBack = 'my-visits'; ?>
        @else
            <?php $urlBack = 'visits'; ?>
        @endif
        <a href='{{url("$urlBack")}}' class="btn btn-success">
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