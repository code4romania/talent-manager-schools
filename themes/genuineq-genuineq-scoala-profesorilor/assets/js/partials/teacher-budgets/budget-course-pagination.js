$(document).ready( () => {
    $('.budget-course-search-pagination').on('click', function () {
        let jsScript = $("#partial-budget-course-pagination");

        /* Extract the "nonce" script attribute. */
        let cspNonce = jsScript.attr("data-cspNonce");

        /* Extract the clicked page. */
        var $newPage = $(this).data('page');

        /* Select the course select form and send the request */
        $('#budgetCourseSearchForm').request(
            'onTeacherBudgetCourseSearch',
            {
                update: {
                    'teacher-budgets/budget-summary': '#budgetSummary',
                    'teacher-budgets/budget-category-grid': '#budgetCategories',
                    'teacher-budgets/budget-course-grid': '#budgetCourseSearchResults',
                    'teacher-budgets/budget-course-pagination': '#budgetCourseSearchPagination',
                },
                data: {
                    page: $newPage,
                    nonce: cspNonce
                }
            }
        );
    });
})
