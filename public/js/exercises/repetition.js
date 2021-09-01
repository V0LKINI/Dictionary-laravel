function submitAndNextRepetition(answer, word_id, word_index, count) {

    $('.exerciseWordButton-' + word_index).prop("onclick", null).off("click");
    $('#translation').attr("hidden", false);

    $('#nextWordDiv').append('<input type="button" class="btn btn-primary fs-5"' +
        'id="dontRemember" value="Не помню" onclick="dontRemember(' + word_id + ',' + word_index + ')">');

    if (word_index === count) {
        if ($("#nextWordButton").length == 0) {
            $('#nextWordDiv').append('<input type="button" class="btn btn-primary fs-5" ' +
                'onclick="viewExerciseResult(\'repetition\')" id="nextWordButton" name="chosenWord" value="Завершить">');
        }
    } else {
        if ($("#nextWordButton").length == 0) {
            $('#nextWordDiv').append('<input type="button" class="btn btn-primary fs-5"' +
                'onclick="nextWordRepetition(' + word_index + ')"' +
                'id="nextWordButton" name="chosenWord" value="Далее">');
        }
    }

    let result = answer === 'Помню';

    $.ajax({
        url: 'checkAnswerRepetition',
        method: 'post',
        dataType: 'html',
        data: {
            "word_id": word_id,
            "result": result
        },
        headers: {
            'X-CSRF-TOKEN': csrf_token
        }
    });

}

function nextWordRepetition(word_index){
    $('#word-' + word_index).attr('hidden', true);
    $('#word-' + (word_index+ 1)).attr('hidden', false);
    $('#nextWordButton').detach();
    $('#dontRemember').detach();
}

function dontRemember(word_id, word_index){
    nextWordRepetition(word_index)
    $.ajax({
        url: 'checkAnswerRepetition',
        method: 'post',
        dataType: 'html',
        data: {
            "word_id": word_id,
            "result": 'false'
        },
        headers: {
            'X-CSRF-TOKEN': csrf_token
        }
    });
}
