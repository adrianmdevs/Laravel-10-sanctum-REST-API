<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    //Using faker library in the master class seeder to populate the database with random data
    public function run(): void
    {

        $faker = Faker::create();


        //Seeding the teachers table;
        $uniqueTeacherIds = [];

        foreach (range(1, 20) as $index) {
            $teacherName = $faker->name;
            $subject = $faker->word;
            $phoneNumber = $faker->phoneNumber;
            $emailAddress = $faker->safeEmail;

            // Generate a unique teacher_id
            do {
                $teacherId = 'T' . $faker->numberBetween(1000, 9999);
            } while (in_array($teacherId, $uniqueTeacherIds));

            $uniqueTeacherIds[] = $teacherId;

            // Insert a contact record and get its ID
            $contactId = DB::table('contacts')->insertGetId([
                'phone_number' => $phoneNumber,
                'email_address' => $emailAddress,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('teachers')->insert([
                'teacher_id' => $teacherId,
                'teacher_name' => $teacherName,
                'subject' => $subject,
                'contact_id' => $contactId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        //Seeding the grades table
        foreach (range(1, 20) as $index) { //create 20 grade records
            DB::table('grades')->insert([
                'grade_id' => $faker->unique()->uuid,
                'grade_level' => $faker->numberBetween(1, 20),   // Assuming grade levels from 1 to 20
                'grade_name' => $faker->word,
                'teacher_id' => $faker->numberBetween(1, 20),   // Assuming 20 teachers
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        //Seeding the staff table:
        $uniqueStaffIds = [];

        foreach (range(1, 20) as $index) {
            $staffName = $faker->name;
            $occupation = $faker->word;
            $phoneNumber = $faker->phoneNumber;
            $emailAddress = $faker->safeEmail;

            // Generate a unique staff_id
            do {
                $staffId = 'S' . $faker->numberBetween(1000, 9999);
            } while (in_array($staffId, $uniqueStaffIds));

            $uniqueStaffIds[] = $staffId;

            // Insert a contact record and get its ID
            $contactId = DB::table('contacts')->insertGetId([
                'phone_number' => $phoneNumber,
                'email_address' => $emailAddress,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('staff')->insert([
                'staff_name' => $staffName,
                'staff_id' => $staffId,
                'occupation' => $occupation,
                'contact_id' => $contactId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        //Seeding the contacts table:
        foreach (range(1, 20) as $index) {
            DB::table('contacts')->insert([
                'phone_number' => $faker->phoneNumber,
                'email_address' => $faker->safeEmail,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        //Seeding the events table;
        foreach (range(1, 20) as $index) { //Create 20 events
            DB::table('events')->insert([
                'event_name' => $faker->word,
                'event_id' => $faker->unique()->uuid,
                'event_description' => $faker->sentence,
                'event_date' => $faker->date,
                'event_time' => $faker->time,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        //Seeding the pupils table
        foreach (range(1, 20) as $index) { //Create 20 pupils
            DB::table('pupils')->insert([
                'pupil_id' => $faker->unique()->uuid,
                'pupil_name' => $faker->name,
                'date_of_birth' => $faker->date,
                'address' => $faker->address,
                'grade_id' => $faker->numberBetween(1, 20), // Replace with appropriate grade IDs
                'guardian_id' => $faker->unique()->uuid,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        //Seeding the subjects table:
        foreach (range(1, 20) as $index) { //Create 20 subjects
            DB::table('subjects')->insert([
                'subject_id' => $faker->unique()->uuid,
                'subject_name' => $faker->word,
                'description' => $faker->sentence(6),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        //Seeding the exams table:
        foreach (range(1, 20) as $index) { //Create 20 exam records
            DB::table('exams')->insert([
                'exam_name' => $faker->word,
                'exam_date' => $faker->date,
                'grade_id' => $faker->numberBetween(1, 6),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        //Seeding the results table:
        foreach (range(1, 20) as $index) { //create 20 results records
            DB::table('results')->insert([
                'pupil_id' => $faker->numberBetween(1, 20), //Assuming 20 pupils
                'exam_id' => $faker->numberBetween(1, 20),   // Assuming 20 exams
                'subject_id' => $faker->numberBetween(1, 20), // Assuming 20 subjects
                'score' => $faker->numberBetween(0, 100),    // Scores as integers
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        //seeding the attendances table:
        foreach (range(1, 20) as $index) { //Create 20 attendances records
            DB::table('attendances')->insert([
                'attendance_status' => $faker->randomElement(['Present', 'Absent']),
                'date_entered' => $faker->date,
                'time_entered' => $faker->time,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        //Seeding the timetables table:
        foreach (range(1, 20) as $index) { //Create 20 timetable records
            DB::table('timetables')->insert([
                'teacher_id' => $faker->numberBetween(1, 20),   // Assuming 20 teachers
                'subject_id' => $faker->numberBetween(1, 20),  // Assuming 10 subjects
                'grade_id' => $faker->numberBetween(1, 20),    // Assuming 20 grades
                'day_of_week' => $faker->dayOfWeek,
                'start_time' => $faker->time,
                'end_time' => $faker->time,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        //Seeding notifications table.
        foreach (range(1, 20) as $index) { //Create 20 notifications records
            DB::table('notifications')->insert([
                'notification_id' => $faker->unique()->uuid,
                'pupil_id' => $faker->numberBetween(1, 20), // Assuming 20 pupils
                'message' => $faker->sentence(6),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        //Seeding the guardians table:
        $uniqueGuardianIds = [];

        foreach (range(1, 20) as $index) {
            $guardianName = $faker->name;
            $phoneNumber = $faker->phoneNumber;
            $emailAddress = $faker->safeEmail;

            // Generate a unique guardian_id
            do {
                $guardianId = 'G' . $faker->numberBetween(1000, 9999);
            } while (in_array($guardianId, $uniqueGuardianIds));

            $uniqueGuardianIds[] = $guardianId;

            // Insert a contact record and get its ID
            $contactId = DB::table('contacts')->insertGetId([
                'phone_number' => $phoneNumber,
                'email_address' => $emailAddress,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('guardians')->insert([
                'guardian_name' => $guardianName,
                'guardian_id' => $guardianId,
                'contact_id' => $contactId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        //Seeding the teacher_subject pivot table
        foreach (range(1, 20) as $index) { //20 pivot records
            DB::table('teacher_subject')->insert([
                'teacher_id' => $faker->numberBetween(1, 20),   // Assuming 20 teachers
                'subject_id' => $faker->numberBetween(1, 20),  // Assuming 20 subjects
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        //Seeder for the guardian_student-table:
        foreach (range(1, 20) as $index) { // Create 20 pivot records
            DB::table('guardian_student')->insert([
                'guardian_id' => $faker->numberBetween(1, 20),   // Assuming 20 guardians
                'pupil_id' => $faker->numberBetween(1, 20),     // Assuming 20 pupils
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        //Seeder student-subject_table:
        foreach (range(1, 20) as $index) { //Create 20 pivot records
            DB::table('student_subject')->insert([
                'pupil_id' => $faker->numberBetween(1, 20),     // Assuming 20 pupils
                'subject_id' => $faker->numberBetween(1, 20),  // Assuming 20 subjects
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        //Seeding the payment table;
        foreach (range(1, 20) as $index) { //Create 20 payment instance records
            DB::table('payments')->insert([
                'pupil_id' => $faker->numberBetween(1, 20),            // Assuming 20 pupils
                'guardian_id' => $faker->numberBetween(1, 20),        // Assuming 20 guardians
                'amount' => $faker->randomFloat(2, 10, 500),          // Random decimal amount
                'payment_date' => $faker->date,// Random payment date
                'notification_id' => $faker->numberBetween(1, 20),// Assuming 20 notifications
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }



    }
}
