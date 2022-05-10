<?php

namespace Database\Seeders;

use DateTime;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    public function run()
    {
        $this->call(LaratrustSeeder::class);

        DB::table('users')->insert([
            [   //admin user_id:1
                'name' => 'admin',
                'email' => 'admin@hospsech.com',
                'password' => Hash::make('1234qwer'),
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [   //patient1 (Mark) user_id:2
                'name' => 'Mark',
                'email' => 'mark@hospsech.com',
                'password' => Hash::make('1234qwer'),
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [   //patient2 (Janet) user_id:3
                'name' => 'Janet',
                'email' => 'janet@hospsech.com',
                'password' => Hash::make('1234qwer'),
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [   //nurse1 user_id:4
                'name' => 'Nurse ComLabNursing1',
                'email' => 'nursecomlabnursing1@hospsech.com',
                'password' => Hash::make('1234qwer'),
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [   //nurse2 user_id:5
                'name' => 'Nurse ComLabNursing2',
                'email' => 'nursecomlabnursing2@hospsech.com',
                'password' => Hash::make('1234qwer'),
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [   //Doctor GenMedIntMed user_id:6
                'name' => 'Doctor GenMedIntMed',
                'email' => 'docgenmedintmed@hospsech.com',
                'password' => Hash::make('1234qwer'),
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [   //Doctor GenMedInfDisease user_id:7
                'name' => 'Doctor GenMedInfDisease',
                'email' => 'docgenmedininfdisease@hospsech.com',
                'password' => Hash::make('1234qwer'),
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [   //Doctor GenSurgVascular user_id:8
                'name' => 'Doctor GenSurgVascular',
                'email' => 'docgensurgvascular@hospsech.com',
                'password' => Hash::make('1234qwer'),
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [   //Doctor LabMedMBio user_id:9
                'name' => 'Doctor LabMedMBio',
                'email' => 'doclabmedmbio@hospsech.com',
                'password' => Hash::make('1234qwer'),
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [   //Doctor PsychMedPsychiatry user_id:10
                'name' => 'Doctor PsychMedPsychiatry',
                'email' => 'docpsychmedpsychiatry@hospsech.com',
                'password' => Hash::make('1234qwer'),
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],          
            [   //Doctor DiagRad user_id:11
                'name' => 'Doctor DiagRad',
                'email' => 'docdiagrad@hospsech.com',
                'password' => Hash::make('1234qwer'),
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [   //Doctor PathHaema user_id:12
                'name' => 'Doctor PathHaema',
                'email' => 'docpathhaema@hospsech.com',
                'password' => Hash::make('1234qwer'),
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [   //Doctor GastroHepa user_id:13
                'name' => 'Doctor GastroHepa',
                'email' => 'docgastrohepa@hospsech.com',
                'password' => Hash::make('1234qwer'),
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [   //Doctor Derma user_id:14
                'name' => 'Doctor Derma',
                'email' => 'docderma@hospsech.com',
                'password' => Hash::make('1234qwer'),
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [   //Doctor Other user_id:15
                'name' => 'Doctor Other',
                'email' => 'docother@hospsech.com',
                'password' => Hash::make('1234qwer'),
                'status' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]

        ]);

        DB::table('role_user')->insert([
            //admin user_id:1
            [   
                'role_id' => '1',
                'user_id' => '1',
                'user_type' => 'App\Models\User'
            ],
            //patient1 (Mark) user_id:2
            [   
                'role_id' => '5',
                'user_id' => '2',
                'user_type' => 'App\Models\User'
            ],
            //patient2 (Janet) user_id:3
            [   
                'role_id' => '5',
                'user_id' => '3',
                'user_type' => 'App\Models\User'
            ],
            //nurse1 user_id:4
            [   
                'role_id' => '2',
                'user_id' => '4',
                'user_type' => 'App\Models\User'
            ],
            [
                'role_id' => '4',
                'user_id' => '4',
                'user_type' => 'App\Models\User'
            ],
            //nurse2 user_id:5
            [   
                'role_id' => '2',
                'user_id' => '5',
                'user_type' => 'App\Models\User'
            ],
            [   
                'role_id' => '4',
                'user_id' => '5',
                'user_type' => 'App\Models\User'
            ],
            //Doctor GenMedIntMed user_id:6
            [   
                'role_id' => '2',
                'user_id' => '6',
                'user_type' => 'App\Models\User'
            ],
            [
                'role_id' => '3',
                'user_id' => '6',
                'user_type' => 'App\Models\User'
            ],
            //Doctor GenMedInfDisease user_id:7
            [   
                'role_id' => '2',
                'user_id' => '7',
                'user_type' => 'App\Models\User'
            ],
            [
                'role_id' => '3',
                'user_id' => '7',
                'user_type' => 'App\Models\User'
            ],
            //Doctor GenSurgVascular user_id:8
            [   
                'role_id' => '2',
                'user_id' => '8',
                'user_type' => 'App\Models\User'
            ],
            [
                'role_id' => '3',
                'user_id' => '8',
                'user_type' => 'App\Models\User'
            ],
            //Doctor LabMedMBio user_id:9
            [   
                'role_id' => '2',
                'user_id' => '9',
                'user_type' => 'App\Models\User'
            ],
            [
                'role_id' => '3',
                'user_id' => '9',
                'user_type' => 'App\Models\User'
            ],
            //Doctor PsychMedPsychiatry user_id:10
            [   
                'role_id' => '2',
                'user_id' => '10',
                'user_type' => 'App\Models\User'
            ],
            [
                'role_id' => '3',
                'user_id' => '10',
                'user_type' => 'App\Models\User'
            ],
            //Doctor DiagRad user_id:11
            [   
                'role_id' => '2',
                'user_id' => '11',
                'user_type' => 'App\Models\User'
            ],
            [
                'role_id' => '4',
                'user_id' => '11',
                'user_type' => 'App\Models\User'
            ],
            //Doctor PathHaema user_id:12
            [   
                'role_id' => '2',
                'user_id' => '12',
                'user_type' => 'App\Models\User'
            ],
            [
                'role_id' => '3',
                'user_id' => '12',
                'user_type' => 'App\Models\User'
            ],
            //Doctor GastroHepa user_id:13
            [   
                'role_id' => '2',
                'user_id' => '13',
                'user_type' => 'App\Models\User'
            ],
            [
                'role_id' => '3',
                'user_id' => '13',
                'user_type' => 'App\Models\User'
            ],
            //Doctor Derma user_id:14
            [   
                'role_id' => '2',
                'user_id' => '14',
                'user_type' => 'App\Models\User'
            ],
            [
                'role_id' => '3',
                'user_id' => '14',
                'user_type' => 'App\Models\User'
            ],
            //Doctor Other user_id:15
            [   
                'role_id' => '2',
                'user_id' => '15',
                'user_type' => 'App\Models\User'
            ],
            [
                'role_id' => '3',
                'user_id' => '15',
                'user_type' => 'App\Models\User'
            ],
        ]);

        DB::table('profiles')->insert([
            [   //admin user_id:1
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'user_id' => '1',
                'name' => 'admin',
                'gender' => 'male',
                'phoneNumber' => '00000000',
                'DOB' =>  date('Y-m-d'),
                'age' => '0'
            ],
            [   //patient1 (Mark) user_id:2
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'user_id' => '2',
                'name' => 'Mark',
                'gender' => 'male',
                'phoneNumber' => '99345678',
                'DOB' =>  '2000-01-27',
                'age' => '22'
            ],
            [   //patient2 (Janet) user_id:3
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'user_id' => '3',
                'name' => 'Janet',
                'gender' => 'female',
                'phoneNumber' => '87654321',
                'DOB' =>  '2001-01-27',
                'age' => '21'
            ],
            [   //nurse1 user_id:4
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'user_id' => '4',
                'name' => 'Nurse 1',
                'gender' => 'female',
                'phoneNumber' => '87451121',
                'DOB' =>  '1998-05-17',
                'age' => '24'
            ],
            [   //nurse2 user_id:5
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'user_id' => '5',
                'name' => 'Nurse 2',
                'gender' => 'female',
                'phoneNumber' => '8512321',
                'DOB' =>  '1999-07-27',
                'age' => '23'
            ],
            [   //Doctor GenMedIntMed user_id:6
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'user_id' => '6',
                'name' => 'GenMedIntMed',
                'gender' => 'female',
                'phoneNumber' => '92837857',
                'DOB' =>  '1995-01-27',
                'age' => '27'
            ],
            [   //Doctor GenMedInfDisease user_id:7
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'user_id' => '7',
                'name' => 'GenMedInfDisease',
                'gender' => 'male',
                'phoneNumber' => '92839877',
                'DOB' =>  '1996-01-27',
                'age' => '26'
            ],
            [   //Doctor GenSurgVascular user_id:8
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'user_id' => '8',
                'name' => 'GenSurgVascular',
                'gender' => 'male',
                'phoneNumber' => '92839877',
                'DOB' =>  '1996-04-27',
                'age' => '26'
            ],
            [   //Doctor LabMedMBio user_id:9
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'user_id' => '9',
                'name' => 'LabMedMBio',
                'gender' => 'male',
                'phoneNumber' => '92851877',
                'DOB' =>  '1990-04-27',
                'age' => '32'
            ],
            [   //Doctor PsychMedPsychiatry user_id:10
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'user_id' => '10',
                'name' => 'PsychMedPsychiatry',
                'gender' => 'male',
                'phoneNumber' => '89251877',
                'DOB' =>  '1990-04-27',
                'age' => '32'
            ],
            [   //Doctor DiagRad user_id:11
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'user_id' => '11',
                'name' => 'DiagRad',
                'gender' => 'male',
                'phoneNumber' => '80851877',
                'DOB' =>  '1990-04-27',
                'age' => '32'
            ],
            [   //Doctor PathHaema user_id:12
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'user_id' => '12',
                'name' => 'PathHaema',
                'gender' => 'male',
                'phoneNumber' => '80081877',
                'DOB' =>  '1992-04-27',
                'age' => '30'
            ],
            [   //Doctor GastroHepa user_id:13
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'user_id' => '13',
                'name' => 'GastroHepa',
                'gender' => 'male',
                'phoneNumber' => '99131877',
                'DOB' =>  '1993-04-27',
                'age' => '29'
            ],
            [   //Doctor Derma user_id:14
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'user_id' => '14',
                'name' => 'Derma',
                'gender' => 'female',
                'phoneNumber' => '92851877',
                'DOB' =>  '1997-04-27',
                'age' => '25'
            ],
            [   //Doctor Other user_id:15
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'user_id' => '15',
                'name' => 'Other',
                'gender' => 'male',
                'phoneNumber' => '98951877',
                'DOB' =>  '1998-04-27',
                'age' => '24'
            ]
        ]);       
       
        DB::table('medical_staff')->insert([ 
            [   //nurse1 user_id:4
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'user_id' => '4',
                'department_id' => '5',
                'specialisation_id' => '6'
            ],
            [   //nurse2 user_id:5
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'user_id' => '5',
                'department_id' => '5',
                'specialisation_id' => '6'
            ],
            [   //Doctor GenMedIntMed user_id:6
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'user_id' => '6',
                'department_id' => '1',
                'specialisation_id' => '1'
            ],
            [   //Doctor GenMedInfDisease user_id:7
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'user_id' => '7',
                'department_id' => '1',
                'specialisation_id' => '2'
            ],
            [   //Doctor GenSurgVascular user_id:8
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'user_id' => '8',
                'department_id' => '2',
                'specialisation_id' => '3'
            ],
            [   //Doctor LabMedMBio user_id:9
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'user_id' => '9',
                'department_id' => '3',
                'specialisation_id' => '4'
            ],
            [    //Doctor PsychMedPsychiatry user_id:10
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'user_id' => '10',
                'department_id' => '4',
                'specialisation_id' => '5'
            ],
            [    //Doctor DiagRad user_id:11
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'user_id' => '11',
                'department_id' => '6',
                'specialisation_id' => '7'
            ],
            [   //Doctor PathHaema user_id:12
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'user_id' => '12',
                'department_id' => '7',
                'specialisation_id' => '8'
            ],
            [    //Doctor GastroHepa user_id:13
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'user_id' => '13',
                'department_id' => '8',
                'specialisation_id' => '9'
            ],
            [    //Doctor Derma user_id:14
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'user_id' => '14',
                'department_id' => '9',
                'specialisation_id' => '10'
            ],
            [    //Doctor Other user_id:15   
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'user_id' => '15',
                'department_id' => '10',
                'specialisation_id' => '11'
            ]
        ]);


        DB::table('departments')->insert([
            [
                'departmentName' => 'General Medicine'
            ],
            [
                'departmentName' => 'General Surgery'
            ],
            [
                'departmentName' => 'Laboratory Medicine'
            ],
            [
                'departmentName' => 'Psychological Medicine'
            ],
            [
                'departmentName' => 'Common Laboratory'
            ],
            [
                'departmentName' => 'Diagnostic Radiology'
            ],
            [
                'departmentName' => 'Pathology'
            ],
            [
                'departmentName' => 'Gastrointestinal'
            ],
            [
                'departmentName' => 'Dermatology'
            ],
            [
                'departmentName' => 'Others'
            ]
        ]);

        DB::table('specialisations')->insert([
            
            [
                'specialisation' => 'Internal Medicine',
                'department_id' => '1'
            ],
            [
                'specialisation' => 'Infectious Diseases',
                'department_id' => '1'
            ],
            [
                'specialisation' => 'Vascular',
                'department_id' => '2'
            ],
            [
                'specialisation' => 'Microbiology',
                'department_id' => '3'
            ],
            [
                'specialisation' => 'Psychiatry',
                'department_id' => '4'
            ],
            [
                'specialisation' => 'Nursing',
                'department_id' => '5'
            ],
            [
                'specialisation' => 'Diagnostic Radiology',
                'department_id' => '6'
            ],
            [
                'specialisation' => 'Haematology',
                'department_id' => '7'
            ],
            [
                'specialisation' => 'Gastroenterology and Hepatology',
                'department_id' => '8'
            ],
            [
                'specialisation' => 'Dermatology',
                'department_id' => '9'
            ],
            [
                'specialisation' => 'Others',
                'department_id' => '10'
            ]
            
        ]);

        DB::table('treatments')->insert([
            [
                'department_id' => '1',
                'specialisation_id' => '1',
                'duration' => '01:00:00',
                'price' => '30',
                'treatmentTitle' => 'Internal Medicine Consultation'

            ],
            [
                'department_id' => '1',
                'specialisation_id' => '2',
                'duration' => '01:00:00',
                'price' => '30',
                'treatmentTitle' => 'Infectious Diseases Consultation'
            ],
            [
                'department_id' => '2',
                'specialisation_id' => '3',
                'duration' => '01:00:00',
                'price' => '30',
                'treatmentTitle' => 'Vascular Consultation'

            ],
            [
                'department_id' => '3',
                'specialisation_id' => '4',
                'duration' => '01:00:00',
                'price' => '30',
                'treatmentTitle' => 'Microbiology Consultation'

            ],
            [
                'department_id' => '4',
                'specialisation_id' => '5',
                'duration' => '01:00:00',
                'price' => '30',
                'treatmentTitle' => 'Psychiatry Consultation'

            ],
            [
                'department_id' => '6',
                'specialisation_id' => '7',
                'duration' => '01:00:00',
                'price' => '30',
                'treatmentTitle' => 'Diagnostic Radiology Consultation'

            ],
            [
                'department_id' => '7',
                'specialisation_id' => '8',
                'duration' => '01:00:00',
                'price' => '30',
                'treatmentTitle' => 'Haematology Consultation'

            ],
            [
                'department_id' => '8',
                'specialisation_id' => '9',
                'duration' => '01:00:00',
                'price' => '30',
                'treatmentTitle' => 'Gastroenterology and Hepatology Consultation'

            ],
            [
                'department_id' => '9',
                'specialisation_id' => '10',
                'duration' => '01:00:00',
                'price' => '30',
                'treatmentTitle' => 'Dermatology Consultation'

            ],
            [
                'department_id' => '10',
                'specialisation_id' => '11',
                'duration' => '01:00:00',
                'price' => '30',
                'treatmentTitle' => 'Others Consultation'

            ],
            [
                'department_id' => '1',
                'specialisation_id' => '1',
                'duration' => '01:00:00',
                'price' => '30',
                'treatmentTitle' => 'Follow-up Consultation/Prescriptions'

            ],
            [
                'department_id' => '3',
                'specialisation_id' => '4',
                'duration' => '01:00:00',
                'price' => '100',
                'treatmentTitle' => 'Lab Analysis'

            ],
            [
                'department_id' => '4',
                'specialisation_id' => '5',
                'duration' => '01:00:00',
                'price' => '200',
                'treatmentTitle' => 'Therapy Or Counselling'

            ],
            [
                'department_id' => '2',
                'specialisation_id' => '3',
                'duration' => '01:00:00',
                'price' => '500',
                'treatmentTitle' => 'Vascular Disease Treatment'

            ],
            [
                'department_id' => '1',
                'specialisation_id' => '2',
                'duration' => '01:00:00',
                'price' => '250',
                'treatmentTitle' => 'Bacterial Infection Treatment '

            ],
            [
                'department_id' => '6',
                'specialisation_id' => '7',
                'duration' => '01:00:00',
                'price' => '15',
                'treatmentTitle' => 'X-RAY'

            ],
            [
                'department_id' => '5',
                'specialisation_id' => '6',
                'duration' => '01:00:00',
                'price' => '15',
                'treatmentTitle' => 'Blood Test'

            ],
            [
                'department_id' => '5',
                'specialisation_id' => '6',
                'duration' => '01:00:00',
                'price' => '15',
                'treatmentTitle' => 'Dressing'

            ],
            [
                'department_id' => '7',
                'specialisation_id' => '8',
                'duration' => '01:00:00',
                'price' => '35',
                'treatmentTitle' => 'Complete Blood Count Test'

            ],
            [
                'department_id' => '7',
                'specialisation_id' => '8',
                'duration' => '01:00:00',
                'price' => '30',
                'treatmentTitle' => 'Basic Metabolic Panel (Blood) Test'

            ],
            [
                'department_id' => '7',
                'specialisation_id' => '8',
                'duration' => '01:00:00',
                'price' => '30',
                'treatmentTitle' => 'Lipid Panel (Blood) Test'

            ],
            [
                'department_id' => '7',
                'specialisation_id' => '8',
                'duration' => '01:00:00',
                'price' => '30',
                'treatmentTitle' => 'Thyroid Panel (Blood) Test'

            ],
            [
                'department_id' => '7',
                'specialisation_id' => '8',
                'duration' => '01:00:00',
                'price' => '30',
                'treatmentTitle' => 'Cardiac Biomarkers (Blood) Test'

            ],
            [
                'department_id' => '7',
                'specialisation_id' => '8',
                'duration' => '01:00:00',
                'price' => '30',
                'treatmentTitle' => 'STI (Blood) Test'

            ],
            [
                'department_id' => '7',
                'specialisation_id' => '8',
                'duration' => '01:00:00',
                'price' => '30',
                'treatmentTitle' => 'Coagulation Panel (Blood) Test'

            ],
            [
                'department_id' => '8',
                'specialisation_id' => '9',
                'duration' => '01:00:00',
                'price' => '70',
                'treatmentTitle' => 'Colonoscopy (Large Intestine/Rectum)'

            ],
            [
                'department_id' => '8',
                'specialisation_id' => '9',
                'duration' => '01:00:00',
                'price' => '70',
                'treatmentTitle' => 'Enteroscopy (Small Intestine)'

            ],
            [
                'department_id' => '8',
                'specialisation_id' => '9',
                'duration' => '01:00:00',
                'price' => '80',
                'treatmentTitle' => 'Endoscopic Ultrasound'

            ],
            [
                'department_id' => '9',
                'specialisation_id' => '10',
                'duration' => '01:00:00',
                'price' => '65',
                'treatmentTitle' => 'Phototherapy'

            ],
            [
                'department_id' => '9',
                'specialisation_id' => '10',
                'duration' => '01:00:00',
                'price' => '55',
                'treatmentTitle' => 'Milia and Comedonal Extraction'

            ],
            [
                'department_id' => '9',
                'specialisation_id' => '10',
                'duration' => '01:00:00',
                'price' => '55',
                'treatmentTitle' => 'Intralesional Corticosteroid Injections'

            ],
            [
                'department_id' => '10',
                'specialisation_id' => '11',
                'duration' => '01:00:00',
                'price' => '60',
                'treatmentTitle' => 'Acupuncture'

            ]
        ]);

        DB::table('locations')->insert([
            [
                'hospitalName' => 'Gleneagles Hospital',
                'address' => '6A Napier Road',
                'city' => 'Singapore',
                'postalCode' => '258500'
            ],
            [
                'hospitalName' => 'Khoo Teck Puat Hospital',
                'address' => '90 Yishun Central',
                'city' => 'Singapore',
                'postalCode' => '768828'
            ],
            [
                'hospitalName' => 'Mount Alvernia Hospital',
                'address' => '820 Thomson Road',
                'city' => 'Singapore',
                'postalCode' => '574623'
            ],
            [
                'hospitalName' => 'Tan Tock Seng Hospital',
                'address' => '11 Jln Tan Tock Seng',
                'city' => 'Singapore',
                'postalCode' => '308433'
            ]
        ]);

        DB::table('medications')->insert([
            [
                "medicationName" => "Acetaminophen",
                "price" => "5.00",
            ],
            [
                "medicationName" => "Januvia",
                "price" => "7.00",
            ],
            [
                "medicationName" => "Omeprazole",
                "price" => "3.00",
            ],
            [
                "medicationName" => "Kevzara",
                "price" => "5.20",
            ],
            [
                "medicationName" => "Farxiga",
                "price" => "4.00",
            ],
            [
                "medicationName" => "Benzonatate",
                "price" => "8.00",
            ],
            [
                "medicationName" => "Viagra",
                "price" => "10.00",
            ]
        ]);
        
        DB::table('educational_materials')->insert([
            [
                "created_at" => "2022-01-28 10:12:46",
                "updated_at" => "2022-01-28 10:12:46",
                "title" => "Women and Heart Disease",
                "eduDesc" => "How does heart disease affect women?
                Despite increases in awareness over the past decades, only about half (56%) of women recognize that heart disease is their number 1 killer.                
                Heart disease is the leading cause of death for women in the United States, killing 299,578 women in 2017—or about 1 in every 5 female deaths.
                Heart disease is the leading cause of death for African American and white women in the United States. Among American Indian and Alaska Native
                women, heart disease and cancer cause roughly the same number of deaths each year. For Hispanic and Asian or Pacific Islander women, heart
                disease is second only to cancer as a cause of death.
                About 1 in 16 women age 20 and older (6.2%) have coronary heart disease, the most common type of heart disease:
                About 1 in 16 white women (6.1%), black women (6.5%), and Hispanic women (6%)
                About 1 in 30 Asian women (3.2%)
                What are the symptoms of heart disease?
                Although some women have no symptoms, others may have:
                
                Angina (dull and heavy or sharp chest pain or discomfort)
                Pain in the neck, jaw, or throat
                Pain in the upper abdomen or back
                These symptoms may happen when you are resting or when you are doing regular daily activities. Women also may have other symptoms, including
                
                Nausea
                Vomiting
                Fatigue
                Sometimes heart disease may be “silent” and not diagnosed until you have other symptoms or emergencies, including
                
                Heart attack: Chest pain or discomfort, upper back or neck pain, indigestion, heartburn, nausea or vomiting, extreme fatigue, upper body discomfort, dizziness, and shortness of breath
                Arrhythmia: Fluttering feelings in the chest (palpitations)
                Heart failure: Shortness of breath, fatigue, or swelling of the feet, ankles, legs, abdomen, or neck veins"
            ],
            [
                "created_at" => "2022-01-28 10:22:46",
                "updated_at" => "2022-01-28 10:22:46",
                "title" => "How to Prevent Food Poisoning?",
                "eduDesc" => "Four Steps to Food Safety: Clean, Separate, Cook, Chill.
                Clean: Wash your hands and surfaces often.
                Germs that cause food poisoning can survive in many places and spread around your kitchen.
                Wash hands for 20 seconds with soap and water before, during, and after preparing food and before eating.
                Wash your utensils, cutting boards, and countertops with hot, soapy water.
                Rinse fresh fruits and vegetables under running water.
                Separate: Don’t cross-contaminate.
                Raw meat, poultry, seafood, and eggs can spread germs to ready-to-eat foods—unless you keep them separate.
                Use separate cutting boards and plates for raw meat, poultry, and seafood.
                When grocery shopping, keep raw meat, poultry, seafood, and their juices away from other foods.
                Keep raw meat, poultry, seafood, and eggs separate from all other foods in the refrigerator.
                Cook to the right temperature.
                Food is safely cooked when the internal temperature gets high enough to kill germs that can make you sick. The only way to tell if food is safely cooked is to use a food thermometer. You can’t tell if food is safely cooked by checking its color and texture.
                Use a food thermometer to ensure foods are cooked to a safe internal temperature.
                Whole cuts of beef, veal, lamb, and pork, including fresh ham (raw): 145°F (then allow the meat to rest for 3 minutes before carving or eating)
                Fish with fins: 145°F or cook until flesh is opaque
                Ground meats, such as beef and pork: 160°F
                All poultry, including ground chicken and turkey: 165°F
                Leftovers and casseroles: 165°F
                Chill: Refrigerate promptly.
                Bacteria can multiply rapidly if left at room temperature or in the “Danger Zone” between 40°F and 140°F. Never leave perishable food out for more than 2 hours (or 1 hour if exposed to temperatures above 90°F)."
            ],
            [
                "created_at" => "2022-01-29 10:29:40",
                "updated_at" => "2022-01-29 10:29:40",
                "title" => "Know Your Risk for High Blood Pressure",
                "eduDesc" => "What are conditions that increase my risk for high blood pressure?
                Some medical conditions can raise your risk for high blood pressure. If you have one of
                these conditions, you can take steps to manage it and lower your risk for high blood pressure.
                
                Elevated Blood Pressure
                Elevated blood pressure is blood pressure that is slightly higher than normal. High
                blood pressure usually develops over time. Having blood pressure that is slightly higher than normal increases your risk for developing chronic, or long-lasting, high blood pressure in the future.
                
                If your blood pressure is between 120/80 mmHg and 129/80 mmHg, you have elevated blood
                pressure. Learn more about how blood pressure is measured.
                
                You can take steps to manage your blood pressure and keep it in a healthy range.
                
                Diabetes
                About 6 out of 10 of people who have diabetes also have high blood pressure.1 Diabetes
                causes sugars to build up in the blood and also increases the risk for heart disease.
                
                Talk with your doctor about ways to manage diabetes and control other risk factors.
                
                What behaviors increase risk for high blood pressure?
                Your lifestyle choices can increase your risk for high blood pressure. To reduce
                your risk, your doctor may recommend changes to your lifestyle.
                
                The good news is that healthy behaviors can lower your risk for high blood pressure.
                
                Unhealthy Diet
                A diet that is too high in sodium and too low in potassium puts you at risk for
                high blood pressure.
                
                Eating too much sodium—an element in table salt—increases blood pressure. Most of
                the sodium we eat comes from processed and restaurant foods. Learn more about sodium
                and high blood pressure.
                
                Not eating enough potassiumexternal icon—a mineral that your body needs to work
                properly—also can increase blood pressure. Potassium is found in many
                foods; bananas, potatoes, beans, and yogurt have high levels of potassium.
                
                Physical Inactivity
                Getting regular physical activity helps your heart and blood vessels stay strong
                and healthy, which may help lower your blood pressure. Regular physical activity
                can also help you keep a healthy weight, which may also help lower your blood pressure.
                
                Obesity
                Having obesity is having excess body fat. Having obesity or overweight also means
                your heart must work harder to pump blood and oxygen around your body. Over time, this can add stress to your heart and blood vessels.
                
                Obesity is linked to higher “bad” cholesterol and triglyceride levels and to
                lower “good” cholesterol levels. Learn more about cholesterol.
                
                In addition to high blood pressure, having obesity can also lead to heart disease
                and diabetes. Talk to your health care team about a plan to reduce your weight
                to a healthy level.
                
                Too Much Alcohol
                Drinking too much alcohol can raise your blood pressure.
                
                Women should have no more than one drink a day.
                Men should have no more than two drinks a day.
                Tobacco Use
                Tobacco use increases your risk for high blood pressure. Smoking can damage the heart
                and blood vessels. Nicotine raises blood pressure, and breathing in carbon monoxide—which is produced from smoking tobacco—reduces the amount of oxygen that your blood can carry."
            ],
            [
                "created_at" => "2022-02-01 07:22:46",
                "updated_at" => "2022-02-01 07:22:46",
                "title" => "Preventing Stroke: Healthy Living",
                "eduDesc" => "Healthy Diet
                Choosing healthy meal and snack options can help you prevent stroke. Be sure
                to eat plenty of fresh fruits and vegetables.
                
                Eating foods low in saturated fats, trans fat, and cholesterol and high in fiber
                can help prevent high cholesterol. Limiting salt (sodium) in your diet can also lower
                your blood pressure. High cholesterol and high blood pressure increase your chances
                of having a stroke.
                
                Physical Activity
                Physical activity can help you stay at a healthy weight and lower your cholesterol
                and blood pressure levels. For adults, the Surgeon General recommends 2 hours and 30
                minutes of moderate-intensity aerobic physical activity, such as a brisk walk, each
                week. Children and teens should get 1 hour of physical activity every day.
                
                No Smoking
                Cigarette smoking greatly increases your chances of having a stroke. If you
                don’t smoke, don’t start. If you do smoke, quitting will lower your risk for
                stroke. Your doctor can suggest ways to help you quit.
                
                Limited Alcohol
                Avoid drinking too much alcohol, which can raise your blood pressure. Men
                should have no more than two drinks per day, and women only one."
            ],
            [
                "created_at" => "2022-02-02 07:52:48",
                "updated_at" => "2022-02-02 07:52:48",
                "title" => "How to Prevent Acne",
                "eduDesc" => "How to prevent acne
                1. Properly wash your face
                To help prevent pimples, it’s important to remove excess oil, dirt, and sweat daily. Washing
                your face too much may make acne worse, however.
                
                Mikailove suggests using cleansers that are sulfate-free, fragrance-free, and gentle
                enough for twice-daily use, rather than using harsh physical scrubs or drying foaming cleansers.
                
                HEALTHLINE CHALLENGE
                What can you learn in a month without alcohol?
                It’s never a bad time to check in on your relationship with alcohol. Learn how to navigate
                a month of sobriety with the month-long Alcohol Reset Challenge.
                
                To wash your face:
                
                Wet your face with warm, not hot, water.
                Apply a mild cleanser in a gentle, circular motion using your fingers, not a
                washcloth.
                Rinse thoroughly, and pat dry.
                Healthline’s picks for the best face washes for acne
                Neutrogena Oil-Free Acne Wash
                CeraVe Hydrating Facial Cleanser
                Bioré Charcoal Acne Daily Cleanser
                2. Know your skin type
                Knowing your skin type is generally helpful so that you’re able to know which
                products to use and avoid. You can use the following parameters to identify which skin type you may have (but you can also consult a dermatologist for help if you’re still unsure):
                
                Dry: Your skin often feels flaky and tight.
                Oily: Your skin tends to look shiny by the end of the day.
                Combination: You have both dry areas and oily areas (your oily area is usually
                the T-zone — your forehead, nose, and chin).
                Sensitive: Your skin is easily irritated and prone to redness.
                In general, oily skin types are more prone to acne, Mikailove says, but anyone can
                get pimples, no matter their skin type. Having your skin type information on hand will help you choose the right acne regimen to help your skin clear up.
                
                “For example, if your skin is sensitive and acneic, using too many actives that
                target acne like a salicylic acid wash, a salicylic acid exfoliating toner, and a retinol cream may be too much for your skin and lead to more breakouts due to a damaged skin barrier,” Mikailove. “If your skin is on the oilier side, using a moisturizer formulated for dry skin may be too occlusive and lead to clogged pores.”"
            ],
            [
                "created_at" => "2022-02-04 10:22:46",
                "updated_at" => "2022-02-04 10:22:46",
                "title" => "Access to safe abortion protects women’s and girls’ health and human rights",
                "eduDesc" => "Abortions are safe when they are carried out with a method that is recommended by
                WHO and that is appropriate to the pregnancy duration, and when the person carrying out the
                abortion has the necessary skills. Such abortions can be done using tablets (medical abortion) or
                a simple outpatient procedure.

                When women with unwanted pregnancies do not have access to safe abortion, they often resort to
                unsafe abortion. An abortion is unsafe when it is carried out either by a person lacking the
                necessary skills or in an environment that does not conform to minimal medical standards, or
                both. Characteristics of an unsafe abortion touch upon inappropriate circumstances before, during
                or after an abortion.
                
                Unsafe abortion can lead to immediate health risks – including death – as well as long-term
                complications, affecting women’s physical and mental health and well-being throughout her
                life-course. It also has financial implications for women and communities.
                
                Unsafe abortion procedures may involve the insertion of an object or substance (root, twig, or
                catheter or traditional concoction) into the uterus; dilatation and curettage performed
                incorrectly by an unskilled provider; ingestion of harmful substances; and application
                of external force."
            ],
            [
                "created_at" => "2022-02-04 12:22:46",
                "updated_at" => "2022-02-04 12:22:46",
                "title" => "Adolescent health",
                "eduDesc" =>"Adolescence is the phase of life between childhood and adulthood, from ages
                10 to 19. It is a unique stage of human development and an important time for laying the
                foundations of good health.

                Adolescents experience rapid physical, cognitive and psychosocial growth. This affects
                how they feel, think, make decisions, and interact with the world around them. 
                
                Despite being thought of as a healthy stage of life, there is significant death, illness
                and injury in the adolescent years. Much of this is preventable or treatable. During this
                phase, adolescents establish patterns of behaviour – for instance, related to diet, physical
                activity, substance use, and sexual activity – that can protect their health and the health of others around them, or put their health at risk now and in the future.
                
                To grow and develop in good health, adolescents need information, including age-appropriate
                comprehensive sexuality education; opportunities to develop life skills; health services that
                are acceptable, equitable, appropriate and effective; and safe and supportive environments. They
                also need opportunities to meaningfully participate in the design and delivery of interventions
                to improve and maintain their health. Expanding such opportunities is key to responding to
                adolescents’ specific needs and rights."
            ],
            [
                "created_at" => "2022-02-04 12:30:46",
                "updated_at" => "2022-02-04 12:30:46",
                "title" => "Ageing",
                "eduDesc" => "Every person – in every country in the world – should have the opportunity to
                live a long and healthy life. Yet, the environments in which we live can favour health or
                be harmful to it. Environments are highly influential on our behaviour and our exposure to
                health risks (for example, air pollution or violence), our access to services (for
                example, health and social care) and the opportunities that ageing brings. 

                The number and proportion of people aged 60 years and older in the population is increasing.
                In 2019, the number of people aged 60 years and older was 1 billion. This number will increase
                to 1.4 billion by 2030 and 2.1 billion by 2050. This increase is occurring at an unprecedented
                pace and will accelerate in coming decades, particularly in developing countries.
                
                This historically significant change in the global population requires adaptations to the
                way societies are structured across all sectors. For example, health and social
                care, transportation, housing and urban planning. Working to make the world more
                age-friendly is an essential and urgent part of our changing demographics."
            ],
            [
                "created_at" => "2022-02-04 02:32:42",
                "updated_at" => "2022-02-04 02:32:42",
                "title" => "Air pollution",
                "eduDesc" => "Air pollution is contamination of the indoor or outdoor environment by any
                chemical, physical or biological agent that modifies the natural characteristics of
                the atmosphere. Household combustion devices, motor vehicles, industrial facilities
                and forest fires are common sources of air pollution. Pollutants of major public
                health concern include particulate matter, carbon monoxide, ozone, nitrogen dioxide
                and sulfur dioxide. Outdoor and indoor air pollution cause respiratory and other
                diseases and is an important source of morbidity and mortality. 

                Air pollution kills an estimated seven million people worldwide every year. WHO data
                shows that almost all of the global population (99%) breathe air that exceeds WHO guideline
                limits containing high levels of pollutants, with low- and middle-income countries
                suffering from the highest exposures. WHO is supporting countries to address air pollution. 
                
                From smog hanging over cities to smoke inside the home, air pollution poses a major
                threat to health and climate. The combined effects of ambient (outdoor) and household
                air pollution cause millions of premature deaths every year, largely as a result of
                increased mortality from stroke, heart disease, chronic obstructive pulmonary
                disease, lung cancer and acute respiratory infections."
            ],
            [
                "created_at" => "2022-02-04 03:30:42",
                "updated_at" => "2022-02-04 03:30:42",
                "title" => "Anaemia",
                "eduDesc" => "Anaemia is a condition in which the number of red blood cells
                or the haemoglobin concentration within them is lower than normal. Haemoglobin
                is needed to carry oxygen and if you have too few or abnormal red blood cells, or
                not enough haemoglobin, there will be a decreased capacity of the blood to carry
                oxygen to the body’s tissues. This results in symptoms such as fatigue, weakness, dizziness
                and shortness of breath, among others. The optimal haemoglobin concentration needed
                to meet physiologic needs varies by age, sex, elevation of residence, smoking habits
                and pregnancy status. The most common causes of anaemia include nutritional
                deficiencies, particularly iron deficiency, though deficiencies in folate, vitamins
                B12 and A are also important causes; haemoglobinopathies; and infectious diseases, such
                as malaria, tuberculosis, HIV and parasitic infections. 

                Anaemia is a serious global public health problem that particularly affects young children and
                pregnant women. WHO estimates that 42% of children less than 5 years of age and 40% of pregnant
                women worldwide are anaemic."
            ],
            [
                "created_at" => "2022-02-04 03:45:42",
                "updated_at" => "2022-02-04 03:45:42",
                "title" => "Biological weapons",
                "eduDesc" => "Biological weapons are microorganisms like virus, bacteria, fungi, or
                other toxins that are produced and released deliberately to cause disease and death
                in humans, animals or plants. 

                Biological agents, like anthrax, botulinum toxin and plague can pose a difficult
                public health challenge causing large numbers of deaths in a short amount of time
                while being difficult to contain. Bioterrorism attacks could also result in an
                epidemic, for example if Ebola or Lassa viruses were used as the biological agents. 
                
                Biological weapons is a subset of a larger class of weapons referred to as weapons
                of mass destruction, which also includes chemical, nuclear and radiological weapons. The
                use of biological agents is a serious problem, and the risk of using these agents
                in a bioterrorist attack is increasing."
            ],
            [
                "created_at" => "2022-02-04 05:45:42",
                "updated_at" => "2022-02-04 05:45:42",
                "title" => "Brain health",
                "eduDesc" => "Brain Health is an emerging and growing concept that encompasses neural
                 development, plasticity, functioning, and recovery across the life course.

                Good brain health is a state in which every individual can realize their own abilities
                and optimize their cognitive, emotional, psychological and behavioural functioning to
                cope with life situations. Numerous interconnected social and biological
                determinants (incl. genetics) play a role in brain development and brain health from
                pre-conception through the end of life. These determinants influence the way our brains
                develop, adapt and respond to stress and adversity, giving way to strategies for both
                promotion and prevention across the life course.
                
                Brain health conditions emerge throughout the life course and are characterized by disruptions
                in normal brain growth and/or brain functioning. They may manifest as neurodevelopmental
                and neurological conditions such as intellectual developmental disorders, autism spectrum
                disorders, epilepsy, cerebral palsy, dementia, cerebrovascular disease, headache, multiple
                sclerosis, Parkinson’s disease, neuroinfections, brain tumors, traumatic injury and
                neurological disorders resulting from malnutrition. Health and social care for these
                conditions require multisectoral and interdisciplinary collaborations with a holistic
                person-centered approach focused on promotion, prevention, treatment, care and
                rehabilitation over the lifespan and the active engagement of persons experiencing
                the conditions and their families and carers, as appropriate."
            ],
            [
                "created_at" => "2022-02-04 10:45:42",
                "updated_at" => "2022-02-04 10:45:42",
                "title" => "Breastfeeding",
                "eduDesc" => "Breastfeeding is one of the most effective ways to ensure child health
                 and survival. However, nearly 2 out of 3 infants are not exclusively breastfed for the
                recommended 6 months—a rate that has not improved in 2 decades. 

                Breastmilk is the ideal food for infants. It is safe, clean and contains antibodies
                which help protect against many common childhood illnesses. Breastmilk provides all
                the energy and nutrients that the infant needs for the first months of life, and it
                continues to provide up to half or more of a child’s nutritional needs during the
                second half of the first year, and up to one third during the second year of life. 
                
                Breastfed children perform better on intelligence tests, are less likely to be overweight
                or obese and less prone to diabetes later in life. Women who breastfeed also have a reduced
                risk of breast and ovarian cancers. 
                
                Inappropriate marketing of breast-milk substitutes continues to undermine efforts to
                improve breastfeeding rates and duration worldwide."
            ],
            [
                "created_at" => "2022-02-04 10:50:31",
                "updated_at" => "2022-02-04 10:50:31",
                "title" => "Cancer",
                "eduDesc" => "Cancer is a large group of diseases that can start in almost any organ or
                tissue of the body when abnormal cells grow uncontrollably, go beyond their usual
                boundaries to invade adjoining parts of the body and/or spread to other organs. The latter process is called metastasizing and is a major cause of death from cancer. A neoplasm and malignant tumour are other common names for cancer.

                Cancer is the second leading cause of death globally, accounting for an estimated
                9.6 million deaths, or one in six deaths, in 2018. Lung, prostate, colorectal, stomach and
                liver cancer are the most common types of cancer in men, while breast, colorectal, lung,
                cervical and thyroid cancer are the most common among women.
                
                The cancer burden continues to grow globally, exerting tremendous physical, emotional and
                financial strain on individuals, families, communities and health systems. Many health
                systems in low- and middle-income countries are least prepared to manage this burden, and
                large numbers of cancer patients globally do not have access to timely quality diagnosis
                and treatment. In countries where health systems are strong, survival rates of many types
                of cancers are improving thanks to accessible early detection, quality treatment and
                survivorship care."
            ],
            [
                "created_at" => "2022-02-05 10:50:31",
                "updated_at" => "2022-02-05 10:50:31",
                "title" => "Chemical safety",
                "eduDesc" => "Chemical Safety is achieved by undertaking all activities involving chemicals
                in such a way as to ensure the safety of human health and the environment. It covers
                all chemicals, natural and manufactured, and the full range of exposure situations
                from the natural presence of chemicals in the environment to their extraction or
                synthesis, industrial production, transport use and disposal.

                Chemical safety has many scientific and technical components. Among these are
                toxicology, ecotoxicology and the process of chemical risk assessment which requires
                a detailed knowledge of exposure and of biological effects.
                
                Through the International Programme on Chemical Safety (IPCS), WHO works to establish
                the scientific basis for the sound management of chemicals, and to strengthen national
                capabilities and capacities for chemical safety."
            ]
        ]);


        DB::table('conditions')->insert([
            [
                "title" => "Osteoporosis",
                "conditionDesc" => "Osteoporosis causes bones to become 
                weak and brittle — so brittle that a fall or even mild 
                stresses such as bending over or coughing can cause a fracture",
                "conditionTreatment" => "Physical Therapy"
            ],
            [
                "title" => "Arthritis",
                "conditionDesc" => "Arthritis is the swelling and tenderness of one or more joints",
                "conditionTreatment" => "Physical Therapy"
            ],
            [
                "title" => "Insomnia",
                "conditionDesc" => "Insomnia is a common sleep disorder
                 that can make it hard to fall asleep, hard to stay asleep, 
                 or cause you to wake up too early and not be able to get back 
                 to sleep. You may still feel tired when you wake up",
                 "conditionTreatment" => "Psychotherapy/Medication"
            ],
            [
                "title" => "Obesity",
                "conditionDesc" => "Overweight and obesity are defined as
                 abnormal or excessive fat accumulation that presents a risk to health",
                 "conditionTreatment" => "Endoscopic sleeve gastroplasty/Gastric bypass surgery/Medication"
            ],
            [
                "title" => "Malaria",
                "conditionDesc" => "Malaria is a serious and sometimes
                fatal disease caused by a parasite that commonly infects 
                a certain type of mosquito which feeds on humans. People 
                who get malaria are typically very sick with high fevers, 
                shaking chills, and flu-like illness",
                "conditionTreatment" => "Medication (Antimalarial)"
            ],
            [
                "title" => "Tuberculosis",
                "conditionDesc" => "Tuberculosis is a potentially serious
                 infectious disease that mainly affects the lungs. The bacteria
                 that cause tuberculosis are spread from person to person through
                 tiny droplets released into the air via coughs and sneezes",
                 "conditionTreatment" => "Medication (Antibiotics)"
            ],
            [
                "title" => "High Cholesterol",
                "conditionDesc" => "Cholesterol is a fat-like substance found in
                 your body. Your body needs cholesterol to function normally, but
                 when there is too much cholesterol, it is deposited in your
                 arteries, including those in the heart. This can lead to narrowing
                 of the arteries and to heart disease",
                 "conditionTreatment" => "Medication (Niacin/Omega-3 fatty acid supplements)"
            ],
            [
                "title" => "Hyperthermia",
                "conditionDesc" => "Hyperthermia is an abnormally high body
                 temperature caused by a failure of the heat-regulating mechanisms
                 of the body to deal with the heat coming from the environment",
                 "conditionTreatment" => "General Care (Rehydration, External Cooling)"
            ],
            [
                "title" => "Headache",
                "conditionDesc" => "This is a common condition that causes 
                pain and discomfort in the head or neck",
                "conditionTreatment" => "Medication (Acetaminophen, ibuprofen,aspirin)"
            ],
            [
                "title" => "Common Cold",
                "conditionDesc" => "It will usually give you a stuffy
                 or runny nose, a sore throat and headache. Most cases are mild, so
                you should be able to treat yours with plenty of rest, proper
                hydration and over-the-counter nasal decongestants",
                "conditionTreatment" => "Medication (to relieve symptoms)"
            ],
            [
                "title" => "Cough",
                "conditionDesc" => "It can be caused by an infection – like
                the flu, which is caused by that pesky rhinovirus – or by
                something else, like acid reflux, asthma or smoking",
                "conditionTreatment" => "Medication (Antibiotics, antihistamines, corticosteroids and decongestants)"
            ],
            [
                "title" => "Fever",
                "conditionDesc" => "A fever is usually a symptom of
                something else, like a lung or ear infection, and will
                usually go away after a few days of rest",
                "conditionTreatment" => "Medication (Acetaminophen, ibuprofen,aspirin)"
            ],
            [
                "title" => "Anxiety",
                "conditionDesc" => "Anxiety is a feeling of unease, such
                 as worry or fear, that can be mild or severe",
                 "conditionTreatment" => "Psychotherapy/Medication"
            ],
            [
                "title" => "Asthma",
                "conditionDesc" => "Asthma is a common long-term
                condition that can cause coughing, wheezing, chest
                tightness and breathlessness",
                "conditionTreatment" => "Inhalers/Medication/Surgery"
            ],
            [
                "title" => "Diarrhoea",
                "conditionDesc" => "Diarrhoea — loose, watery and possibly
                more-frequent bowel movements — is a common problem. It may
                be present alone or be associated with other symptoms, such
                as nausea, vomiting, abdominal pain or weight loss",
                "conditionTreatment" => "Medication (Antibiotics)"
            ],
            [
                "title" => "Pneumonia",
                "conditionDesc" => "Pneumonia is an infection that inflames
                your lungs' air sacs (alveoli). The air sacs may fill up with
                fluid or pus, causing symptoms such as a cough, fever, chills
                and trouble breathing",
                "conditionTreatment" => "Medication (Antibiotics)"
            ],
            [
                "title" => "Acne",
                "conditionDesc" => "Acne is a common skin condition that affects
                 most people at some point. It causes spots, oily skin and sometimes
                  skin that's hot or painful to touch",
                  "conditionTreatment" => "Light Therapy/Chemical Peel/Milia and comedonal extraction"
            ],
            [
                "title" => "Autism",
                "conditionDesc" => "Autism, or autism spectrum disorder (ASD), refers
                to a broad range of conditions characterized by challenges with
                social skills, repetitive behaviors, speech and nonverbal communication",
                "conditionTreatment" => "Psychotherapy (such as behavioral therapy)"
            ],
            [
                "title" => "Bronchiolitis ",
                "conditionDesc" => "Bronchiolitis (brong-kee-oh-LYE-tiss) is an infection
                of the respiratory tract. It happens when tiny airways called
                bronchioles (BRONG-kee-olz) get infected with a virus. They swell
                and fill with mucus, which can make breathing hard",
                "conditionTreatment" => "Medication (to relieve symptoms)"
            ],
            [
                "title" => "Cholera",
                "conditionDesc" => "Cholera is an acute diarrheal illness caused
                 by infection of the intestine with Vibrio cholerae bacteria. People
                can get sick when they swallow food or water contaminated with
                cholera bacteria. The infection is often mild or without
                symptoms, but can sometimes be severe and life-threatening",
                "conditionTreatment" => "Rehydration Therapy"
            ],
            [
                "title" => "Stomachache",
                "conditionDesc" => "A stomach ache is cramps or a dull ache
                 in the tummy (abdomen). It usually does not last long and is often not serious",
                 "conditionTreatment" => "Medication (Anatacids/Painkillers)"
            ]
        ]);
        DB::table('tagging_tags')->insert([
            [
                "slug" => "bones",
                "name" => "bones",
                "suggest" => "0",
                "count" => "10"
            ],
            [
                "slug" => "joint",
                "name" => "joint",
                "suggest" => "0",
                "count" => "10"
            ],
            [
                "slug" => "pain",
                "name" => "pain",
                "suggest" => "0",
                "count" => "10"
            ],
            [
                "slug" => "sleep",
                "name" => "sleep",
                "suggest" => "0",
                "count" => "10"
            ],
            [
                "slug" => "fatigue",
                "name" => "fatigue",
                "suggest" => "0",
                "count" => "10"
            ],
            [
                "slug" => "weight",
                "name" => "weight",
                "suggest" => "0",
                "count" => "10"
            ],
            [
                "slug" => "fever",
                "name" => "fever",
                "suggest" => "0",
                "count" => "10"
            ],
            [
                "slug" => "chills",
                "name" => "chills",
                "suggest" => "0",
                "count" => "10"
            ],
            [
                "slug" => "cough",
                "name" => "cough",
                "suggest" => "0",
                "count" => "10"
            ],
            [
                "slug" => "sneeze",
                "name" => "sneeze",
                "suggest" => "0",
                "count" => "10"
            ],
            [
                "slug" => "heart",
                "name" => "heart",
                "suggest" => "0",
                "count" => "10"
            ],
            [
                "slug" => "cholestrol",
                "name" => "cholestrol",
                "suggest" => "0",
                "count" => "10"
            ],
            [
                "slug" => "heat-injury",
                "name" => "heat-injury",
                "suggest" => "0",
                "count" => "10"
            ],
            [
                "slug" => "head",
                "name" => "head",
                "suggest" => "0",
                "count" => "10"
            ],
            [
                "slug" => "runny-nose",
                "name" => "runny-nose",
                "suggest" => "0",
                "count" => "10"
            ],
            [
                "slug" => "blocked-nose",
                "name" => "blocked-nose",
                "suggest" => "0",
                "count" => "10"
            ],
            [
                "slug" => "sore-throat",
                "name" => "sore-throat",
                "suggest" => "0",
                "count" => "10"
            ],
            [
                "slug" => "flu",
                "name" => "flu",
                "suggest" => "0",
                "count" => "10"
            ],
            [
                "slug" => "mental",
                "name" => "mental",
                "suggest" => "0",
                "count" => "10"
            ],
            [
                "slug" => "lungs",
                "name" => "lungs",
                "suggest" => "0",
                "count" => "10"
            ],
            [
                "slug" => "stomach",
                "name" => "stomach",
                "suggest" => "0",
                "count" => "10"
            ],
            [
                "slug" => "diarrhoea",
                "name" => "diarrhoea",
                "suggest" => "0",
                "count" => "10"
            ],
            [
                "slug" => "skin",
                "name" => "skin",
                "suggest" => "0",
                "count" => "10"
            ],
            [
                "slug" => "brain",
                "name" => "brain",
                "suggest" => "0",
                "count" => "10"
            ],
            [
                "slug" => "blood-pressure",
                "name" => "blood-pressure",
                "suggest" => "0",
                "count" => "10"
            ],
            [
                "slug" => "female-health",
                "name" => "female-health",
                "suggest" => "0",
                "count" => "10"
            ],
            [
                "slug" => "general-health",
                "name" => "general-health",
                "suggest" => "0",
                "count" => "10"
            ],
            [
                "slug" => "blood",
                "name" => "blood",
                "suggest" => "0",
                "count" => "10"
            ],
            [
                "slug" => "general-knowledge",
                "name" => "general-knowledge",
                "suggest" => "0",
                "count" => "10"
            ],
            [
                "slug" => "cancer",
                "name" => "cancer",
                "suggest" => "0",
                "count" => "10"
            ],
            [
                "slug" => "safety",
                "name" => "safety",
                "suggest" => "0",
                "count" => "10"
            ]
            
        ]);

        DB::table('tagging_tagged')->insert([
            [
                "taggable_id" => "1",
                "taggable_type" => "App\Models\Condition",
                "tag_name" => "bones",
                "tag_slug" => "bones"
            ],
            [
                "taggable_id" => "2",
                "taggable_type" => "App\Models\Condition",
                "tag_name" => "joint",
                "tag_slug" => "joint"
            ],
            [
                "taggable_id" => "2",
                "taggable_type" => "App\Models\Condition",
                "tag_name" => "pain",
                "tag_slug" => "pain"
            ],
            [
                "taggable_id" => "3",
                "taggable_type" => "App\Models\Condition",
                "tag_name" => "sleep",
                "tag_slug" => "sleep"
            ],
            [
                "taggable_id" => "3",
                "taggable_type" => "App\Models\Condition",
                "tag_name" => "fatigue",
                "tag_slug" => "fatigue"
            ],
            [
                "taggable_id" => "4",
                "taggable_type" => "App\Models\Condition",
                "tag_name" => "weight",
                "tag_slug" => "weight"
            ],
            [
                "taggable_id" => "5",
                "taggable_type" => "App\Models\Condition",
                "tag_name" => "fever",
                "tag_slug" => "fever"
            ],
            [
                "taggable_id" => "5",
                "taggable_type" => "App\Models\Condition",
                "tag_name" => "chills",
                "tag_slug" => "chills"
            ],
            [
                "taggable_id" => "6",
                "taggable_type" => "App\Models\Condition",
                "tag_name" => "cough",
                "tag_slug" => "cough"
            ],
            [
                "taggable_id" => "6",
                "taggable_type" => "App\Models\Condition",
                "tag_name" => "sneeze",
                "tag_slug" => "sneeze"
            ],
            [
                "taggable_id" => "7",
                "taggable_type" => "App\Models\Condition",
                "tag_name" => "heart",
                "tag_slug" => "heart"
            ],
            [
                "taggable_id" => "7",
                "taggable_type" => "App\Models\Condition",
                "tag_name" => "cholestrol",
                "tag_slug" => "cholestrol"
            ],
            [
                "taggable_id" => "8",
                "taggable_type" => "App\Models\Condition",
                "tag_name" => "heat-injury",
                "tag_slug" => "heat-injury"
            ],
            [
                "taggable_id" => "8",
                "taggable_type" => "App\Models\Condition",
                "tag_name" => "fever",
                "tag_slug" => "fever"
            ],
            [
                "taggable_id" => "9",
                "taggable_type" => "App\Models\Condition",
                "tag_name" => "pain",
                "tag_slug" => "pain"
            ],
            [
                "taggable_id" => "9",
                "taggable_type" => "App\Models\Condition",
                "tag_name" => "head",
                "tag_slug" => "head"
            ],
            [
                "taggable_id" => "10",
                "taggable_type" => "App\Models\Condition",
                "tag_name" => "runny-nose",
                "tag_slug" => "runny-nose"
            ],
            [
                "taggable_id" => "10",
                "taggable_type" => "App\Models\Condition",
                "tag_name" => "blocked-nose",
                "tag_slug" => "blocked-nose"
            ],
            [
                "taggable_id" => "10",
                "taggable_type" => "App\Models\Condition",
                "tag_name" => "sore-throat",
                "tag_slug" => "sore-throat"
            ],
            [
                "taggable_id" => "11",
                "taggable_type" => "App\Models\Condition",
                "tag_name" => "cough",
                "tag_slug" => "cough"
            ],
            [
                "taggable_id" => "11",
                "taggable_type" => "App\Models\Condition",
                "tag_name" => "flu",
                "tag_slug" => "flu"
            ],
            [
                "taggable_id" => "12",
                "taggable_type" => "App\Models\Condition",
                "tag_name" => "fever",
                "tag_slug" => "fever"
            ],
            [
                "taggable_id" => "13",
                "taggable_type" => "App\Models\Condition",
                "tag_name" => "mental",
                "tag_slug" => "mental"
            ],
            [
                "taggable_id" => "14",
                "taggable_type" => "App\Models\Condition",
                "tag_name" => "lungs",
                "tag_slug" => "lungs"
            ],
            [
                "taggable_id" => "14",
                "taggable_type" => "App\Models\Condition",
                "tag_name" => "cough",
                "tag_slug" => "cough"
            ],
            [
                "taggable_id" => "15",
                "taggable_type" => "App\Models\Condition",
                "tag_name" => "stomach",
                "tag_slug" => "stomach"
            ],
            [
                "taggable_id" => "15",
                "taggable_type" => "App\Models\Condition",
                "tag_name" => "diarrhoea",
                "tag_slug" => "diarrhoea"
            ],
            [
                "taggable_id" => "16",
                "taggable_type" => "App\Models\Condition",
                "tag_name" => "lungs",
                "tag_slug" => "lungs"
            ],
            [
                "taggable_id" => "16",
                "taggable_type" => "App\Models\Condition",
                "tag_name" => "fever",
                "tag_slug" => "fever"
            ],
            [
                "taggable_id" => "16",
                "taggable_type" => "App\Models\Condition",
                "tag_name" => "chills",
                "tag_slug" => "chills"
            ],
            [
                "taggable_id" => "16",
                "taggable_type" => "App\Models\Condition",
                "tag_name" => "cough",
                "tag_slug" => "cough"
            ],
            [
                "taggable_id" => "17",
                "taggable_type" => "App\Models\Condition",
                "tag_name" => "skin",
                "tag_slug" => "skin"
            ],
            [
                "taggable_id" => "18",
                "taggable_type" => "App\Models\Condition",
                "tag_name" => "mental",
                "tag_slug" => "mental"
            ],
            [
                "taggable_id" => "18",
                "taggable_type" => "App\Models\Condition",
                "tag_name" => "brain",
                "tag_slug" => "brain"
            ],
            [
                "taggable_id" => "19",
                "taggable_type" => "App\Models\Condition",
                "tag_name" => "lungs",
                "tag_slug" => "lungs"
            ],
            [
                "taggable_id" => "19",
                "taggable_type" => "App\Models\Condition",
                "tag_name" => "fever",
                "tag_slug" => "fever"
            ],
            [
                "taggable_id" => "19",
                "taggable_type" => "App\Models\Condition",
                "tag_name" => "chills",
                "tag_slug" => "chills"
            ],
            [
                "taggable_id" => "19",
                "taggable_type" => "App\Models\Condition",
                "tag_name" => "cough",
                "tag_slug" => "cough"
            ],
            [
                "taggable_id" => "20",
                "taggable_type" => "App\Models\Condition",
                "tag_name" => "diarrhoea",
                "tag_slug" => "diarrhoea"
            ],
            [
                "taggable_id" => "21",
                "taggable_type" => "App\Models\Condition",
                "tag_name" => "stomach",
                "tag_slug" => "stomach"
            ],
            [
                "taggable_id" => "21",
                "taggable_type" => "App\Models\Condition",
                "tag_name" => "pain",
                "tag_slug" => "pain"
            ],
            [
                "taggable_id" => "1",
                "taggable_type" => "App\Models\EducationalMaterial",
                "tag_name" => "heart",
                "tag_slug" => "heart"
            ],
            [
                "taggable_id" => "1",
                "taggable_type" => "App\Models\EducationalMaterial",
                "tag_name" => "female-health",
                "tag_slug" => "female-health"
            ],
            [
                "taggable_id" => "2",
                "taggable_type" => "App\Models\EducationalMaterial",
                "tag_name" => "diarrhoea",
                "tag_slug" => "diarrhoea"
            ],
            [
                "taggable_id" => "2",
                "taggable_type" => "App\Models\EducationalMaterial",
                "tag_name" => "stomach",
                "tag_slug" => "stomach"
            ],
            [
                "taggable_id" => "3",
                "taggable_type" => "App\Models\EducationalMaterial",
                "tag_name" => "heart",
                "tag_slug" => "heart"
            ],
            [
                "taggable_id" => "3",
                "taggable_type" => "App\Models\EducationalMaterial",
                "tag_name" => "blood-pressure",
                "tag_slug" => "blood-pressure"
            ],
            [
                "taggable_id" => "4",
                "taggable_type" => "App\Models\EducationalMaterial",
                "tag_name" => "heart",
                "tag_slug" => "heart"
            ],
            [
                "taggable_id" => "4",
                "taggable_type" => "App\Models\EducationalMaterial",
                "tag_name" => "blood-pressure",
                "tag_slug" => "blood-pressure"
            ],
            [
                "taggable_id" => "5",
                "taggable_type" => "App\Models\EducationalMaterial",
                "tag_name" => "skin",
                "tag_slug" => "skin"
            ],
            [
                "taggable_id" => "6",
                "taggable_type" => "App\Models\EducationalMaterial",
                "tag_name" => "female-health",
                "tag_slug" => "female-health"
            ],
            [
                "taggable_id" => "7",
                "taggable_type" => "App\Models\EducationalMaterial",
                "tag_name" => "general-health",
                "tag_slug" => "general-health"
            ],
            [
                "taggable_id" => "8",
                "taggable_type" => "App\Models\EducationalMaterial",
                "tag_name" => "general-health",
                "tag_slug" => "general-health"
            ],
            [
                "taggable_id" => "9",
                "taggable_type" => "App\Models\EducationalMaterial",
                "tag_name" => "lungs",
                "tag_slug" => "lungs"
            ],
            [
                "taggable_id" => "10",
                "taggable_type" => "App\Models\EducationalMaterial",
                "tag_name" => "blood",
                "tag_slug" => "blood"
            ],
            [
                "taggable_id" => "11",
                "taggable_type" => "App\Models\EducationalMaterial",
                "tag_name" => "general-knowledge",
                "tag_slug" => "general-knowledge"
            ],
            [
                "taggable_id" => "12",
                "taggable_type" => "App\Models\EducationalMaterial",
                "tag_name" => "brain",
                "tag_slug" => "brain"
            ],
            [
                "taggable_id" => "13",
                "taggable_type" => "App\Models\EducationalMaterial",
                "tag_name" => "female-health",
                "tag_slug" => "female-health"
            ],
            [
                "taggable_id" => "14",
                "taggable_type" => "App\Models\EducationalMaterial",
                "tag_name" => "general-health",
                "tag_slug" => "general-health"
            ],
            [
                "taggable_id" => "14",
                "taggable_type" => "App\Models\EducationalMaterial",
                "tag_name" => "cancer",
                "tag_slug" => "cancer"
            ],
            [
                "taggable_id" => "15",
                "taggable_type" => "App\Models\EducationalMaterial",
                "tag_name" => "safety",
                "tag_slug" => "safety"
            ],
            [
                "taggable_id" => "15",
                "taggable_type" => "App\Models\EducationalMaterial",
                "tag_name" => "general-knowledge",
                "tag_slug" => "general-knowledge"
            ]
        ]);
    }
}
