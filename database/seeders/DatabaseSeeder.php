<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;

use App\Models\FormationGrade;
use App\Models\SubDomain;
use App\Models\Formation;
use App\Models\School;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);


        $school = School::create([
            'school_name' => 'Acadec School',
            'user_id' => '1',
            'mobile' => '771724497',
            'phone' => '338359898',
            'email' => 'contact@acadec.net',
            'address' => 'Yoff Virage',
            'website' => 'https://acadec.net',
        ]);
         $subdomain = SubDomain::create([
            'name' => 'Informatique',
            'description_domaine' => 'Etude sur la logique et de la technologie'
         ]);

        $grades = FormationGrade::insert([
            [
                "formation_grade" => "BTS",
            ],[
                "formation_grade" => "License",
            ],[
                "formation_grade" => "Master",
            ],[
                "formation_grade" => "Doctorat",
            ],
        ]);

        Formation::create([
            'formation_name' => 'Genie Informatique',
            'formation_type' => 'jour',
            'class_format' => 'prensentiel',
            'accreditation' => 'Anaqsup',
            'formation_duration' => '3',
            'study_level_required' => 'Baccalauret',
            'registration_payment' => '150000',
            'monthly_payment' => '50000',
            'school_id' => $school->id,
            'formation_grade_id' => 1,
            'sub_domain_id' => $subdomain->id,
        ]);
    }
}
