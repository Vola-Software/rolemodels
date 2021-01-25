<?php

return [
	'ROLE_ID_SUPERADMIN' => 1,
	'ROLE_ID_ADMIN' => 3,
	'ROLE_ID_TFB_ADMIN' => 5,
	'ROLE_ID_COMPANY_ADMIN' => 7,
	'ROLE_ID_TEACHER' => 9,
	'ROLE_ID_PROFESSIONAL' => 11,
	'ROLE_ID_ADMINS_ARR' => [1, 3, 5],

	'REQUEST_STATUS_PENDING' => 1,
	'REQUEST_STATUS_APPROVED' => 2,
	'REQUEST_STATUS_ASSIGNED_RM' => 3,
	'REQUEST_STATUS_COMPLETED' => 4,
	'REQUEST_STATUS_FINISHED' => 5,
	'REQUEST_STATUS_DENIED' => 6, //admin denied it
	'REQUEST_STATUS_CANCELLED' => 7,//assigned by role model but did not happen

	'TEACHER_STATUSES' => [
		'преподаващ алум' => 'преподаващ алум',
		'учител първа година' => 'учител първа година',
		'учител втора година' => 'учител втора година'
	],

	'MEETING_TYPES' => [
		'на живо' => 'На живо',
		'онлайн' => 'Онлайн',
		'нямам предпочитания' => 'Нямам предпочитания'
	],

	'PARTICIPANTS_COUT' => [
		'5-10' => '5-10',
		'11-15' => '11-15',
		'16-20' => '16-20',
		'над 20' => 'над 20'
	],

	'SCHOOL_ID_OTHER' => 9999
];