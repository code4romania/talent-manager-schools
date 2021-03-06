$(document).ready( () => {
    $('.learning-plan-add-course').on('click', function () {
        let jsScript = $("#partial-learning-plan-course-add-remove-btn-2");

        /* Extract the "nonce" script attribute. */
        let cspNonce = jsScript.attr("data-cspNonce");

        /* Extract the course and learning plan data. */
        var $courseId = $(this).data('courseId');
        var $learningPlanId = $(this).data('learningPlanId');

        $.request(
            'onTeacherLearningPlanCourseAdd',
            {
                update: {
                    'teacher-learning-plans/learning-plan-course-add-remove-btn': '#add-remove-course'
                },
                data: {
                    courseId: $courseId,
                    learningPlanId: $learningPlanId,
                    noSearch: true,
                    nonce: cspNonce
                },
            }
        );
    });
})
