<?php namespace Genuineq\Tms\Models;

use Model;
use Genuineq\Tms\Models\Teacher;

/**
 * Model
 */
class School extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];

    /**
     * @var array The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'slug',
        'phone',
        'email',
        'principal',
        'description',
        'contact_name',
        'contact_email',
        'contact_phone',
        'contact_role',
        'user_id',
        'address_id',
        'inspectorate_id',
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'genuineq_tms_schools';

    /**
     * Requests relation.
     */
    public $morphMany = [
        'requests' => [
            'Genuineq\Tms\Models\LearningPlansCourse',
            'name' => 'requestable']
    ];

    /**
     * Address relation
     */
    public $belongsTo = [
        'address' => 'Genuineq\Tms\Models\Address',
        'inspectorate' => 'Genuineq\Tms\Models\Inspectorate',
    ];

    /**
     * Learning plans course" relation
     */
    public $hasMany = [
        'learning_plans_course' => 'Genuineq\Tms\Models\LearningPlansCourse',
    ];

    /**
     * "User" relation
     */
    public $hasOne = [
        'user' => 'Genuineq\user\Models\User',
    ];

    /**
     * Teachers relation
     */
    public $belongsToMany = [
        'teachers' => [
            'Genuineq\Tms\Models\Teacher',
            'table' => 'genuineq_tms_schools_teachers',
            'order' => 'name',
        ],
    ];

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    /**
     * Function used for searching, filtering, sorting and paginating the school teachers.
     *
     * @param options An array of options to use.
     */
    public function filterTeachers($options = []){
        /** Add the school ID */
        $options['school'] = $this->id;

        return Teacher::schoolTeachers($options);
    }

    /**
     * Function that extracts the proposed requests for a specific learning plan.
     */
    public function getProposedLearningPlanRequests($learningPlanId){
        return $this->requests
                    ->where('learning_plan_id', $learningPlanId)
                    ->where('status', 'proposed');
    }

    /**
     * Function that extracts the accepted requests for a specific learning plan.
     */
    public function getAcceptedLearningPlanRequests($learningPlanId){
        return $this->requests
                    ->where('learning_plan_id', $learningPlanId)
                    ->where('status', 'accepted');
    }

    /**
     * Function that extracts the declined requests for a specific learning plan.
     */
    public function getDeclinedLearningPlanRequests($learningPlanId){
        return $this->requests
                    ->where('learning_plan_id', $learningPlanId)
                    ->where('status', 'declined');
    }
}
