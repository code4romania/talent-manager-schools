<?php namespace Genuineq\Tms\Updates;

use Genuineq\Tms\Models\Course;
use Genuineq\Tms\Models\Teacher;
use Genuineq\Tms\Models\LearningPlan;
use Genuineq\Tms\Models\LearningPlansCourse;
use October\Rain\Database\Updates\Seeder;
use Illuminate\Support\Facades\App;
use Faker;

class TestLearningPlansSeeder extends Seeder
{
    public function run()
    {
        /* Check if the environment is either local OR development. */
        if (App::environment(['local', 'development'])) {
            $faker = Faker\Factory::create('ro_RO');

            $totalYearsNumber = 20;
            $totalSemestersNumber = $totalYearsNumber * 2;
            $totalTeachersNumber = 80;
            $totalCoursesNumber = 100;

            /**
             * Creating learning plans.
             */
            for ($teacherNr=1; $teacherNr <= $totalTeachersNumber; $teacherNr++) {
                for ($semesterNr=1; $semesterNr <= $totalSemestersNumber ; $semesterNr++) {
                    if ($semesterNr == $totalSemestersNumber) {
                        $learningPlan = LearningPlan::create([
                            'teacher_id' =>  Teacher::find($teacherNr)->id,
                            'semester_id' => $semesterNr,
                            'status' => 1,
                        ]);
                    } else {
                        $learningPlan = LearningPlan::create([
                            'teacher_id' =>  Teacher::find($teacherNr)->id,
                            'semester_id' => $semesterNr,
                            'status' => 0,
                        ]);
                    }

                    $coursesNumber = $faker->numberBetween($min = 1, $max = 7);

                    $courses = array();
                    for ($j=0; $j < $coursesNumber; $j++) {
                        $course = $faker->numberBetween($min = 1, $max = $totalCoursesNumber);

                        while (in_array($course, $courses)) {
                            $course = $faker->numberBetween($min = 1, $max = $totalCoursesNumber);
                        }
                        $courses[] = $course;
                    }

                    for ($j=0; $j < $coursesNumber; $j++) {

                        switch ($faker->numberBetween($min = 1, $max = 7)) {
                            case 1:
                                LearningPlansCourse::create([
                                    'learning_plan_id' => $learningPlan->id,
                                    'course_id' => $courses[$j],
                                    'mandatory' => 0,
                                    'school_id' => $faker->randomElement([$teacherNr, (40 + $teacherNr)]),
                                    'requestable_id' => $faker->randomElement([$teacherNr, (40 + $teacherNr)]),
                                    'requestable_type' => 'Genuineq\Tms\Models\School',
                                    'covered_costs' => $faker->numberBetween($min = 0, $max = Course::find($courses[$j])->price),
                                    'status' => 'accepted',
                                ]);
                                break;

                            case 2:
                                LearningPlansCourse::create([
                                    'learning_plan_id' => $learningPlan->id,
                                    'course_id' => $courses[$j],
                                    'mandatory' => 0,
                                    'requestable_id' => $faker->randomElement([$teacherNr, (40 + $teacherNr)]),
                                    'requestable_type' => 'Genuineq\Tms\Models\School',
                                    'covered_costs' => $faker->numberBetween($min = 0, $max = Course::find($courses[$j])->price),
                                    'status' => 'proposed',
                                ]);

                            case 3:
                                LearningPlansCourse::create([
                                    'learning_plan_id' => $learningPlan->id,
                                    'course_id' => $courses[$j],
                                    'mandatory' => 0,
                                    'requestable_id' => $faker->randomElement([$teacherNr, (40 + $teacherNr)]),
                                    'requestable_type' => 'Genuineq\Tms\Models\School',
                                    'covered_costs' => $faker->numberBetween($min = 0, $max = Course::find($courses[$j])->price),
                                    'status' => 'declined',
                                ]);
                                break;

                            case 4:
                                LearningPlansCourse::create([
                                    'learning_plan_id' => $learningPlan->id,
                                    'course_id' => $courses[$j],
                                    'mandatory' => 1,
                                    'school_id' => $faker->randomElement([$teacherNr, (40 + $teacherNr)]),
                                    'covered_costs' => $faker->numberBetween($min = 0, $max = Course::find($courses[$j])->price),
                                    'status' => 'accepted',
                                ]);
                                break;

                            case 5:
                                LearningPlansCourse::create([
                                    'learning_plan_id' => $learningPlan->id,
                                    'course_id' => $courses[$j],
                                    'mandatory' => 0,
                                    'school_id' => $faker->randomElement([$teacherNr, (40 + $teacherNr)]),
                                    'requestable_id' => $teacherNr,
                                    'requestable_type' => 'Genuineq\Tms\Models\Teacher',
                                    'covered_costs' => $faker->numberBetween($min = 0, $max = Course::find($courses[$j])->price),
                                    'status' => 'proposed',
                                ]);
                                break;

                            case 6:
                                LearningPlansCourse::create([
                                    'learning_plan_id' => $learningPlan->id,
                                    'course_id' => $courses[$j],
                                    'mandatory' => 0,
                                    'school_id' => $faker->randomElement([$teacherNr, (40 + $teacherNr)]),
                                    'requestable_id' => $teacherNr,
                                    'requestable_type' => 'Genuineq\Tms\Models\Teacher',
                                    'covered_costs' => $faker->numberBetween($min = 0, $max = Course::find($courses[$j])->price),
                                    'status' => 'accepted',
                                ]);
                                break;

                            case 7:
                                LearningPlansCourse::create([
                                    'learning_plan_id' => $learningPlan->id,
                                    'course_id' => $courses[$j],
                                    'mandatory' => 0,
                                    'school_id' => $faker->randomElement([$teacherNr, (40 + $teacherNr)]),
                                    'requestable_id' => $teacherNr,
                                    'requestable_type' => 'Genuineq\Tms\Models\Teacher',
                                    'covered_costs' => $faker->numberBetween($min = 0, $max = Course::find($courses[$j])->price),
                                    'status' => 'declined',
                                ]);
                                break;
                        }
                    }
                }
            }
        }
    }
}
