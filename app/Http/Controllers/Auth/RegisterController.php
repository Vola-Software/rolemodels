<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\School;
use App\Models\Subject;
use App\Models\Company;
use App\Models\Teacher;
use App\Models\Professional;
use App\Models\City;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/visits';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $schools = School::with(['city'])->get();
        $subjects = Subject::all();
        $companies = Company::all();
        $cities = City::orderBy('type')->orderBy('name')->get();

        if(request()->role){
            $role = request()->role;
        } else {
            $role = 'teacher';
        }

        return view('auth.register', [
            'schools' => $schools,
            'subjects' => $subjects,
            'companies' => $companies,
            'cities' => $cities,
            'role' => $role
        ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

            'phone' => ['required_if:role,teacher'], 
            'school_id' => ['required_if:role,teacher'],
            'subject_ids' => ['required_if:role,teacher'],
            'news_school_name' => ['required_if:school_id,9999'],
            'new_school_city_id' => ['required_if:school_id,9999'],

            'company_id' => ['required_if:role,professional'],
            'position' => ['required_if:role,professional'], 
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        try{
            \DB::beginTransaction();
            $data['password'] = Hash::make($data['password']);
            
            if($data['role'] == 'teacher'){
                //Register teacher
                $data['role_id'] = config('consts.ROLE_ID_TEACHER');
                $user = User::create($data);

                $teacher = Teacher::create([
                    'user_id' => $user->id,
                    'school_id' => $data['school_id'],
                ]);

                $teacher->subjects()->attach($data['subject_ids']);

                //fetch last ID (except School Other)
                $lastSchool = School::where('id', '<', config('consts.SCHOOL_ID_OTHER'))->orderBy('id', 'desc')->first();
                $newSchoolId = $lastSchool->id + 1;
                //if selected Other for school - add new school with status not approved
                if($data['school_id'] == config('consts.SCHOOL_ID_OTHER')){
                    School::create([
                        'id' => $newSchoolId,
                        'name' => $data['news_school_name'],
                        'website' => $data['news_school_website'],
                        'city_id' => $data['new_school_city_id'],
                        'is_approved' => false,
                        'created_by' => $user->id
                    ]);
                }
            } else {
                //Register professional
                $data['role_id'] = config('consts.ROLE_ID_PROFESSIONAL');
                $user = User::create($data);

                Professional::create([
                    'user_id' => $user->id,
                    'company_id' => $data['company_id'],
                    'position' => $data['position']
                ]);
            }
            
            \DB::commit();
        } catch (Exception $e) {
            \DB::rollBack();
        }
        

        return $user;
    }
}
