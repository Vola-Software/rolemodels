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
			<i class="fas fa-users"></i>Потребители
        </div>
        <ul class="nav">
            <li class="nav-item"><a data-toggle="tab" href="#tab-professionals" class="active nav-link">Професионалисти</a></li>
            @if(Auth::user()->hasAdminAccess())
                <li class="nav-item"><a data-toggle="tab" href="#tab-teachers" class="nav-link">Учители</a></li>
                <li class="nav-item"><a data-toggle="tab" href="#tab-admins" class="nav-link">Администратори</a></li>
            @endif
        </ul>
	</div>
	
	<div class="card-body">
		<div class="tab-content">
            <div class="tab-pane active" id="tab-professionals" role="tabpanel">
                <table style="width: 100%;" id="professionalsTable" class="table table-hover table-striped table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th>№</th>
                            <th>Имена</th>
                            <th>Роля</th>
                            <th>Позиция</th>
                            <th>Компания</th>
                            <th>Населено място</th>
                            <th>Ел. поща</th>
                            <th>Телефон</th>
                            <th>Брой посещения</th>
                            <th>Дата на регистрация</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($professionals as $professional)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$professional->fullNames}}</td>
                                <td>{{$professional->role->name}}</td>
                                <td>{{$professional->professional->position}}</td>
                                <td>{{$professional->professional->company->name}}</td>
                                <td>{{$professional->professional->company->city->name}}</td>
                                <td>{{$professional->email}}</td>
                                <td>{{$professional->phone}}</td>
                                <td>
                                    @if($professional->professional->schoolVisits)
                                        {{$professional->professional->schoolVisits->count()}}
                                    @else 
                                        0
                                    @endif
                                </td>
                                <td>{{$professional->created_at}}</td>
                                <td></td>
                            </tr>
                        @empty
                            <tr>
                                <td></td>
                                <td colspan="10">Няма потребители с роля ролеви модел или мениджър ролеви модели!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if(Auth::user()->hasAdminAccess())
    			<div class="tab-pane" id="tab-teachers" role="tabpanel">
    				<table style="width: 100%;" id="teachersTable" class="table table-hover table-striped table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th>№</th>
                                <th>Имена</th>
                                <th>Училище</th>
                                <th>Населено място</th>
                                <th>Преподавани предмети</th>
                                <th>Ел. поща</th>
                                <th>Телефон</th>
                                <th>Брой заявки</th>
                                <th>Дата на регистрация</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($teachers as $teacher)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$teacher->fullNames}}</td>
                                    <td>{{$teacher->teacher->school->name}}</td>
                                    <td>{{$teacher->teacher->school->city->name}}</td>
                                    <td></td>
                                    <td>{{$teacher->email}}</td>
                                    <td>{{$teacher->phone}}</td>
                                    <td>{{$teacher->teacher->schoolVisitRequests->count()}}</td>
                                    <td>{{$teacher->created_at}}</td>
                                    <td></td>
                                </tr>
                            @empty
                                <tr>
                                    <td></td>
                                    <td colspan="9">Няма потребители с роля учител!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
    			</div>

                <div class="tab-pane" id="tab-admins" role="tabpanel">
                    <table style="width: 100%;" id="adminsTable" class="table table-hover table-striped table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th>№</th>
                                <th>Имена</th>
                                <th>Роля</th>
                                <th>Ел. поща</th>
                                <th>Телефон</th>
                                <th>Дата на регистрация</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($admins as $admin)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$admin->fullNames}}</td>
                                    <td>{{$admin->role->name}}</td>
                                    <td>{{$admin->email}}</td>
                                    <td>{{$admin->phone}}</td>
                                    <td>{{$admin->created_at}}</td>
                                    <td></td>
                                </tr>
                            @empty
                                <tr>
                                    <td></td>
                                    <td colspan="6">Няма потребители с роля администратор!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @endif
		</div>
	</div>
</div>
@endsection

@section('footer_scripts')
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" />
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready( function () {
        $('#teachersTable').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Bulgarian.json"
            }
        });

        $('#professionalsTable').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Bulgarian.json"
            }
        });

        $('#adminsTable').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Bulgarian.json"
            }
        });
    });
</script>
@endsection