<?php namespace Genuineq\Tms\Components;

use Log;
use Lang;
use Auth;
use Flash;
use Input;
use Request;
use Redirect;
use Validator;
use Carbon\Carbon;
use ValidationException;
use ApplicationException;
use Cms\Classes\ComponentBase;
use Genuineq\Tms\Models\School;
use Genuineq\Tms\Models\Address;
use Genuineq\Tms\Models\Inspectorate;
use Genuineq\User\Helpers\AuthRedirect;
use Genuineq\User\Models\UsersLoginLog;

/**
 * School profile component
 *
 * Allows the update of a school profile.
 */
class SchoolProfile extends ComponentBase
{
    /**
     * @var Genuineq\Tms\Models\School The school that is displayed.
     */
    public $profile;

    public function componentDetails()
    {
        return [
            'name'        => 'genuineq.tms::lang.component.school-profile.name',
            'description' => 'genuineq.tms::lang.component.school-profile.description'
        ];
    }

    public function defineProperties()
    {
        return [
            'forceSecure' => [
                'title'       => 'genuineq.tms::lang.component.school-profile.backend.force_secure',
                'description' => 'genuineq.tms::lang.component.school-profile.backend.force_secure_desc',
                'type'        => 'checkbox',
                'default'     => 0
            ],
        ];
    }

    /**
     * Executed when this component is initialized
     */
    public function prepareVars()
    {
        $this->profile = $this->page['profile'] = (Auth::check()) ? (Auth::getUser()->profile) : (null);
        $this->page['profileAddress'] = ($this->page['profile'] && $this->page['profile']->address) ? ($this->page['profile']->address->name . ', ' . $this->page['profile']->address->county) : (null);

        /* Extract all the inspectorates and create the source array. */
        foreach (Inspectorate::all() as $inspectorate) {
            $inspectorates[$inspectorate->name] = $inspectorate->id;
        }
        $this->page['inspectorates'] = json_encode($inspectorates);

        /* Extract all the addresses and create the source array. */
        foreach (Address::all() as $address) {
            $addresses[$address->name . ', ' . $address->county] = $address->id;
        }
        $this->page['addresses'] = json_encode($addresses);

        /* Construct school types*/
        $this->page['schoolTypes'] = [
            'Public' => 'public',
            'Privat' => 'private'
        ];

        /** Extract the last login date and time. */
        $this->page['lastLogin'] = Auth::getUser()->last_login;

        /** Extract the previous login. */
        $previousLogin = UsersLoginLog::where('email', Auth::getUser()->email)->where('type', 'Successful login')->where('created_at', '<', Auth::getUser()->last_login)->orderBy('created_at', 'desc')->first();

        /** Extract the number of failed logins from last successfull login. */
        if ($previousLogin) {
            $this->page['failedLogins'] = UsersLoginLog::where('email', Auth::getUser()->email)->where('type', 'Unsuccessful login')->whereBetween('created_at', [$previousLogin->created_at, Auth::getUser()->last_login])->count();
        } else {
            $this->page['failedLogins'] = 0;
        }
    }

    /**
     * Executed when this component is bound to a page or layout.
     */
    public function onRun()
    {
        /*
         * Redirect to HTTPS checker
         */
        if ($redirect = $this->redirectForceSecure()) {
            return $redirect;
        }

        /** Force authentication in case user is not authenticated. */
        if (!Auth::check()) {
            return Redirect::guest($this->pageUrl(AuthRedirect::loginRequired()));
        }

        $this->prepareVars();
    }

    /***********************************************
     **************** AJAX handlers ****************
     ***********************************************/

    /**
     * Update the school profile.
     */
    public function onSchoolProfileUpdate()
    {
        if (!Auth::check()) {
            return Redirect::guest($this->pageUrl(AuthRedirect::loginRequired()));
        }

        /** Extract the post data to validate. */
        $data = post();
        $data['slug'] = str_replace(' ', '-', strtolower($data['name']));

        /** Trim address and seniority before getting their ids. */
        $data['address_id'] = ltrim($data['address_id'], '=-@+');
        $data['inspectorate_id'] = ltrim($data['inspectorate_id'], '=-@+');

        /** Extract the inspectorate ID. */
        if ($data['inspectorate_id']) {
            $inspectorate = Inspectorate::whereName($data['inspectorate_id'])->first();
            $data['inspectorate_id'] = ($inspectorate) ? ($inspectorate->id) : (null);
        } else {
            unset($data['inspectorate_id']);
        }

        /** Extract the address ID. */
        if ($data['address_id']) {
            $fullAddress = explode(', ', $data['address_id']);
            if(!array_key_exists(1, $fullAddress)) {
                throw new ValidationException(['address_id' => Lang::get('genuineq.tms::lang.component.school-profile.validation.address_id_format')]);
            }
            $address = Address::whereName($fullAddress[0])->whereCounty($fullAddress[1])->first();
            $data['address_id'] = ($address) ? ($address->id) : (null);
        } else {
            unset($data['address_id']);
        }

        /** Extract the validation rules. */
        $rules = [
            'name' => ['nullable', 'max:50', 'regex:/^[a-zA-Z0123456789 -]*$/i'],
            'slug' => 'string|max:50|nullable',
            'phone' => ['nullable', 'max:15', 'regex:/^[0123456789 +]*$/i'],
            'principal' => ['nullable', 'max:50', 'regex:/^[a-zA-Z0123456789 -]*$/i'],
            'contact_name' => ['nullable', 'max:50', 'regex:/^[a-zA-Z0123456789 -]*$/i'],
            'contact_email' => 'string|max:50|email|nullable',
            'contact_phone' => ['nullable', 'max:15', 'regex:/^[0123456789 +]*$/i'],
            'contact_role' => 'string|max:50|nullable',
            'user_id' => 'numeric|nullable',
            'address_id' => 'numeric|nullable',
            'inspectorate_id' => 'numeric|nullable',
        ];

        /** Construct the validation error messages. */
        $messages = [
            'name.regex' => Lang::get('genuineq.tms::lang.component.school-profile.validation.name_regex'),
            'name.max' => Lang::get('genuineq.tms::lang.component.school-profile.validation.name_max'),
            'phone.regex' => Lang::get('genuineq.tms::lang.component.school-profile.validation.phone_regex'),
            'phone.max' => Lang::get('genuineq.tms::lang.component.school-profile.validation.phone_max'),
            'principal.regex' => Lang::get('genuineq.tms::lang.component.school-profile.validation.principal_regex'),
            'principal.max' => Lang::get('genuineq.tms::lang.component.school-profile.validation.principal_max'),
            'contact_name.regex' => Lang::get('genuineq.tms::lang.component.school-profile.validation.contact_name_regex'),
            'contact_name.max' => Lang::get('genuineq.tms::lang.component.school-profile.validation.contact_name_max'),
            'contact_phone.numeric' => Lang::get('genuineq.tms::lang.component.school-profile.validation.contact_phone_numeric'),
            'contact_phone.max' => Lang::get('genuineq.tms::lang.component.school-profile.validation.contact_phone_max'),
            'contact_role.string' => Lang::get('genuineq.tms::lang.component.school-profile.validation.contact_role_string'),
            'contact_role.max' => Lang::get('genuineq.tms::lang.component.school-profile.validation.contact_role_max'),
            'contact_email.string' => Lang::get('genuineq.tms::lang.component.school-profile.validation.contact_email_string'),
            'contact_email.max' => Lang::get('genuineq.tms::lang.component.school-profile.validation.contact_email_max'),
            'contact_email.email' => Lang::get('genuineq.tms::lang.component.school-profile.validation.contact_email_email'),
            'address_id.numeric' => Lang::get('genuineq.tms::lang.component.school-profile.validation.address_id_numeric'),
            'inspectorate_id.numeric' => Lang::get('genuineq.tms::lang.component.school-profile.validation.inspectorate_id_numeric'),
        ];

        /** Apply the validation rules. */
        $validation = Validator::make($data, $rules, $messages);
        if ($validation->fails()) {
            throw new ValidationException($validation);
        }

        /** Trim dangerous characters from the form data. */
        $data['name'] = ltrim($data['name'], '=-@+');
        $data['phone'] = ltrim($data['phone'], '=-@+');
        $data['slug'] = ltrim($data['slug'], '=-@+');
        $data['principal'] = ltrim($data['principal'], '=-@+');
        $data['contact_name'] = ltrim($data['contact_name'], '=-@+');
        $data['contact_email'] = ltrim($data['contact_email'], '=-@+');
        $data['contact_phone'] = ltrim($data['contact_phone'], '=-@+');
        $data['contact_role'] = ltrim($data['contact_role'], '=-@+');

        /** Extract the school profile */
        $schoolProfile = Auth::getUser()->profile;

        if ($schoolProfile) {
            $schoolProfile->fill($data);
            $schoolProfile->save();
        } else {
            throw new ApplicationException(Lang::get('genuineq.tms::lang.component.school-profile.message.profile_update_failed'));
        }

        Flash::success(Lang::get('genuineq.tms::lang.component.school-profile.message.profile_update_successful'));
    }

    /**
     * Update the school profile detailed address
     */
    public function onSchoolProfileDetailedAddreddUpdate()
    {
        if (!Auth::check()) {
            return Redirect::guest($this->pageUrl(AuthRedirect::loginRequired()));
        }

        /** Extract the post data to validate. */
        $data = post();

        /** Extract the validation rules. */
        $rules = [
            'detailed_address' => 'string|nullable',
        ];

        /** Construct the validation error messages. */
        $messages = [
            'detailed_address.string' => Lang::get('genuineq.tms::lang.component.school-profile.validation.detailed_address_string'),
        ];

        /** Apply the validation rules. */
        $validation = Validator::make($data, $rules, $messages);
        if ($validation->fails()) {
            throw new ValidationException($validation);
        }

        /** Trim dangerous characters from the form data. */
        $data['detailed_address'] = ltrim($data['detailed_address'], '=-@+');

        /** Extract the school profile */
        $schoolProfile = Auth::getUser()->profile;

        if ($schoolProfile) {
            $schoolProfile->fill($data);
            $schoolProfile->save();
        } else {
            throw new ApplicationException(Lang::get('genuineq.tms::lang.component.school-profile.message.detailed_address_update_failed'));
        }

        Flash::success(Lang::get('genuineq.tms::lang.component.school-profile.message.detailed_address_update_successful'));
    }

    /**
     * Update the school profile description
     */
    public function onSchoolProfileDescriptionUpdate()
    {
        if (!Auth::check()) {
            return Redirect::guest($this->pageUrl(AuthRedirect::loginRequired()));
        }

        /** Extract the post data to validate. */
        $data = post();

        /** Extract the validation rules. */
        $rules = [
            'description' => 'string|nullable',
        ];

        /** Construct the validation error messages. */
        $messages = [
            'description.string' => Lang::get('genuineq.tms::lang.component.school-profile.validation.description_string'),
        ];

        /** Apply the validation rules. */
        $validation = Validator::make($data, $rules, $messages);
        if ($validation->fails()) {
            throw new ValidationException($validation);
        }

        /** Sanitize description before update. */
        $data['description'] = ltrim($data['description'], '=-@+');

        /** Extract the school profile */
        $schoolProfile = Auth::getUser()->profile;

        if ($schoolProfile) {
            $schoolProfile->fill($data);
            $schoolProfile->save();
        } else {
            throw new ApplicationException(Lang::get('genuineq.tms::lang.component.school-profile.message.description_update_failed'));
        }

        Flash::success(Lang::get('genuineq.tms::lang.component.school-profile.message.description_update_successful'));
    }

    /**
     * Update the school profile description
     */
    public function onSchoolProfileDelete()
    {
        if (!Auth::check()) {
            return Redirect::guest($this->pageUrl(AuthRedirect::loginRequired()));
        }

        /** Extract the user. */
        $user = Auth::getUser();
        /** Extract the user profile. */
        $profile = $user->profile;

        /** Logout the user. */
        Auth::logout();

        /** Log the logout request. */
        UsersLoginLog::create([
            "type" => "Successful logout",
            "name" => $user->name,
            "email" => $user->email,
            "ip_address" => Request::ip(),
        ]);

        /** Anonymize the user. */
        $user->update([
            'name' => 'name_' . Carbon::now()->timestamp,
            'surname' => 'surname_' . Carbon::now()->timestamp,
            'username' => 'username_' . Carbon::now()->timestamp,
            'email' => 'email_' . Carbon::now()->timestamp . '@email.com',
            'password' => str_random(32),
            'identifier' => Carbon::now()->timestamp,
            'created_ip_address' => '0.0.0.0',
            'last_ip_address' => '0.0.0.0'
        ]);

        /** Anonimize the user profile. */
        $profile->update([
            'name' => 'name_' . carbon::now()->timestamp,
            'slug' => 'slug_' . carbon::now()->timestamp,
            'phone' => '222222222222222',
            'principal' => 'principal_' . carbon::now()->timestamp,
            'address_id' => 0,
            'detailed_address' => 'detailed_address_' . carbon::now()->timestamp,
            'description' => 'description_' . carbon::now()->timestamp,
            'contact_name' => 'contact_name_' . carbon::now()->timestamp,
            'contact_email' => 'contact_email_' . carbon::now()->timestamp . '@email.com',
            'contact_phone' => '222222222222222',
            'contact_role' => 'contact_role_' . carbon::now()->timestamp
        ]);

        Flash::success(Lang::get('genuineq.tms::lang.component.school-profile.message.delete_successful'));

        return Redirect::to($this->pageUrl('/'));
    }

    /***********************************************
     ******************* Helpers *******************
     ***********************************************/

    /**
     * Checks if the force secure property is enabled and if so
     * returns a redirect object.
     * @return mixed
     */
    protected function redirectForceSecure()
    {
        if (
            Request::secure() ||
            Request::ajax() ||
            !$this->property('forceSecure')
        ) {
            return;
        }

        return Redirect::secure(Request::path());
    }
}
