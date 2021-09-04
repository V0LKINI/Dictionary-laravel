function viewExerciseResult(exercise_name, count) {
    $('#completeExerciseButton').attr('disabled', true);

    $.ajax({
        url: 'getResults',
        method: 'post',
        dataType: 'html',
        data: {
            "exerciseName": exercise_name,
            "count": count
        },
        headers: {
            'X-CSRF-TOKEN': csrf_token
        },
        success: function (data) {
            $('.exerciseForm').detach();
            $('#nextWordDiv').detach();
            $('#content').append(data);
        }, error: function (xhr) {
            if (xhr.status === 500) {
                viewExerciseResult(exercise_name, count);
            }
        }
    });
}

$(document).keyup(function (event) {
    if (event.keyCode == 13) {
        $("#completeExerciseButton").click();
        $("#nextWordButton").click();
    }
});


