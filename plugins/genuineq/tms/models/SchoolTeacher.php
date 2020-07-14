<?php namespace Genuineq\Tms\Models;

use Model;

/**
 * Model
 */
class SchoolTeacher extends Model
{
    use \October\Rain\Database\Traits\Validation;

    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];

    /**
     * Address relation
     */
    public $belongsTo = [
        'contract_type' => 'Genuineq\Tms\Models\ContractType',
        'school_level' => 'Genuineq\Tms\Models\SchoolLevel',
        'grade' => 'Genuineq\Tms\Models\Grade',
        'specialization_1' => 'Genuineq\Tms\Models\Specialization',
        'specialization_2' => 'Genuineq\Tms\Models\Specialization',
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'genuineq_tms_schools_teachers';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
}
