// $( document ).ready(function() {
//     var ctxL = document.getElementById("skillMatrix").getContext('2d');

//     var myLineChart = new Chart(ctxL, {
//         type: 'line',
//         data: {
//             labels: [
//                 {% for skillSemestersLabel in skillSemestersLabels %}
//                     "{{ skillSemestersLabel }}",
//                 {% endfor %}
//             ],
//             datasets: [
//                 {% for skillSemester in skillSemesters %}
//                     {
//                         label: "{{ skillSemester['label'] }}",
//                         data: [
//                             {% for skillValue in skillSemester['values'] %}
//                                 {{ skillValue }},
//                             {% endfor %}
//                         ],
//                         backgroundColor: [ "{{ skillSemester['backgroundColor'] }}", ],
//                         borderColor: [ "{{ skillSemester['borderColor'] }}", ],
//                         borderWidth: 2
//                     },
//                 {% endfor %}
//             ]
//         },
//         options: {
//             responsive: true
//         }
//     });
// });