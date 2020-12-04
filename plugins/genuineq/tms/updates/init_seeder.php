<?php namespace Genuineq\Tms\Updates;

use Db;
use October\Rain\Database\Updates\Migration;

class InitSeeder extends Migration
{
    /**
     * Populates system tables and dependency plugins tables.
     */
    public function up()
    {
        /** Populate system_settings table. */
        Db::table('system_settings')->truncate();
        Db::table('system_settings')->insert(['item' => 'backend_brand_settings',           'value' => '{"app_name":"Scoala Profesorilor","app_tagline":"Scoala Profesorilor","primary_color":"#9a4877","secondary_color":"#4c3949","accent_color":"#f1f1f1","menu_mode":"inline","custom_css":""}']);
        Db::table('system_settings')->insert(['item' => 'rainlab_builder_settings',         'value' => '{"author_name":"genuineq","author_namespace":"Genuineq"}']);
        Db::table('system_settings')->insert(['item' => 'user_settings',                    'value' => '{"require_activation":"0","activate_mode":"user","use_throttle":"1","block_persistence":"0","allow_registration":"1","login_attribute":"email","remember_login":"never","min_password_length":8,"use_register_throttle":"1"}']);
        Db::table('system_settings')->insert(['item' => 'ginopane_awesomesociallinks',      'value' => '{"links":[{"icon":"fab fa-facebook-f","name":"facebook","link":"https:\/\/www.facebook.com\/%C8%98coala-Profesorilor-100101075067282\/"},{"icon":"fab fa-linkedin-in","name":"linkedin","link":"https:\/\/www.linkedin.com\/company\/%C8%99coala-profesorilor\/"},{"icon":"fab fa-instagram","name":"instagram","link":"https:\/\/www.instagram.com\/scoala_profesorilor\/"}]}']);
        Db::table('system_settings')->insert(['item' => 'system_log_settings',              'value' => '{"log_events":"1","log_requests":"1","log_theme":"1"}']);
        Db::table('system_settings')->insert(['item' => 'system_mail_brand_settings',       'value' => '{"body_bg":"#9a4877","content_bg":"#f1f1f1","content_inner_bg":"#ffffff","button_text_color":"#fff","button_primary_bg":"#9a4877","button_positive_bg":"#9a4877","button_negative_bg":"#4c3949","header_color":"#ffffff","heading_color":"#2f3133","text_color":"#000000","link_color":"#9a4877","footer_color":"#ffffff","body_border_color":"#edeff2","subcopy_border_color":"#edeff2","table_border_color":"#edeff2","panel_bg":"#edeff2","promotion_bg":"#fff","promotion_border_color":"#9ba2ab"}']);

        /** Populate system_mail_templates table. */
        Db::table('system_mail_templates')->truncate();
        Db::table('system_mail_templates')->insert(['code' => 'genuineq.user::mail.activate',                 'subject' => NULL, 'description' => 'Activate a new user',                'content_html' => NULL, 'content_text' => NULL, 'layout_id' => 1, 'is_custom' => 0]);
        Db::table('system_mail_templates')->insert(['code' => 'genuineq.user::mail.welcome',                  'subject' => NULL, 'description' => 'User confirmed their account',       'content_html' => NULL, 'content_text' => NULL, 'layout_id' => 1, 'is_custom' => 0]);
        Db::table('system_mail_templates')->insert(['code' => 'genuineq.user::mail.restore',                  'subject' => NULL, 'description' => 'User requests a password reset',     'content_html' => NULL, 'content_text' => NULL, 'layout_id' => 1, 'is_custom' => 0]);
        Db::table('system_mail_templates')->insert(['code' => 'genuineq.user::mail.new_user',                 'subject' => NULL, 'description' => 'Notify admins of a new sign up',     'content_html' => NULL, 'content_text' => NULL, 'layout_id' => 2, 'is_custom' => 0]);
        Db::table('system_mail_templates')->insert(['code' => 'genuineq.user::mail.reactivate',               'subject' => NULL, 'description' => 'User has reactivated their account', 'content_html' => NULL, 'content_text' => NULL, 'layout_id' => 1, 'is_custom' => 0]);
        Db::table('system_mail_templates')->insert(['code' => 'genuineq.user::mail.invite',                   'subject' => NULL, 'description' => 'Invite a new user to the website',   'content_html' => NULL, 'content_text' => NULL, 'layout_id' => 1, 'is_custom' => 0]);
        Db::table('system_mail_templates')->insert(['code' => 'backend::mail.invite',                         'subject' => NULL, 'description' => 'Invite new admin to the site',       'content_html' => NULL, 'content_text' => NULL, 'layout_id' => 2, 'is_custom' => 0]);
        Db::table('system_mail_templates')->insert(['code' => 'backend::mail.restore',                        'subject' => NULL, 'description' => 'Reset an admin password',            'content_html' => NULL, 'content_text' => NULL, 'layout_id' => 2, 'is_custom' => 0]);
        Db::table('system_mail_templates')->insert(['code' => 'genuineq.tms::mail.teacher-course-request',    'subject' => NULL, 'description' => 'Noua cerere de curs',                'content_html' => NULL, 'content_text' => NULL, 'layout_id' => 1, 'is_custom' => 0]);
        Db::table('system_mail_templates')->insert(['code' => 'genuineq.tms::mail.teacher-course-approve',    'subject' => NULL, 'description' => 'Noua cerere de curs',                'content_html' => NULL, 'content_text' => NULL, 'layout_id' => 1, 'is_custom' => 0]);
        Db::table('system_mail_templates')->insert(['code' => 'genuineq.tms::mail.teacher-course-reject',     'subject' => NULL, 'description' => 'Noua cerere de curs',                'content_html' => NULL, 'content_text' => NULL, 'layout_id' => 1, 'is_custom' => 0]);
        Db::table('system_mail_templates')->insert(['code' => 'genuineq.tms::mail.school-course-request',     'subject' => NULL, 'description' => 'Noua propunere de curs',             'content_html' => NULL, 'content_text' => NULL, 'layout_id' => 1, 'is_custom' => 0]);
        Db::table('system_mail_templates')->insert(['code' => 'genuineq.tms::mail.school-course-approve',     'subject' => NULL, 'description' => 'Cerere de curs aprobata',            'content_html' => NULL, 'content_text' => NULL, 'layout_id' => 1, 'is_custom' => 0]);
        Db::table('system_mail_templates')->insert(['code' => 'genuineq.tms::mail.school-course-reject',      'subject' => NULL, 'description' => 'Cerere de curs respinsa',            'content_html' => NULL, 'content_text' => NULL, 'layout_id' => 1, 'is_custom' => 0]);
        Db::table('system_mail_templates')->insert(['code' => 'genuineq.tms::mail.teacher-objectives-set',    'subject' => NULL, 'description' => 'Obiective setate',                   'content_html' => NULL, 'content_text' => NULL, 'layout_id' => 1, 'is_custom' => 0]);
        Db::table('system_mail_templates')->insert(['code' => 'genuineq.tms::mail.school-objectives-approve', 'subject' => NULL, 'description' => 'Obiective aprobate',                 'content_html' => NULL, 'content_text' => NULL, 'layout_id' => 1, 'is_custom' => 0]);
        Db::table('system_mail_templates')->insert(['code' => 'genuineq.tms::mail.school-skills-set',         'subject' => NULL, 'description' => 'Skill-uri setate',                   'content_html' => NULL, 'content_text' => NULL, 'layout_id' => 1, 'is_custom' => 0]);
        Db::table('system_mail_templates')->insert(['code' => 'genuineq.tms::mail.school-evaluation-close',   'subject' => NULL, 'description' => 'Evaluare finalizata',                'content_html' => NULL, 'content_text' => NULL, 'layout_id' => 1, 'is_custom' => 0]);

        /** Populate system_mail_partials table. */
        Db::table('system_mail_partials')->truncate();
        Db::table('system_mail_partials')->insert([
            'name' => 'Header',
            'code' => 'header',
            'content_html' => '<tr>\n    <td class="header">\n        {% if url %}\n            <a href="{{ url }}">\n                {{ body }}\n            </a>\n        {% else %}\n            <span>\n                {{ body }}\n            </span>\n        {% endif %}\n    </td>\n</tr>',
            'content_text' => '*** {{ body|trim }} <{{ url }}>',
            'is_custom' => 0
        ]);
        Db::table('system_mail_partials')->insert([
            'name' => 'Footer',
            'code' => 'footer',
            'content_html' => '<tr>\n    <td>\n        <table class="footer" align="center" width="570" cellpadding="0" cellspacing="0">\n            <tr>\n                <td class="content-cell" align="center">\n                    {{ body|md_safe }}\n                </td>\n            </tr>\n        </table>\n    </td>\n</tr>',
            'content_text' => '-------------------\n{{ body|trim }}',
            'is_custom' => 0
        ]);
        Db::table('system_mail_partials')->insert([
            'name' => 'Button',
            'code' => 'button',
            'content_html' => '<table class="action" align="center" width="100%" cellpadding="0" cellspacing="0">\n    <tr>\n        <td align="center">\n            <table width="100%" border="0" cellpadding="0" cellspacing="0">\n                <tr>\n                    <td align="center">\n                        <table border="0" cellpadding="0" cellspacing="0">\n                            <tr>\n                                <td>\n                                    <a href="{{ url }}" class="button button-{{ type ?: \'primary\' }}" target="_blank">\n                                        {{ body }}\n                                    </a>\n                                </td>\n                            </tr>\n                        </table>\n                    </td>\n                </tr>\n            </table>\n        </td>\n    </tr>\n</table>',
            'content_text' => '{{ body|trim }} <{{ url }}>',
            'is_custom' => 0
        ]);
        Db::table('system_mail_partials')->insert([
            'name' => 'Panel',
            'code' => 'panel',
            'content_html' => '<table class="panel break-all" width="100%" cellpadding="0" cellspacing="0">\n    <tr>\n        <td class="panel-content">\n            <table width="100%" cellpadding="0" cellspacing="0">\n                <tr>\n                    <td class="panel-item">\n                        {{ body|md_safe }}\n                    </td>\n                </tr>\n            </table>\n        </td>\n    </tr>\n</table>',
            'content_text' => '{{ body|trim }}',
            'is_custom' => 0
        ]);
        Db::table('system_mail_partials')->insert([
            'name' => 'Table',
            'code' => 'table',
            'content_html' => '<div class="table">\n    {{ body|md_safe }}\n</div>',
            'content_text' => '{{ body|trim }}',
            'is_custom' => 0
        ]);
        Db::table('system_mail_partials')->insert([
            'name' => 'Subcopy',
            'code' => 'subcopy',
            'content_html' => '<table class="subcopy" width="100%" cellpadding="0" cellspacing="0">\n    <tr>\n        <td>\n            {{ body|md_safe }}\n        </td>\n    </tr>\n</table>',
            'content_text' => '-----\n{{ body|trim }}',
            'is_custom' => 0
        ]);
        Db::table('system_mail_partials')->insert([
            'name' => 'Promotion',
            'code' => 'promotion',
            'content_html' => '<table class="promotion break-all" align="center" width="100%" cellpadding="0" cellspacing="0">\n    <tr>\n        <td align="center">\n            {{ body|md_safe }}\n        </td>\n    </tr>\n</table>',
            'content_text' => '{{ body|trim }}',
            'is_custom' => 0
        ]);
        Db::table('system_mail_partials')->insert([
            'name' => 'Buttons',
            'code' => 'buttons',
            'content_html' => '<table class="action" align="center" width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <td align="center">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td align="center">
                                <table border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td>
                                            <a href="{{ url_reject }}" class="button button-negative" target="_blank">
                                            Respinge
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td align="center">
                                <table border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td>
                                            <a href="{{ url_accept }}" class="button button-positive" target="_blank">
                                            Accepta
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>',
            'content_text' => '',
            'is_custom' => 1
        ]);

        /** Populate rainlab_notify_notification_rules table. */
        Db::table('rainlab_notify_notification_rules')->truncate();
        Db::table('rainlab_notify_notification_rules')->insert(['id' => 1,  'name' => 'A teacher requested a course to a school => Notify school via email that a teacher requested a course',                     'code' => "", 'class_name' => 'Genuineq\Tms\NotifyRules\TeacherCourseRequestEvent',    'description' => 'A teacher requested a course to a school => Notify school via email that a teacher requested a course',                     'config_data' => null, 'condition_data' => null, 'is_enabled' => 1, 'is_custom' => 1]);
        Db::table('rainlab_notify_notification_rules')->insert(['id' => 2,  'name' => 'A teacher requested a course to a school => Notify school via database that a teacher requested a course',                  'code' => "", 'class_name' => 'Genuineq\Tms\NotifyRules\TeacherCourseRequestEvent',    'description' => 'A teacher requested a course to a school => Notify school via database that a teacher requested a course',                  'config_data' => null, 'condition_data' => null, 'is_enabled' => 1, 'is_custom' => 1]);
        Db::table('rainlab_notify_notification_rules')->insert(['id' => 3,  'name' => 'A teacher approved a course proposed by a school => Notify school via email that a teacher accepted a course proposal',     'code' => "", 'class_name' => 'Genuineq\Tms\NotifyRules\TeacherCourseApproveEvent',    'description' => 'A teacher approved a course proposed by a school => Notify school via email that a teacher accepted a course proposal',     'config_data' => null, 'condition_data' => null, 'is_enabled' => 1, 'is_custom' => 1]);
        Db::table('rainlab_notify_notification_rules')->insert(['id' => 4,  'name' => 'A teacher approved a course proposed by a school => Notify school via database that a teacher accepted a course proposal',  'code' => "", 'class_name' => 'Genuineq\Tms\NotifyRules\TeacherCourseApproveEvent',    'description' => 'A teacher approved a course proposed by a school => Notify school via database that a teacher accepted a course proposal',  'config_data' => null, 'condition_data' => null, 'is_enabled' => 1, 'is_custom' => 1]);
        Db::table('rainlab_notify_notification_rules')->insert(['id' => 5,  'name' => 'A teacher rejected a course proposed by a school => Notify school via email that a teacher rejected a course proposal',     'code' => "", 'class_name' => 'Genuineq\Tms\NotifyRules\TeacherCourseRejectEvent',     'description' => 'A teacher rejected a course proposed by a school => Notify school via email that a teacher rejected a course proposal',     'config_data' => null, 'condition_data' => null, 'is_enabled' => 1, 'is_custom' => 1]);
        Db::table('rainlab_notify_notification_rules')->insert(['id' => 6,  'name' => 'A teacher rejected a course proposed by a school => Notify school via database that a teacher rejected a course proposal',  'code' => "", 'class_name' => 'Genuineq\Tms\NotifyRules\TeacherCourseRejectEvent',     'description' => 'A teacher rejected a course proposed by a school => Notify school via database that a teacher rejected a course proposal',  'config_data' => null, 'condition_data' => null, 'is_enabled' => 1, 'is_custom' => 1]);
        Db::table('rainlab_notify_notification_rules')->insert(['id' => 7,  'name' => 'A teacher finished setting the objectives => Notify school via email that a teacher added the appraisal objectives',        'code' => "", 'class_name' => 'Genuineq\Tms\NotifyRules\TeacherObjectivesSetEvent',    'description' => 'A teacher finished setting the objectives => Notify school via email that a teacher added the appraisal objectives',        'config_data' => null, 'condition_data' => null, 'is_enabled' => 1, 'is_custom' => 1]);
        Db::table('rainlab_notify_notification_rules')->insert(['id' => 8,  'name' => 'A teacher finished setting the objectives => Notify school via database that a teacher added the appraisal objectives',     'code' => "", 'class_name' => 'Genuineq\Tms\NotifyRules\TeacherObjectivesSetEvent',    'description' => 'A teacher finished setting the objectives => Notify school via database that a teacher added the appraisal objectives',     'config_data' => null, 'condition_data' => null, 'is_enabled' => 1, 'is_custom' => 1]);
        Db::table('rainlab_notify_notification_rules')->insert(['id' => 9,  'name' => 'A school proposed a course to a teacher => Notify teacher via email that a school requested a course',                      'code' => "", 'class_name' => 'Genuineq\Tms\NotifyRules\SchoolCourseRequestEvent',     'description' => 'A school proposed a course to a teacher => Notify teacher via email that a school requested a course',                      'config_data' => null, 'condition_data' => null, 'is_enabled' => 1, 'is_custom' => 1]);
        Db::table('rainlab_notify_notification_rules')->insert(['id' => 10, 'name' => 'A school proposed a course to a teacher => Notify teacher via database that a school requested a course',                   'code' => "", 'class_name' => 'Genuineq\Tms\NotifyRules\SchoolCourseRequestEvent',     'description' => 'A school proposed a course to a teacher => Notify teacher via database that a school requested a course',                   'config_data' => null, 'condition_data' => null, 'is_enabled' => 1, 'is_custom' => 1]);
        Db::table('rainlab_notify_notification_rules')->insert(['id' => 11, 'name' => 'A school approved a course requested by a teacher => Notify teacher via email that a school accepted a course proposal',    'code' => "", 'class_name' => 'Genuineq\Tms\NotifyRules\SchoolCourseApproveEvent',     'description' => 'A school approved a course requested by a teacher => Notify teacher via email that a school accepted a course proposal',    'config_data' => null, 'condition_data' => null, 'is_enabled' => 1, 'is_custom' => 1]);
        Db::table('rainlab_notify_notification_rules')->insert(['id' => 12, 'name' => 'A school approved a course requested by a teacher => Notify teacher via database that a school accepted a course proposal', 'code' => "", 'class_name' => 'Genuineq\Tms\NotifyRules\SchoolCourseApproveEvent',     'description' => 'A school approved a course requested by a teacher => Notify teacher via database that a school accepted a course proposal', 'config_data' => null, 'condition_data' => null, 'is_enabled' => 1, 'is_custom' => 1]);
        Db::table('rainlab_notify_notification_rules')->insert(['id' => 13, 'name' => 'A school rejected a course requested by a teacher => Notify teacher via email that a school rejected a course proposal',    'code' => "", 'class_name' => 'Genuineq\Tms\NotifyRules\SchoolCourseRejectEvent',      'description' => 'A school rejected a course requested by a teacher => Notify teacher via email that a school rejected a course proposal',    'config_data' => null, 'condition_data' => null, 'is_enabled' => 1, 'is_custom' => 1]);
        Db::table('rainlab_notify_notification_rules')->insert(['id' => 14, 'name' => 'A school rejected a course requested by a teacher => Notify teacher via database that a school rejected a course proposal', 'code' => "", 'class_name' => 'Genuineq\Tms\NotifyRules\SchoolCourseRejectEvent',      'description' => 'A school rejected a course requested by a teacher => Notify teacher via database that a school rejected a course proposal', 'config_data' => null, 'condition_data' => null, 'is_enabled' => 1, 'is_custom' => 1]);
        Db::table('rainlab_notify_notification_rules')->insert(['id' => 15, 'name' => 'A school approves a set of objectives => Notify teacher via email that a school approved the appraisal objectives',         'code' => "", 'class_name' => 'Genuineq\Tms\NotifyRules\SchoolObjectivesApproveEvent', 'description' => 'A school approves a set of objectives => Notify teacher via email that a school approved the appraisal objectives',         'config_data' => null, 'condition_data' => null, 'is_enabled' => 1, 'is_custom' => 1]);
        Db::table('rainlab_notify_notification_rules')->insert(['id' => 16, 'name' => 'A school approves a set of objectives => Notify teacher via database that a school approved the appraisal objectives',      'code' => "", 'class_name' => 'Genuineq\Tms\NotifyRules\SchoolObjectivesApproveEvent', 'description' => 'A school approves a set of objectives => Notify teacher via database that a school approved the appraisal objectives',      'config_data' => null, 'condition_data' => null, 'is_enabled' => 1, 'is_custom' => 1]);
        Db::table('rainlab_notify_notification_rules')->insert(['id' => 17, 'name' => 'A school sets a set of skills => Notify teacher via email that a school set the appraisal skills',                          'code' => "", 'class_name' => 'Genuineq\Tms\NotifyRules\SchoolSkillsSetEvent',         'description' => 'A school sets a set of skills => Notify teacher via email that a school set the appraisal skills',                          'config_data' => null, 'condition_data' => null, 'is_enabled' => 1, 'is_custom' => 1]);
        Db::table('rainlab_notify_notification_rules')->insert(['id' => 18, 'name' => 'A school sets a set of skills => Notify teacher via database that a school set the appraisal skills',                       'code' => "", 'class_name' => 'Genuineq\Tms\NotifyRules\SchoolSkillsSetEvent',         'description' => 'A school sets a set of skills => Notify teacher via database that a school set the appraisal skills',                       'config_data' => null, 'condition_data' => null, 'is_enabled' => 1, 'is_custom' => 1]);
        Db::table('rainlab_notify_notification_rules')->insert(['id' => 19, 'name' => 'A school closes an evaluation => Notify teacher via email that a school completed the appraisal',                           'code' => "", 'class_name' => 'Genuineq\Tms\NotifyRules\SchoolEvaluationClosedEvent',  'description' => 'A school closes an evaluation => Notify teacher via email that a school completed the appraisal',                           'config_data' => null, 'condition_data' => null, 'is_enabled' => 1, 'is_custom' => 1]);
        Db::table('rainlab_notify_notification_rules')->insert(['id' => 20, 'name' => 'A school closes an evaluation => Notify teacher via database that a school completed the appraisal',                        'code' => "", 'class_name' => 'Genuineq\Tms\NotifyRules\SchoolEvaluationClosedEvent',  'description' => 'A school closes an evaluation => Notify teacher via database that a school completed the appraisal',                        'config_data' => null, 'condition_data' => null, 'is_enabled' => 1, 'is_custom' => 1]);

        /** Populate rainlab_notify_rule_actions table. */
        Db::table('rainlab_notify_rule_actions')->truncate();
        Db::table('rainlab_notify_rule_actions')->insert(['id' => 1,  'class_name' => 'RainLab\Notify\NotifyRules\SendMailTemplateAction', 'config_data' => '{"mail_template":"genuineq.tms::mail.teacher-course-request","send_to_mode":"user","send_to_custom":"","send_to_admin":"","reply_to_custom":"","action_text":"Send a message to user email address (if applicable) using template genuineq.tms::mail.teacher-course-request"}',       'rule_host_id' => 1 ]);
        Db::table('rainlab_notify_rule_actions')->insert(['id' => 2,  'class_name' => 'RainLab\Notify\NotifyRules\SaveDatabaseAction',     'config_data' => '{"related_object":"Genuineq\\\\User\\\\Models\\\\User@notifications","action_text":"Log event in the User notifications log"}',                                                                                                                                                             'rule_host_id' => 2 ]);
        Db::table('rainlab_notify_rule_actions')->insert(['id' => 3,  'class_name' => 'RainLab\Notify\NotifyRules\SendMailTemplateAction', 'config_data' => '{"mail_template":"genuineq.tms::mail.teacher-course-approve","send_to_mode":"user","send_to_custom":"","send_to_admin":"","reply_to_custom":"","action_text":"Send a message to user email address (if applicable) using template genuineq.tms::mail.teacher-course-approve"}',       'rule_host_id' => 3 ]);
        Db::table('rainlab_notify_rule_actions')->insert(['id' => 4,  'class_name' => 'RainLab\Notify\NotifyRules\SaveDatabaseAction',     'config_data' => '{"related_object":"Genuineq\\\\User\\\\Models\\\\User@notifications","action_text":"Log event in the User notifications log"}',                                                                                                                                                             'rule_host_id' => 4 ]);
        Db::table('rainlab_notify_rule_actions')->insert(['id' => 5,  'class_name' => 'RainLab\Notify\NotifyRules\SendMailTemplateAction', 'config_data' => '{"mail_template":"genuineq.tms::mail.teacher-course-reject","send_to_mode":"user","send_to_custom":"","send_to_admin":"","reply_to_custom":"","action_text":"Send a message to user email address (if applicable) using template genuineq.tms::mail.teacher-course-reject"}',         'rule_host_id' => 5 ]);
        Db::table('rainlab_notify_rule_actions')->insert(['id' => 6,  'class_name' => 'RainLab\Notify\NotifyRules\SaveDatabaseAction',     'config_data' => '{"related_object":"Genuineq\\\\User\\\\Models\\\\User@notifications","action_text":"Log event in the User notifications log"}',                                                                                                                                                             'rule_host_id' => 6 ]);
        Db::table('rainlab_notify_rule_actions')->insert(['id' => 7,  'class_name' => 'RainLab\Notify\NotifyRules\SendMailTemplateAction', 'config_data' => '{"mail_template":"genuineq.tms::mail.teacher-objectives-set","send_to_mode":"user","send_to_custom":"","send_to_admin":"","reply_to_custom":"","action_text":"Send a message to user email address (if applicable) using template genuineq.tms::mail.teacher-objectives-set"}',       'rule_host_id' => 7 ]);
        Db::table('rainlab_notify_rule_actions')->insert(['id' => 8,  'class_name' => 'RainLab\Notify\NotifyRules\SaveDatabaseAction',     'config_data' => '{"related_object":"Genuineq\\\\User\\\\Models\\\\User@notifications","action_text":"Log event in the User notifications log"}',                                                                                                                                                             'rule_host_id' => 8 ]);
        Db::table('rainlab_notify_rule_actions')->insert(['id' => 9,  'class_name' => 'RainLab\Notify\NotifyRules\SendMailTemplateAction', 'config_data' => '{"mail_template":"genuineq.tms::mail.school-course-request","send_to_mode":"user","send_to_custom":"","send_to_admin":"","reply_to_custom":"","action_text":"Send a message to user email address (if applicable) using template genuineq.tms::mail.school-course-request"}',         'rule_host_id' => 9 ]);
        Db::table('rainlab_notify_rule_actions')->insert(['id' => 10, 'class_name' => 'RainLab\Notify\NotifyRules\SaveDatabaseAction',     'config_data' => '{"related_object":"Genuineq\\\\User\\\\Models\\\\User@notifications","action_text":"Log event in the User notifications log"}',                                                                                                                                                             'rule_host_id' => 10]);
        Db::table('rainlab_notify_rule_actions')->insert(['id' => 11, 'class_name' => 'RainLab\Notify\NotifyRules\SendMailTemplateAction', 'config_data' => '{"mail_template":"genuineq.tms::mail.school-course-approve","send_to_mode":"user","send_to_custom":"","send_to_admin":"","reply_to_custom":"","action_text":"Send a message to user email address (if applicable) using template genuineq.tms::mail.school-course-approve"}',         'rule_host_id' => 11]);
        Db::table('rainlab_notify_rule_actions')->insert(['id' => 12, 'class_name' => 'RainLab\Notify\NotifyRules\SaveDatabaseAction',     'config_data' => '{"related_object":"Genuineq\\\\User\\\\Models\\\\User@notifications","action_text":"Log event in the User notifications log"}',                                                                                                                                                             'rule_host_id' => 12]);
        Db::table('rainlab_notify_rule_actions')->insert(['id' => 13, 'class_name' => 'RainLab\Notify\NotifyRules\SendMailTemplateAction', 'config_data' => '{"mail_template":"genuineq.tms::mail.school-course-reject","send_to_mode":"user","send_to_custom":"","send_to_admin":"","reply_to_custom":"","action_text":"Send a message to user email address (if applicable) using template genuineq.tms::mail.school-course-reject"}',           'rule_host_id' => 13]);
        Db::table('rainlab_notify_rule_actions')->insert(['id' => 14, 'class_name' => 'RainLab\Notify\NotifyRules\SaveDatabaseAction',     'config_data' => '{"related_object":"Genuineq\\\\User\\\\Models\\\\User@notifications","action_text":"Log event in the User notifications log"}',                                                                                                                                                             'rule_host_id' => 14]);
        Db::table('rainlab_notify_rule_actions')->insert(['id' => 15, 'class_name' => 'RainLab\Notify\NotifyRules\SendMailTemplateAction', 'config_data' => '{"mail_template":"genuineq.tms::mail.school-objectives-approve","send_to_mode":"user","send_to_custom":"","send_to_admin":"","reply_to_custom":"","action_text":"Send a message to user email address (if applicable) using template genuineq.tms::mail.school-objectives-approve"}', 'rule_host_id' => 15]);
        Db::table('rainlab_notify_rule_actions')->insert(['id' => 16, 'class_name' => 'RainLab\Notify\NotifyRules\SaveDatabaseAction',     'config_data' => '{"related_object":"Genuineq\\\\User\\\\Models\\\\User@notifications","action_text":"Log event in the User notifications log"}',                                                                                                                                                             'rule_host_id' => 16]);
        Db::table('rainlab_notify_rule_actions')->insert(['id' => 17, 'class_name' => 'RainLab\Notify\NotifyRules\SendMailTemplateAction', 'config_data' => '{"mail_template":"genuineq.tms::mail.school-skills-set","send_to_mode":"user","send_to_custom":"","send_to_admin":"","reply_to_custom":"","action_text":"Send a message to user email address (if applicable) using template genuineq.tms::mail.school-skills-set"}',                 'rule_host_id' => 17]);
        Db::table('rainlab_notify_rule_actions')->insert(['id' => 18, 'class_name' => 'RainLab\Notify\NotifyRules\SaveDatabaseAction',     'config_data' => '{"related_object":"Genuineq\\\\User\\\\Models\\\\User@notifications","action_text":"Log event in the User notifications log"}',                                                                                                                                                             'rule_host_id' => 18]);
        Db::table('rainlab_notify_rule_actions')->insert(['id' => 19, 'class_name' => 'RainLab\Notify\NotifyRules\SendMailTemplateAction', 'config_data' => '{"mail_template":"genuineq.tms::mail.school-evaluation-close","send_to_mode":"user","send_to_custom":"","send_to_admin":"","reply_to_custom":"","action_text":"Send a message to user email address (if applicable) using template genuineq.tms::mail.school-evaluation-close"}',     'rule_host_id' => 19]);
        Db::table('rainlab_notify_rule_actions')->insert(['id' => 20, 'class_name' => 'RainLab\Notify\NotifyRules\SaveDatabaseAction',     'config_data' => '{"related_object":"Genuineq\\\\User\\\\Models\\\\User@notifications","action_text":"Log event in the User notifications log"}',                                                                                                                                                             'rule_host_id' => 20]);

        /** Populate rainlab_notify_rule_conditions table. */
        Db::table('rainlab_notify_rule_conditions')->truncate();
        Db::table('rainlab_notify_rule_conditions')->insert(['id' => 1,  'class_name' => 'RainLab\Notify\Classes\CompoundCondition',         'config_data' => '{"condition_type":0,"condition":"true"}',                                                                                                          'condition_control_type' => null,   'rule_host_type' => 'any', 'rule_host_id' => 1,    'rule_parent_id' => null]);
        Db::table('rainlab_notify_rule_conditions')->insert(['id' => 2,  'class_name' => 'Genuineq\User\NotifyRules\UserAttributeCondition', 'config_data' => '{"subcondition":"email_notifications","operator":"is","value":"1","condition_text":"Email Notifications <span class=\\"operator\\">is</span> 1"}', 'condition_control_type' => 'text', 'rule_host_type' => 'any', 'rule_host_id' => null, 'rule_parent_id' => 1   ]);
        Db::table('rainlab_notify_rule_conditions')->insert(['id' => 3,  'class_name' => 'RainLab\Notify\Classes\CompoundCondition',         'config_data' => '{"condition_type":0,"condition":"true"}',                                                                                                          'condition_control_type' => null,   'rule_host_type' => 'any', 'rule_host_id' => 2,    'rule_parent_id' => null]);
        Db::table('rainlab_notify_rule_conditions')->insert(['id' => 4,  'class_name' => 'RainLab\Notify\Classes\CompoundCondition',         'config_data' => '{"condition_type":0,"condition":"true"}',                                                                                                          'condition_control_type' => null,   'rule_host_type' => 'any', 'rule_host_id' => 3,    'rule_parent_id' => null]);
        Db::table('rainlab_notify_rule_conditions')->insert(['id' => 5,  'class_name' => 'Genuineq\User\NotifyRules\UserAttributeCondition', 'config_data' => '{"subcondition":"email_notifications","operator":"is","value":"1","condition_text":"Email Notifications <span class=\\"operator\\">is</span> 1"}', 'condition_control_type' => 'text', 'rule_host_type' => 'any', 'rule_host_id' => null, 'rule_parent_id' => 4   ]);
        Db::table('rainlab_notify_rule_conditions')->insert(['id' => 6,  'class_name' => 'RainLab\Notify\Classes\CompoundCondition',         'config_data' => '{"condition_type":0,"condition":"true"}',                                                                                                          'condition_control_type' => null,   'rule_host_type' => 'any', 'rule_host_id' => 4,    'rule_parent_id' => null]);
        Db::table('rainlab_notify_rule_conditions')->insert(['id' => 7,  'class_name' => 'RainLab\Notify\Classes\CompoundCondition',         'config_data' => '{"condition_type":0,"condition":"true"}',                                                                                                          'condition_control_type' => null,   'rule_host_type' => 'any', 'rule_host_id' => 5,    'rule_parent_id' => null]);
        Db::table('rainlab_notify_rule_conditions')->insert(['id' => 8,  'class_name' => 'Genuineq\User\NotifyRules\UserAttributeCondition', 'config_data' => '{"subcondition":"email_notifications","operator":"is","value":"1","condition_text":"Email Notifications <span class=\\"operator\\">is</span> 1"}', 'condition_control_type' => 'text', 'rule_host_type' => 'any', 'rule_host_id' => null, 'rule_parent_id' => 7   ]);
        Db::table('rainlab_notify_rule_conditions')->insert(['id' => 9,  'class_name' => 'RainLab\Notify\Classes\CompoundCondition',         'config_data' => '{"condition_type":0,"condition":"true"}',                                                                                                          'condition_control_type' => null,   'rule_host_type' => 'any', 'rule_host_id' => 6,    'rule_parent_id' => null]);
        Db::table('rainlab_notify_rule_conditions')->insert(['id' => 10, 'class_name' => 'RainLab\Notify\Classes\CompoundCondition',         'config_data' => '{"condition_type":0,"condition":"true"}',                                                                                                          'condition_control_type' => null,   'rule_host_type' => 'any', 'rule_host_id' => 7,    'rule_parent_id' => null]);
        Db::table('rainlab_notify_rule_conditions')->insert(['id' => 11, 'class_name' => 'Genuineq\User\NotifyRules\UserAttributeCondition', 'config_data' => '{"subcondition":"email_notifications","operator":"is","value":"1","condition_text":"Email Notifications <span class=\\"operator\\">is</span> 1"}', 'condition_control_type' => 'text', 'rule_host_type' => 'any', 'rule_host_id' => null, 'rule_parent_id' => 10  ]);
        Db::table('rainlab_notify_rule_conditions')->insert(['id' => 12, 'class_name' => 'RainLab\Notify\Classes\CompoundCondition',         'config_data' => '{"condition_type":0,"condition":"true"}',                                                                                                          'condition_control_type' => null,   'rule_host_type' => 'any', 'rule_host_id' => 8,    'rule_parent_id' => null]);
        Db::table('rainlab_notify_rule_conditions')->insert(['id' => 13, 'class_name' => 'RainLab\Notify\Classes\CompoundCondition',         'config_data' => '{"condition_type":0,"condition":"true"}',                                                                                                          'condition_control_type' => null,   'rule_host_type' => 'any', 'rule_host_id' => 9,    'rule_parent_id' => null]);
        Db::table('rainlab_notify_rule_conditions')->insert(['id' => 14, 'class_name' => 'Genuineq\User\NotifyRules\UserAttributeCondition', 'config_data' => '{"subcondition":"email_notifications","operator":"is","value":"1","condition_text":"Email Notifications <span class=\\"operator\\">is</span> 1"}', 'condition_control_type' => 'text', 'rule_host_type' => 'any', 'rule_host_id' => null, 'rule_parent_id' => 13  ]);
        Db::table('rainlab_notify_rule_conditions')->insert(['id' => 15, 'class_name' => 'RainLab\Notify\Classes\CompoundCondition',         'config_data' => '{"condition_type":0,"condition":"true"}',                                                                                                          'condition_control_type' => null,   'rule_host_type' => 'any', 'rule_host_id' => 10,   'rule_parent_id' => null]);
        Db::table('rainlab_notify_rule_conditions')->insert(['id' => 16, 'class_name' => 'RainLab\Notify\Classes\CompoundCondition',         'config_data' => '{"condition_type":0,"condition":"true"}',                                                                                                          'condition_control_type' => null,   'rule_host_type' => 'any', 'rule_host_id' => 11,   'rule_parent_id' => null]);
        Db::table('rainlab_notify_rule_conditions')->insert(['id' => 17, 'class_name' => 'Genuineq\User\NotifyRules\UserAttributeCondition', 'config_data' => '{"subcondition":"email_notifications","operator":"is","value":"1","condition_text":"Email Notifications <span class=\\"operator\\">is</span> 1"}', 'condition_control_type' => 'text', 'rule_host_type' => 'any', 'rule_host_id' => null, 'rule_parent_id' => 16  ]);
        Db::table('rainlab_notify_rule_conditions')->insert(['id' => 18, 'class_name' => 'RainLab\Notify\Classes\CompoundCondition',         'config_data' => '{"condition_type":0,"condition":"true"}',                                                                                                          'condition_control_type' => null,   'rule_host_type' => 'any', 'rule_host_id' => 12,   'rule_parent_id' => null]);
        Db::table('rainlab_notify_rule_conditions')->insert(['id' => 19, 'class_name' => 'RainLab\Notify\Classes\CompoundCondition',         'config_data' => '{"condition_type":0,"condition":"true"}',                                                                                                          'condition_control_type' => null,   'rule_host_type' => 'any', 'rule_host_id' => 13,   'rule_parent_id' => null]);
        Db::table('rainlab_notify_rule_conditions')->insert(['id' => 20, 'class_name' => 'Genuineq\User\NotifyRules\UserAttributeCondition', 'config_data' => '{"subcondition":"email_notifications","operator":"is","value":"1","condition_text":"Email Notifications <span class=\\"operator\\">is</span> 1"}', 'condition_control_type' => 'text', 'rule_host_type' => 'any', 'rule_host_id' => null, 'rule_parent_id' => 19  ]);
        Db::table('rainlab_notify_rule_conditions')->insert(['id' => 21, 'class_name' => 'RainLab\Notify\Classes\CompoundCondition',         'config_data' => '{"condition_type":0,"condition":"true"}',                                                                                                          'condition_control_type' => null,   'rule_host_type' => 'any', 'rule_host_id' => 14,   'rule_parent_id' => null]);
        Db::table('rainlab_notify_rule_conditions')->insert(['id' => 22, 'class_name' => 'RainLab\Notify\Classes\CompoundCondition',         'config_data' => '{"condition_type":0,"condition":"true"}',                                                                                                          'condition_control_type' => null,   'rule_host_type' => 'any', 'rule_host_id' => 15,   'rule_parent_id' => null]);
        Db::table('rainlab_notify_rule_conditions')->insert(['id' => 23, 'class_name' => 'Genuineq\User\NotifyRules\UserAttributeCondition', 'config_data' => '{"subcondition":"email_notifications","operator":"is","value":"1","condition_text":"Email Notifications <span class=\\"operator\\">is</span> 1"}', 'condition_control_type' => 'text', 'rule_host_type' => 'any', 'rule_host_id' => null, 'rule_parent_id' => 22  ]);
        Db::table('rainlab_notify_rule_conditions')->insert(['id' => 24, 'class_name' => 'RainLab\Notify\Classes\CompoundCondition',         'config_data' => '{"condition_type":0,"condition":"true"}',                                                                                                          'condition_control_type' => null,   'rule_host_type' => 'any', 'rule_host_id' => 16,   'rule_parent_id' => null]);
        Db::table('rainlab_notify_rule_conditions')->insert(['id' => 25, 'class_name' => 'RainLab\Notify\Classes\CompoundCondition',         'config_data' => '{"condition_type":0,"condition":"true"}',                                                                                                          'condition_control_type' => null,   'rule_host_type' => 'any', 'rule_host_id' => 17,   'rule_parent_id' => null]);
        Db::table('rainlab_notify_rule_conditions')->insert(['id' => 26, 'class_name' => 'Genuineq\User\NotifyRules\UserAttributeCondition', 'config_data' => '{"subcondition":"email_notifications","operator":"is","value":"1","condition_text":"Email Notifications <span class=\\"operator\\">is</span> 1"}', 'condition_control_type' => 'text', 'rule_host_type' => 'any', 'rule_host_id' => null, 'rule_parent_id' => 25  ]);
        Db::table('rainlab_notify_rule_conditions')->insert(['id' => 27, 'class_name' => 'RainLab\Notify\Classes\CompoundCondition',         'config_data' => '{"condition_type":0,"condition":"true"}',                                                                                                          'condition_control_type' => null,   'rule_host_type' => 'any', 'rule_host_id' => 18,   'rule_parent_id' => null]);
        Db::table('rainlab_notify_rule_conditions')->insert(['id' => 28, 'class_name' => 'RainLab\Notify\Classes\CompoundCondition',         'config_data' => '{"condition_type":0,"condition":"true"}',                                                                                                          'condition_control_type' => null,   'rule_host_type' => 'any', 'rule_host_id' => 19,   'rule_parent_id' => null]);
        Db::table('rainlab_notify_rule_conditions')->insert(['id' => 29, 'class_name' => 'Genuineq\User\NotifyRules\UserAttributeCondition', 'config_data' => '{"subcondition":"email_notifications","operator":"is","value":"1","condition_text":"Email Notifications <span class=\\"operator\\">is</span> 1"}', 'condition_control_type' => 'text', 'rule_host_type' => 'any', 'rule_host_id' => null, 'rule_parent_id' => 28  ]);
        Db::table('rainlab_notify_rule_conditions')->insert(['id' => 30, 'class_name' => 'RainLab\Notify\Classes\CompoundCondition',         'config_data' => '{"condition_type":0,"condition":"true"}',                                                                                                          'condition_control_type' => null,   'rule_host_type' => 'any', 'rule_host_id' => 20,   'rule_parent_id' => null]);

        /** Populate ajaylulia_ocookie_configuration table. */
        Db::table('ajaylulia_ocookie_configuration')->truncate();
        Db::table('ajaylulia_ocookie_configuration')->insert(['id' => 1, 'display_position' => 'right', 'button_text' => 'Sunt de acord', 'background_color' => '#4c3949', 'text_color' => '#fff', 'link_color' => '#9a4877', 'button_background_color' => '#9a4877', 'button_text_color' => '#fff', 'cookie_content' => 'Pentru a-ti oferi o experienta buna de navigare, utilizam fisiere de tip cookie. Daca nu esti de acord cu utilizarea cookie-urilor, poti sa iti retragi consimtamantul prin modificarea setarilor din browser-ul tau. <a href="http:\/\/scoalaprofesorilor.ro\/politica-de-cookie">Politica de cookie</a>']);

        DB::table('rainlab_translate_locales')->truncate();
        Db::table('rainlab_translate_locales')->insert(['id' => 1, 'code' => 'en', 'name' => 'English',  'is_default' => 0, 'is_enabled' => 1, 'sort_order' => 1]);
        Db::table('rainlab_translate_locales')->insert(['id' => 2, 'code' => 'ro', 'name' => 'Romanian', 'is_default' => 1, 'is_enabled' => 1, 'sort_order' => 2]);
    }

    public function down()
    {
        /** Clear rainlab_translate_locales table. */
        Db::table('rainlab_translate_locales')->truncate();

        /** Clear ajaylulia_ocookie_configuration table. */
        Db::table('ajaylulia_ocookie_configuration')->truncate();

        /** Clear rainlab_notify_rule_conditions table. */
        Db::table('rainlab_notify_rule_conditions')->truncate();

        /** Clear rainlab_notify_rule_actions table. */
        Db::table('rainlab_notify_rule_actions')->truncate();

        /** Clear rainlab_notify_notification_rules table. */
        Db::table('rainlab_notify_notification_rules')->truncate();

        /** Clear system_mail_partials table. */
        Db::table('system_mail_partials')->truncate();

        /** Clear system_mail_templates table. */
        Db::table('system_mail_templates')->truncate();

        /** Clear system_settings table. */
        Db::table('system_settings')->truncate();

        /** Clear ajaylulia_ocookie_configuration table. */
        Db::table('ajaylulia_ocookie_configuration')->truncate();
    }
}
