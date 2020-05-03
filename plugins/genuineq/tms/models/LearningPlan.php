<?php namespace Genuineq\Tms\Models;

use Model;

/**
 * Model
 */
class LearningPlan extends Model
{
    use \October\Rain\Database\Traits\Validation;

    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'genuineq_tms_learning_plans';

    /**
     * Courses relation
     */
    public $hasMany = [
        'courses' => 'Genuineq\Tms\Models\Course'
    ];

    /**
     * Teachers relation
     */
    public $belongsToMany = [
        'teachers' => [
            'Genuineq\Tms\Models\Teachers',
            'table' => 'genuineq_tms_teachers_learning_plans',
        ],
    ];

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
}