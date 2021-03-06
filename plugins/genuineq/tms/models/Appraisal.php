<?php namespace Genuineq\Tms\Models;

use Log;
use Lang;
use Model;
use Genuineq\Tms\Models\Semester;
use Genuineq\Tms\Models\Teacher;

/**
 * Model
 */
class Appraisal extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\SoftDelete;
    use \Jacob\Logbook\Traits\LogChanges;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * @var array The attributes that are mass assignable.
     */
    protected $fillable = [
        'school_id',
        'teacher_id',
        'semester_id',
        'objectives',
        'skill_1_id',
        'grade_1',
        'percentage_1',
        'skill_2_id',
        'grade_2',
        'percentage_2',
        'skill_3_id',
        'grade_3',
        'percentage_3',
        'notes_objectives_set',
        'notes_objectives_approved',
        'notes_skills_set',
        'notes_evaluation_opened',
        'status',
    ];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'genuineq_tms_appraisals';

    /**
     * Here you can override the model name that is displayed in the log files.
     * The name is going to be translated when possible.
     */
    public $logBookModelName = 'Appraisal';

    /**
     * Delete log book items after model is deleted
     *
     * If true -&gt; log items are deleted when the model is deleted
     * If false -&gt; a new log item will be created with status deleted.
     *
     * @var bool
     */
    protected $deleteLogbookAfterDelete = true;

    /**
     * Belongs to relations
     */
    public $belongsTo = [
        'teacher' => ['Genuineq\Tms\Models\Teacher'],
        'school' => ['Genuineq\Tms\Models\School'],
        'semester' => ['Genuineq\Tms\Models\Semester'],
        /** Skills relation */
        'firstSkill' => ['Genuineq\Tms\Models\Skill', 'key' => 'skill_1_id'],
        'secondSkill' => ['Genuineq\Tms\Models\Skill', 'key' => 'skill_2_id'],
        'thirdSkill' => ['Genuineq\Tms\Models\Skill', 'key' => 'skill_3_id']
    ];

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    /***********************************************
     ******************* Mutators ******************
     ***********************************************/

    /**
     * Function that extracts the name
     *  of the school that owns the appraisal.
     */
    public function getSchoolNameAttribute()
    {
        return $this->school->name;
    }

    /**
     * Function that extracts the name
     *  of the teacher for whch the appraisal is.
     */
    public function getTeacherNameAttribute()
    {
        return $this->teacher->name;
    }

    /**
     * Function that extracts the name
     *  of the semester for whch the appraisal is.
     */
    public function getSemesterNameAttribute()
    {
        return $this->semester->year . '-' . $this->semester->semester;
    }

    /**
     * Function that extracts the name
     *  of the first skill.
     */
    public function getFirstSkillNameAttribute()
    {
        return ($this->firstSkill) ? ($this->firstSkill->name) : ('');
    }

    /**
     * Function that extracts the name
     *  of the second skill.
     */
    public function getSecondSkillNameAttribute()
    {
        return ($this->secondSkill) ? ($this->secondSkill->name) : ('');
    }

    /**
     * Function that extracts the name
     *  of the third skill.
     */
    public function getThirdSkillNameAttribute()
    {
        return ($this->thirdSkill) ? ($this->thirdSkill->name) : ('');
    }

    /**
     * Function that extracts the grade
     *  for the first skill.
     */
    public function getFirstSkillGradeAttribute()
    {
        return ($this->grade_1) ? ($this->grade_1) : ('');
    }

    /**
     * Function that extracts the grade
     *  for the second skill.
     */
    public function getSecondSkillGradeAttribute()
    {
        return ($this->grade_2) ? ($this->grade_2) : ('');
    }

    /**
     * Function that extracts the grade
     *  for the third skill.
     */
    public function getThirdSkillGradeAttribute()
    {
        return ($this->grade_3) ? ($this->grade_3) : ('');
    }

    /**
     * Function that extracts the description
     *  of the first skill.
     */
    public function getFirstSkillDescriptionAttribute()
    {
        return ($this->firstSkill) ? ($this->firstSkill->description) : ('');
    }

    /**
     * Function that extracts the description
     *  of the second skill.
     */
    public function getSecondSkillDescriptionAttribute()
    {
        return ($this->secondSkill) ? ($this->secondSkill->description) : ('');
    }

    /**
     * Function that extracts the description
     *  of the third skill.
     */
    public function getThirdSkillDescriptionAttribute()
    {
        return ($this->thirdSkill) ? ($this->thirdSkill->description) : ('');
    }

    /**
     * Function that extracts the avegage grade of the appraisal.
     */
    public function getAverageAttribute()
    {
        $average = 0;

        $average += (($this->percentage_1 / 100) * ($this->grade_1) ? ((('percentage' == $this->evaluation_type_1) ? ($this->grade_1 / 100) : ($this->grade_1))) : (0));
        $average += (($this->percentage_2 / 100) * ($this->grade_2) ? ((('percentage' == $this->evaluation_type_2) ? ($this->grade_2 / 100) : ($this->grade_2))) : (0));
        $average += (($this->percentage_3 / 100) * ($this->grade_3) ? ((('percentage' == $this->evaluation_type_3) ? ($this->grade_3 / 100) : ($this->grade_3))) : (0));

        return round(($average / 3), 2);
    }

    /**
     * Function that extracts the frontend display
     *  for the appraisal status.
     */
    public function getFrontendStatusAttribute()
    {
        $val = '';
        switch ($this->status) {
            case 'new':
                $val = Lang::get('genuineq.tms::lang.appraisal.frontend.new');
                break;

            case 'objectives-set':
                $val = Lang::get('genuineq.tms::lang.appraisal.frontend.objectives_set');
                break;

            case 'objectives-approved':
                $val = Lang::get('genuineq.tms::lang.appraisal.frontend.objectives_approved');
                break;

            case 'skills-set':
                $val = Lang::get('genuineq.tms::lang.appraisal.frontend.skills_set');
                break;

            case 'evaluation-opened':
                $val = Lang::get('genuineq.tms::lang.appraisal.frontend.evaluation_opened');
                break;

            case 'closed':
                $val = Lang::get('genuineq.tms::lang.appraisal.frontend.closed');
                break;
            }

        return $val;
    }

    /**
     * Function that extracts the frontend display
     *  for the appraisal evaluation type.
     */
    public function getEvaluationTypesAttribute()
    {
        return [
            'grade' => Lang::get('genuineq.tms::lang.appraisal.frontend.grade'),
            'percentage' => Lang::get('genuineq.tms::lang.appraisal.frontend.percentage')
        ];
    }

    /***********************************************
     ******************** Events *******************
     ***********************************************/

    /**
     * Create all dependencies;
     */
    public function beforeCreate()
    {
        $this->semester_id = Semester::latest()->first()->id;
    }

    /***********************************************
     **************** Search/Filter ****************
     ***********************************************//**
     * Function used for searching, filtering, sorting and paginating appraisals.
     *
     * @param query The query to be used for extracting appraisals
     * @param options The option for searching, filtering, sorting and paginating
     *
     * @return Collection of appraisals
     */
    public function scopeTeacherFilterAppraisals($query, $options = [])
    {
        /** Define the default options. */
        extract(array_merge([
            'page' => 1,
            'perPage' => 12,
            'searchInput' => '',
            'teacher' => -1,
            'school' => -1,
            'status' => -1,
            'year' => -1,
            'semester' => -1,
            'sort' => 'created_at desc'
        ], $options));

        /** Apply the teacher filter */
        if ($teacher && (-1 != $teacher)) {
            $query->whereHas('teacher', function($q) use ($teacher){
                $q->where('id', '=', $teacher);
            });
        }

        /** Apply the school filter */
        if ($school && (-1 != $school)) {
            $query->whereHas('school', function($q) use ($school){
                $q->where('id', '=', $school);
            });
        }

        /** Apply the status filter */
        if ($status && (-1 != $status)) {
            $query->where('status', $status);
        }

        /** Apply the search input */
        if ($searchInput) {
            $query->where('objectives', 'like', "%${searchInput}%")
              ->orWhereHas('firstSkill', function ($query) use ($searchInput) {
                $query->where('name', 'like', "%${searchInput}%");
            })->orWhereHas('secondSkill', function ($query) use ($searchInput) {
                $query->where('name', 'like', "%${searchInput}%");
            })->orWhereHas('thirdSkill', function ($query) use ($searchInput) {
                $query->where('name', 'like', "%${searchInput}%");
            });
        }

        /** Apply the year filter */
        if ($year && (-1 != $year)) {
            $query->whereHas('semester', function ($query) use ($year) {
                $query->where('year', $year);
            });
        }

        /** Apply the semester filter */
        if ($semester && (-1 != $semester)) {
            $query->whereHas('semester', function ($query) use ($semester) {
                $query->where('semester', $semester);
            });
        }

        if ($sort) {
            $sortTypes = explode(' ', $sort);

            $query->orderBy(/*field*/$sortTypes[0], /*type*/$sortTypes[1]);
        }

        $page = ($query->paginate($perPage, $page)->lastPage() < $page) ? (1) : ($page);

        return $query->paginate($perPage, $page);
    }

    /**
     * Function used for searching, filtering, sorting and paginating appraisals.
     *
     * @param query The query to be used for extracting appraisals
     * @param options The option for searching, filtering, sorting and paginating
     *
     * @return Collection of appraisals
     */
    public function scopeSchoolFilterAppraisals($query, $options = [])
    {
        /** Define the default options. */
        extract(array_merge([
            'page' => 1,
            'perPage' => 12,
            'searchInput' => '',
            'school' => -1,
            'teacher' => -1,
            'status' => -1,
            'year' => -1,
            'semester' => -1,
            'sort' => 'created_at desc'
        ], $options));

        /** Apply the school filter */
        if ($school && (-1 != $school)) {
            $query->whereHas('school', function($q) use ($school){
                $q->where('id', '=', $school);
            });
        }

        /** Apply the teacher filter */
        if ($teacher && (-1 != $teacher)) {
            $query->whereHas('teacher', function($q) use ($teacher){
                $q->where('id', '=', $teacher);
            });
        }

        /** Apply the status filter */
        if ($status && (-1 != $status)) {
            $query->where('status', $status);
        }

        /** Apply the search input */
        if ($searchInput) {
            $query->where('objectives', 'like', "%${searchInput}%")
              ->orWhereHas('firstSkill', function ($query) use ($searchInput) {
                $query->where('name', 'like', "%${searchInput}%");
            })->orWhereHas('secondSkill', function ($query) use ($searchInput) {
                $query->where('name', 'like', "%${searchInput}%");
            })->orWhereHas('thirdSkill', function ($query) use ($searchInput) {
                $query->where('name', 'like', "%${searchInput}%");
            });
        }

        /** Apply the year filter */
        if ($year && (-1 != $year)) {
            $query->whereHas('semester', function ($query) use ($year) {
                $query->where('year', $year);
            });
        }

        /** Apply the semester filter */
        if ($semester && (-1 != $semester)) {
            $query->whereHas('semester', function ($query) use ($semester) {
                $query->where('semester', $semester);
            });
        }

        if ($sort) {
            $sortTypes = explode(' ', $sort);

            $query->orderBy(/*field*/$sortTypes[0], /*type*/$sortTypes[1]);
        }

        $page = ($query->paginate($perPage, $page)->lastPage() < $page) ? (1) : ($page);

        return $query->paginate($perPage, $page);
    }

    /***********************************************
     ***************** Static data *****************
     ***********************************************/

    /**
     * Function that returns statuses used for filtering.
     */
    public static function getFilterStatuses()
    {
        return [
            Lang::get('genuineq.tms::lang.appraisal.frontend.all_statuses') => -1,
            Lang::get('genuineq.tms::lang.appraisal.frontend.new') => 'new',
            Lang::get('genuineq.tms::lang.appraisal.frontend.objectives_set') => 'objectives-set',
            Lang::get('genuineq.tms::lang.appraisal.frontend.objectives_approved') => 'objectives-approved',
            Lang::get('genuineq.tms::lang.appraisal.frontend.skills_set') => 'skills-set',
            Lang::get('genuineq.tms::lang.appraisal.frontend.evaluation_opened') => 'evaluation-opened',
            Lang::get('genuineq.tms::lang.appraisal.frontend.closed') => 'closed',
        ];
    }

    /**
     * Function that returns years used for filtering.
     */
    public static function getFilterYears($teacherId)
    {
        /** Extract the list of contract types. */
        $years = [];
        foreach (Appraisal::where('teacher_id', $teacherId)->get() as $appraisal) {
            $years['' . $appraisal->semester->year] = '' . $appraisal->semester->year;
        }

        $years[Lang::get('genuineq.tms::lang.appraisal.frontend.all_years')] = -1;

        return array_reverse($years, true);
    }

    /**
     * Function that returns years used for filtering.
     */
    public static function getFilterSemesters()
    {
        $semesters[Lang::get('genuineq.tms::lang.appraisal.frontend.all_semesters')] = -1;
        $semesters['1'] = 1;
        $semesters['2'] = 2;

        return $semesters;
    }

    /**
     * Function that returns values used for sorting.
     */
    public static function getSortingTypes()
    {
        return [
            Lang::get('genuineq.tms::lang.appraisal.frontend.desc') => 'created_at desc',
            Lang::get('genuineq.tms::lang.appraisal.frontend.asc') => 'created_at asc',
        ];
    }

    /**
     * Function that returns schools used for filtering.
     */
    public static function getFilterSchools($teacherId)
    {
        /** Extract the list of contract types. */
        $schools = [];
        foreach (Appraisal::where('teacher_id', $teacherId)->get() as $appraisal) {
            $schools['' . $appraisal->school->name] = '' . $appraisal->school->id;
        }

        $schools[Lang::get('genuineq.tms::lang.appraisal.frontend.all_schools')] = -1;

        return array_reverse($schools, true);
    }
}
