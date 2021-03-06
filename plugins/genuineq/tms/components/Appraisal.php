<?php namespace Genuineq\Tms\Components;

use Log;
use Lang;
use Auth;
use Flash;
use Event;
use Request;
use Redirect;
use ApplicationException;
use Cms\Classes\ComponentBase;
use Genuineq\Tms\Models\Skill;
use Genuineq\Tms\Models\Teacher;
use Genuineq\Tms\Models\Appraisal as AppraisalModule;
use Genuineq\User\Helpers\AuthRedirect;

/**
 * Appraisal component
 *
 * Allows to view and update an appraisal.
 */
class Appraisal extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'genuineq.tms::lang.component.appraisal.name',
            'description' => 'genuineq.tms::lang.component.appraisal.description'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    /**
     * Executed when this component is initialized
     */
    public function prepareVars()
    {
    }

    /**
     * Executed when this component is bound to a page or layout.
     */
    public function onRun()
    {
        $this->prepareVars();
    }

    /***********************************************
     **************** AJAX handlers ****************
     ***********************************************/

    /***********************************************
     ****************** Teacher ********************
     ***********************************************/

    /**
     * Searches, filters, orders and paginates appraisals
     *  based on the post options.
     */
    public function onTeacherAppraisalSearch()
    {
        if (!Auth::check()) {
            return Redirect::guest($this->pageUrl(AuthRedirect::loginRequired()));
        }

        $options = post();
        $options['teacher'] = Auth::getUser()->profile->id;

        /* Extract the appraisals based on the received options. */
        $this->teacherExtractAppraisals($options, Auth::getUser()->profile->id);

        /** Send the "nonce" attribute for ajax loaded scripts. */
        $this->page['csp_nonce'] = post('nonce');
    }

    /**
     * Extracts all the appraisals of specified teacher.
     */
    public function onTeacherAppraisalsView()
    {
        if (!Auth::check()) {
            return Redirect::guest($this->pageUrl(AuthRedirect::loginRequired()));
        }

        /** Extracts all the appraisals of specified teacher. */
        $this->teacherExtractAppraisals(/*options*/['teacher' =>  Auth::getUser()->profile->id], Auth::getUser()->profile->id);

        /** Extracts all the appraisals statics of specified teacher. */
        $this->teacherExtractSearchStatics(Auth::getUser()->profile->id);

        /** Send the "nonce" attribute for ajax loaded scripts. */
        $this->page['csp_nonce'] = post('nonce');
    }

    /**
     * Function that extracts a specific appraisal.
     */
    public function onTeacherViewGetAppraisalDetails()
    {
        if (!Auth::check()) {
            return Redirect::guest($this->pageUrl(AuthRedirect::loginRequired()));
        }

        if (Auth::getUser()->profile->id != post('teacherId')) {
            throw new ApplicationException(Lang::get('genuineq.tms::lang.component.appraisal.message.not_allowed'));
        }

        /** Extract the requested appraisal */
        $appraisal = AppraisalModule::where('id', post('appraisalId'))->where('teacher_id', post('teacherId'))->first();

        if (!$appraisal) {
            throw new ApplicationException(Lang::get('genuineq.tms::lang.component.appraisal.message.not_exists'));
        }

        /** Extract the appraisal. */
        $this->page['appraisal'] = $appraisal;
        /** Extract the teacher. */
        $this->page['teacher'] = Teacher::find(post('teacherId'));

        /** Send the "nonce" attribute for ajax loaded scripts. */
        $this->page['csp_nonce'] = post('nonce');
    }

    /**
     * Updates the objectives in a specified appraisal.
     */
    public function onTeacherAppraisalSave()
    {
        if (!Auth::check()) {
            return Redirect::guest($this->pageUrl(AuthRedirect::loginRequired()));
        }

        if (Auth::getUser()->profile->id != post('teacherId')) {
            throw new ApplicationException(Lang::get('genuineq.tms::lang.component.appraisal.message.not_allowed'));
        }

        /** Extract the requested appraisal */
        $appraisal = AppraisalModule::where('id', post('appraisalId'))->where('teacher_id', post('teacherId'))->first();

        if (!$appraisal) {
            throw new ApplicationException(Lang::get('genuineq.tms::lang.component.appraisal.message.not_exists'));
        }

        /** Save updated objectives. */
        $appraisal->objectives = post('objectives');
        $appraisal->save();

        Flash::success(Lang::get('genuineq.tms::lang.component.appraisal.message.save_successful'));

        /** Extract the appraisal. */
        $this->page['appraisal'] = $appraisal;
        /** Extract the teacher. */
        $this->page['teacher'] = Teacher::find(post('teacherId'));

        /** Extract the received appraisal filtering options */
        $options = [
            'searchInput' => post('appraisalSearchInput'),
            'teacher' =>  Auth::getUser()->profile->id,
            'school' => post('appraisalSchools'),
            'sort' => post('appraisalSort'),
            'status' => post('appraisalStatus'),
            'year' => post('appraisalYear'),
            'semester' => post('appraisalSemester'),
            'page' => post('newPage'),
        ];

        /** Extracts all the appraisals of specified teacher. */
        $this->teacherExtractAppraisals($options, Auth::getUser()->profile->id);

        /** Send the "nonce" attribute for ajax loaded scripts. */
        $this->page['csp_nonce'] = post('nonce');
    }

    /**
     * Updates the objectives in a specified appraisal
     *  and moves it to the 'objectives-set' state.
     */
    public function onTeacherSetAppraisalObjectives()
    {
        if (!Auth::check()) {
            return Redirect::guest($this->pageUrl(AuthRedirect::loginRequired()));
        }

        if (Auth::getUser()->profile->id != post('teacherId')) {
            throw new ApplicationException(Lang::get('genuineq.tms::lang.component.appraisal.message.not_allowed'));
        }

        /** Extract the requested appraisal */
        $appraisal = AppraisalModule::where('id', post('appraisalId'))->where('teacher_id', post('teacherId'))->first();

        if (!$appraisal) {
            throw new ApplicationException(Lang::get('genuineq.tms::lang.component.appraisal.message.not_exists'));
        }

        if ('' == post('objectives')) {
            throw new ApplicationException(Lang::get('genuineq.tms::lang.component.appraisal.empty_objectives'));
        }

        /** Save updated objectives. */
        $appraisal->objectives = post('objectives');
        $appraisal->status = 'objectives-set';
        $appraisal->save();

        Flash::success(Lang::get('genuineq.tms::lang.component.appraisal.message.objectives_set_successful'));

        Event::fire(
            'genuineq.tms.teacher.appraisal.objectives.set',
            [
                /*school*/$appraisal->school,
                /*user*/Auth::getUser(),
                /*appraisal*/$appraisal,
            ]
        );

        /** Extract the received appraisal filtering options */
        $options = [
            'searchInput' => post('appraisalSearchInput'),
            'teacher' =>  Auth::getUser()->profile->id,
            'school' => post('appraisalSchools'),
            'sort' => post('appraisalSort'),
            'status' => post('appraisalStatus'),
            'year' => post('appraisalYear'),
            'semester' => post('appraisalSemester'),
            'page' => post('newPage'),
        ];

        /** Extracts all the appraisals of specified teacher. */
        $this->teacherExtractAppraisals($options, Auth::getUser()->profile->id);

        /** Send the "nonce" attribute for ajax loaded scripts. */
        $this->page['csp_nonce'] = post('nonce');
    }

    /***********************************************
     ****************** School *********************
     ***********************************************/


    /**
     * Searches, filters, orders and paginates appraisals
     *  based on the post options.
     */
    public function onSchoolAppraisalSearch()
    {
        if (!Auth::check()) {
            return Redirect::guest($this->pageUrl(AuthRedirect::loginRequired()));
        }

        $school = Auth::getUser()->profile;
        /** Extract the requested teacher */
        $teacher = $school->teachers->where('id', post('teacherId'))->first();

        if (!$teacher) {
            throw new ApplicationException(Lang::get('genuineq.tms::lang.component.appraisal.message.teacher_not_exists'));
        }

        $options = post();
        $options['teacher'] = post('teacherId');
        $options['school'] = $school->id;

        /** Extracts all the appraisals of specified teacher. */
        $this->schoolExtractAppraisals($options, post('teacherId'), $school);

        /** Send the "nonce" attribute for ajax loaded scripts. */
        $this->page['csp_nonce'] = post('nonce');
    }

    /**
     * Extracts all the appraisals of specified teacher.
     */
    public function onSchoolAppraisalEdit()
    {
        if (!Auth::check()) {
            return Redirect::guest($this->pageUrl(AuthRedirect::loginRequired()));
        }

        $school = Auth::getUser()->profile;
        /** Extract the requested teacher */
        $teacher = $school->teachers->where('id', post('teacherId'))->first();

        if (!$teacher) {
            throw new ApplicationException(Lang::get('genuineq.tms::lang.component.appraisal.message.teacher_not_exists'));
        }

        /** Extract the teacher active appraisal. */
        $this->page['appraisal'] = $school->getActiveAppraisal(post('teacherId'));

        /** Extracts all the appraisals of specified teacher. */
        $this->schoolExtractAppraisals(/*options*/['school' => $school->id, 'teacher' => post('teacherId')], post('teacherId'), $school);

        /** Extracts all the appraisals statics of specified teacher. */
        $this->schoolExtractSearchStatics(post('teacherId'));

        /** Extract all the skills and create the source array. */
        $value = 0;
        foreach (Skill::all()->pluck('name') as $skill) {
            $skills[$skill] = $value++;
        }
        $this->page['skills'] = json_encode($skills);

        /** Send the "nonce" attribute for ajax loaded scripts. */
        $this->page['csp_nonce'] = post('nonce');
    }

    /**
     * Function that extracts a specific appraisal.
     */
    public function onSchoolViewGetAppraisalDetails()
    {
        if (!Auth::check()) {
            return Redirect::guest($this->pageUrl(AuthRedirect::loginRequired()));
        }

        /** Extract the requested teacher */
        $teacher = Auth::getUser()->profile->teachers->where('id', post('teacherId'))->first();

        if (!$teacher) {
            throw new ApplicationException(Lang::get('genuineq.tms::lang.component.appraisal.message.teacher_not_exists'));
        }

        /** Extract the requested appraisal */
        $appraisal =  Auth::getUser()->profile->appraisals->where('id', post('appraisalId'))->where('teacher_id', post('teacherId'))->first();

        if (!$appraisal) {
            throw new ApplicationException(Lang::get('genuineq.tms::lang.component.appraisal.message.not_exists'));
        }

        /** Extract the appraisal. */
        $this->page['appraisal'] = $appraisal;
        /** Extract the teacher. */
        $this->page['teacher'] = Teacher::find(post('teacherId'));

        /** Extract all the skills and create the source array. */
        $value = 0;
        foreach (Skill::all()->pluck('name') as $skill) {
            $skills[$skill] = $value++;
        }
        $this->page['skills'] = json_encode($skills);

        /** Send the "nonce" attribute for ajax loaded scripts. */
        $this->page['csp_nonce'] = post('nonce');
    }

    /**
     * Updates the specified appraisal.
     */
    public function onSchoolAppraisalSave()
    {
        if (!Auth::check()) {
            return Redirect::guest($this->pageUrl(AuthRedirect::loginRequired()));
        }

        $school = Auth::getUser()->profile;
        /** Extract the requested teacher */
        $teacher = $school->teachers->where('id', post('teacherId'))->first();

        if (!$teacher) {
            throw new ApplicationException(Lang::get('genuineq.tms::lang.component.appraisal.message.teacher_not_exists'));
        }

        /** Extract the requested appraisal */
        $appraisal =  $school->appraisals->where('id', post('appraisalId'))->where('teacher_id', post('teacherId'))->first();

        if (!$appraisal) {
            throw new ApplicationException(Lang::get('genuineq.tms::lang.component.appraisal.message.not_exists'));
        }

        /** Save the objectives, notes, skills and grades. */
        switch ($appraisal->status) {
            case 'objectives-set':
                $appraisal->objectives = post('objectives');
                $appraisal->notes_objectives_set = post('notes');
                break;

            case 'objectives-approved':
                if (100 !== (post('first_skill_percentage') + post('second_skill_percentage') + post('third_skill_percentage'))) {
                    throw new ApplicationException(Lang::get('genuineq.tms::lang.component.appraisal.message.wrong_percentage'));
                }

                $appraisal->objectives = post('objectives');
                $appraisal->notes_objectives_approved = post('notes');

                $appraisal->skill_1_id = Skill::whereName(post('first_skill'))->first()->id;
                $appraisal->percentage_1 = post('first_skill_percentage');
                $appraisal->evaluation_type_1 = post('first_skill_evaluation_type');
                $appraisal->skill_2_id = Skill::whereName(post('second_skill'))->first()->id;
                $appraisal->percentage_2 = post('second_skill_percentage');
                $appraisal->evaluation_type_2 = post('second_skill_evaluation_type');
                $appraisal->skill_3_id = Skill::whereName(post('third_skill'))->first()->id;
                $appraisal->percentage_3 = post('third_skill_percentage');
                $appraisal->evaluation_type_3 = post('third_skill_evaluation_type');
                break;

            case 'skills-set':
                $appraisal->notes_skills_set = post('notes');
                break;

            case 'evaluation-opened':
                if (
                    (1 > post('first_skill_grade')) || (1 > post('second_skill_grade')) || (1 > post('third_skill_grade')) ||
                    (('grade' == post('first_skill_evaluation_type')) && (10 < post('first_skill_grade'))) ||
                    (('grade' == post('second_skill_evaluation_type')) && (10 < post('second_skill_grade'))) ||
                    (('grade' == post('third_skill_evaluation_type')) && (10 < post('third_skill_grade'))) ||
                    (('percentage' == post('first_skill_evaluation_type')) && (100 < post('first_skill_grade'))) ||
                    (('percentage' == post('second_skill_evaluation_type')) && (100 < post('second_skill_grade'))) ||
                    (('percentage' == post('third_skill_evaluation_type')) && (100 < post('third_skill_grade')))
                   ) {
                    throw new ApplicationException(Lang::get('genuineq.tms::lang.component.appraisal.message.invalid_grade'));
                }

                $appraisal->grade_1 = post('first_skill_grade');
                $appraisal->grade_2 = post('second_skill_grade');
                $appraisal->grade_3 = post('third_skill_grade');

                $appraisal->notes_evaluation_opened = post('notes');
                break;

            case 'closed':
                $val = Lang::get('genuineq.tms::lang.appraisal.frontend.closed');
                break;
        }
        $appraisal->save();

        Flash::success(Lang::get('genuineq.tms::lang.component.appraisal.message.save_successful'));

        /** Extract the appraisal. */
        $this->page['appraisal'] = $appraisal;
        /** Extract the teacher. */
        $this->page['teacher'] = Teacher::find(post('teacherId'));

        /** Extract the received appraisal filtering options */
        $options = [
            'searchInput' => post('appraisalSearchInput'),
            'sort' => post('appraisalSort'),
            'status' => post('appraisalStatus'),
            'year' => post('appraisalYear'),
            'semester' => post('appraisalSemester'),
            'page' => post('newPage'),
            'school' => $school->id,
            'teacher' => post('teacherId'),
        ];
        /** Extracts all the appraisals of specified teacher. */
        $this->schoolExtractAppraisals($options, post('teacherId'));

        /** Extract all the skills and create the source array. */
        $value = 0;
        foreach (Skill::all()->pluck('name') as $skill) {
            $skills[$skill] = $value++;
        }
        $this->page['skills'] = json_encode($skills);

        /** Send the "nonce" attribute for ajax loaded scripts. */
        $this->page['csp_nonce'] = post('nonce');
    }

    /**
     * Approves the objectives in a specified appraisal.
     */
    public function onSchoolApproveAppraisalObjectives()
    {
        if (!Auth::check()) {
            return Redirect::guest($this->pageUrl(AuthRedirect::loginRequired()));
        }

        $school = Auth::getUser()->profile;
        /** Extract the requested teacher */
        $teacher = $school->teachers->where('id', post('teacherId'))->first();

        if (!$teacher) {
            throw new ApplicationException(Lang::get('genuineq.tms::lang.component.appraisal.message.teacher_not_exists'));
        }

        /** Extract the requested appraisal */
        $appraisal =  $school->appraisals->where('id', post('appraisalId'))->where('teacher_id', post('teacherId'))->first();

        if (!$appraisal) {
            throw new ApplicationException(Lang::get('genuineq.tms::lang.component.appraisal.message.not_exists'));
        }

        /** Save the notes. */
        $appraisal->objectives = post('objectives');
        $appraisal->notes_objectives_set = post('notes');
        $appraisal->status = 'objectives-approved';
        $appraisal->save();

        Flash::success(Lang::get('genuineq.tms::lang.component.appraisal.message.objectives_approved_successful'));

        Event::fire(
            'genuineq.tms.school.appraisal.objectives.approve',
            [
                /*teacher*/Teacher::find(post('teacherId')),
                /*user*/Auth::getUser(),
                /*appraisal*/$appraisal,
            ]
        );

        /** Extract the appraisal. */
        $this->page['appraisal'] = $appraisal;
        /** Extract the teacher. */
        $this->page['teacher'] = Teacher::find(post('teacherId'));

        /** Extract the received appraisal filtering options */
        $options = [
            'searchInput' => post('appraisalSearchInput'),
            'sort' => post('appraisalSort'),
            'status' => post('appraisalStatus'),
            'year' => post('appraisalYear'),
            'semester' => post('appraisalSemester'),
            'page' => post('newPage'),
            'school' => $school->id,
            'teacher' => post('teacherId'),
        ];
        /** Extracts all the appraisals of specified teacher. */
        $this->schoolExtractAppraisals($options, post('teacherId'));

        /** Extract all the skills and create the source array. */
        $value = 0;
        foreach (Skill::all()->pluck('name') as $skill) {
            $skills[$skill] = $value++;
        }
        $this->page['skills'] = json_encode($skills);

        /** Send the "nonce" attribute for ajax loaded scripts. */
        $this->page['csp_nonce'] = post('nonce');
    }

    /**
     * Sets the skills in a specified appraisal.
     */
    public function onSchoolSetAppraisalSkills()
    {
        if (!Auth::check()) {
            return Redirect::guest($this->pageUrl(AuthRedirect::loginRequired()));
        }

        $school = Auth::getUser()->profile;
        /** Extract the requested teacher */
        $teacher = $school->teachers->where('id', post('teacherId'))->first();

        if (!$teacher) {
            throw new ApplicationException(Lang::get('genuineq.tms::lang.component.appraisal.message.teacher_not_exists'));
        }

        /** Extract the requested appraisal */
        $appraisal =  $school->appraisals->where('id', post('appraisalId'))->where('teacher_id', post('teacherId'))->first();

        if (!$appraisal) {
            throw new ApplicationException(Lang::get('genuineq.tms::lang.component.appraisal.message.not_exists'));
        }

        if (100 !== (post('first_skill_percentage') + post('second_skill_percentage') + post('third_skill_percentage'))) {
            throw new ApplicationException(Lang::get('genuineq.tms::lang.component.appraisal.message.wrong_percentage'));
        }

        /** Save updated skills and notes. */
        $appraisal->notes_objectives_approved = post('notes');
        $appraisal->skill_1_id = Skill::whereName(post('first_skill'))->first()->id;
        $appraisal->percentage_1 = post('first_skill_percentage');
        $appraisal->skill_2_id = Skill::whereName(post('second_skill'))->first()->id;
        $appraisal->percentage_2 = post('second_skill_percentage');
        $appraisal->skill_3_id = Skill::whereName(post('third_skill'))->first()->id;
        $appraisal->percentage_3 = post('third_skill_percentage');
        $appraisal->status = 'skills-set';
        $appraisal->save();

        Flash::success(Lang::get('genuineq.tms::lang.component.appraisal.message.skills_set_successful'));

        Event::fire(
            'genuineq.tms.school.appraisal.skills.set',
            [
                /*teacher*/Teacher::find(post('teacherId')),
                /*user*/Auth::getUser(),
                /*appraisal*/$appraisal,
            ]
        );

        /** Extract the appraisal. */
        $this->page['appraisal'] = $appraisal;
        /** Extract the teacher. */
        $this->page['teacher'] = Teacher::find(post('teacherId'));

        /** Extract the received appraisal filtering options */
        $options = [
            'searchInput' => post('appraisalSearchInput'),
            'sort' => post('appraisalSort'),
            'status' => post('appraisalStatus'),
            'year' => post('appraisalYear'),
            'semester' => post('appraisalSemester'),
            'page' => post('newPage'),
            'school' => $school->id,
            'teacher' => post('teacherId'),
        ];
        /** Extracts all the appraisals of specified teacher. */
        $this->schoolExtractAppraisals($options, post('teacherId'));

        /** Send the "nonce" attribute for ajax loaded scripts. */
        $this->page['csp_nonce'] = post('nonce');
    }

    /**
     * Closes a specified appraisal.
     */
    public function onSchoolAppraisalClose()
    {
        if (!Auth::check()) {
            return Redirect::guest($this->pageUrl(AuthRedirect::loginRequired()));
        }

        $school = Auth::getUser()->profile;
        /** Extract the requested teacher */
        $teacher = $school->teachers->where('id', post('teacherId'))->first();

        if (!$teacher) {
            throw new ApplicationException(Lang::get('genuineq.tms::lang.component.appraisal.message.teacher_not_exists'));
        }

        /** Extract the requested appraisal */
        $appraisal =  $school->appraisals->where('id', post('appraisalId'))->where('teacher_id', post('teacherId'))->first();

        if (!$appraisal) {
            throw new ApplicationException(Lang::get('genuineq.tms::lang.component.appraisal.message.not_exists'));
        }

        if (
            (1 > post('first_skill_grade')) || (1 > post('second_skill_grade')) || (1 > post('third_skill_grade')) ||
            (('grade' == post('first_skill_evaluation_type')) && (10 < post('first_skill_grade'))) ||
            (('grade' == post('second_skill_evaluation_type')) && (10 < post('second_skill_grade'))) ||
            (('grade' == post('third_skill_evaluation_type')) && (10 < post('third_skill_grade'))) ||
            (('percentage' == post('first_skill_evaluation_type')) && (100 < post('first_skill_grade'))) ||
            (('percentage' == post('second_skill_evaluation_type')) && (100 < post('second_skill_grade'))) ||
            (('percentage' == post('third_skill_evaluation_type')) && (100 < post('third_skill_grade')))
           ) {
            throw new ApplicationException(Lang::get('genuineq.tms::lang.component.appraisal.message.invalid_grade'));
        }

        /** Save updated skills and notes. */
        $appraisal->notes_evaluation_opened = post('notes');
        $appraisal->grade_1 = post('first_skill_grade');
        $appraisal->grade_2 = post('second_skill_grade');
        $appraisal->grade_3 = post('third_skill_grade');
        $appraisal->status = 'closed';
        $appraisal->save();

        Flash::success(Lang::get('genuineq.tms::lang.component.appraisal.message.close_successful'));

        Event::fire(
            'genuineq.tms.school.appraisal.evaluation.closed',
            [
                /*teacher*/Teacher::find(post('teacherId')),
                /*user*/Auth::getUser(),
                /*appraisal*/$appraisal,
            ]
        );

        /** Extract the appraisal. */
        $this->page['appraisal'] = $appraisal;
        /** Extract the teacher. */
        $this->page['teacher'] = Teacher::find(post('teacherId'));

        /** Extract the received appraisal filtering options */
        $options = [
            'searchInput' => post('appraisalSearchInput'),
            'sort' => post('appraisalSort'),
            'status' => post('appraisalStatus'),
            'year' => post('appraisalYear'),
            'semester' => post('appraisalSemester'),
            'page' => post('newPage'),
            'school' => $school->id,
            'teacher' => post('teacherId'),
        ];
        /** Extracts all the appraisals of specified teacher. */
        $this->schoolExtractAppraisals($options, post('teacherId'), $school);

        /** Send the "nonce" attribute for ajax loaded scripts. */
        $this->page['csp_nonce'] = post('nonce');
    }

    /***********************************************
     ******************* Helpers *******************
     ***********************************************/

    /**
     * Extract the requested appraisals.
     */
    protected function teacherExtractAppraisals($options, $teacherId)
    {
        /** Extract the teacher. */
        $this->page['teacher'] = Teacher::find($teacherId);
        /** Extract all appraisals for filtering. */
        $this->page['appraisals'] = AppraisalModule::teacherFilterAppraisals($options);
        /** Extract the number of pages. */
        $this->page['appraisalsPages'] = $this->page['appraisals']->lastPage();
        /** Extract the current page. */
        $this->page['appraisalsPage'] = $this->page['appraisals']->currentPage();
    }

    /**
     * Extract the requested teacher statics.
     */
    protected function teacherExtractSearchStatics($teacherId)
    {
        /** Extract all statuses for filtering. */
        $this->page['appraisalStatuses'] = AppraisalModule::getFilterStatuses();
        /** Extract all years for filtering. */
        $this->page['appraisalYears'] = AppraisalModule::getFilterYears($teacherId);
        /** Extract all semesters for filtering. */
        $this->page['appraisalSemesters'] = AppraisalModule::getFilterSemesters();
        /** Extract all sort types for filtering. */
        $this->page['appraisalSortTypes'] = AppraisalModule::getSortingTypes();
        /** Extract schools for filtering. */
        $this->page['appraisalSchools'] = AppraisalModule::getFilterSchools($teacherId);
    }

    /**
     * Extract the requested appraisals.
     */
    protected function schoolExtractAppraisals($options, $teacherId)
    {
        /** Extract the teacher. */
        $this->page['teacher'] = Teacher::find($teacherId);
        /** Extract all appraisals for filtering. */
        $this->page['appraisals'] = AppraisalModule::schoolFilterAppraisals($options);
        /** Extract the number of pages. */
        $this->page['appraisalsPages'] = $this->page['appraisals']->lastPage();
        /** Extract the current page. */
        $this->page['appraisalsPage'] = $this->page['appraisals']->currentPage();
    }

    /**
     * Extract the requested school statics.
     */
    protected function schoolExtractSearchStatics($teacherId)
    {
        /** Extract all statuses for filtering. */
        $this->page['appraisalStatuses'] = AppraisalModule::getFilterStatuses();
        /** Extract all years for filtering. */
        $this->page['appraisalYears'] = AppraisalModule::getFilterYears($teacherId);
        /** Extract all semesters for filtering. */
        $this->page['appraisalSemesters'] = AppraisalModule::getFilterSemesters();
        /** Extract all sort types for filtering. */
        $this->page['appraisalSortTypes'] = AppraisalModule::getSortingTypes();
    }
}
