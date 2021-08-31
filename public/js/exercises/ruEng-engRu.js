function submitAnswer(correct_translation, chosen_translation, word_id, word_index, count, exercise_name) {

    let result = false;

    $('.exerciseWordButton-' + word_index).prop("onclick", null).off("click");
    if (word_index === count){
        $('#nextWordDiv').append('<input type="button" class="btn btn-primary fs-5" ' +
            'onclick="viewExerciseResult(\'' + exercise_name + '\')"' +
            'id="nextWordButton" name="chosenWord" value="Завершить">');
    } else {
        $('#nextWordDiv').append('<input type="button" class="btn btn-primary fs-5"' +
            'onclick="nextWord(' + word_index + ')"' +
            'id="nextWordButton" name="chosenWord" value="Далее">');
    }

    if (correct_translation === chosen_translation) {
        $('[value = ' + chosen_translation + ']').attr("class", "btn btn-success fs-5 exerciseWordButton");
        let span = $("#userExperience");
        span.text(Number(span.text()) + 1);
        result = true;
    } else {
        $('[value = ' + chosen_translation + ']').attr("class", "btn btn-danger fs-5 exerciseWordButton");
        $('[value = ' + correct_translation + ']').attr("class", "btn btn-success fs-5 exerciseWordButton");
        result = false;
    }

    $.ajax({
        url: 'checkAnswer',
        method: 'post',
        dataType: 'html',
        data: {
            "word_id": word_id,
            "result": result,
            "exerciseName": exercise_name
        },
        headers: {
            'X-CSRF-TOKEN': csrf_token
        }
    });
}

function nextWord(word_index){
    $('#word-' + word_index).attr('hidden', true);
    $('#word-' + (word_index+ 1)).attr('hidden', false);
    $('#nextWordButton').detach();
}

function viewExerciseResult(exercise_name){
    $.ajax({
        url: 'getResults',
        method: 'post',
        dataType: 'html',
        data: {
            "exerciseName": exercise_name
        },
        headers: {
            'X-CSRF-TOKEN': csrf_token
        },
        success: function(data){
            $('.exerciseForm').detach();
            $('#nextWordDiv').detach();
            $('#content').append(data);
        }
    });
}
