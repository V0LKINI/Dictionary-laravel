function checkAnswer(correct_translation, chosen_translation, word_id, word_index, count){

    //Добавление кнопки "Далее" или "Завершить"
    if (word_index === count) {
        $('#nextWordDiv').append('<input type="submit" class="btn btn-primary fs-5" id="completeExerciseButton" ' +
            'value="Завершить">');
    } else {
        $('#nextWordDiv').append('<input type="button" class="btn btn-primary fs-5"' +
            ' onclick="nextWord(' + word_index + ')"' +
            ' id="nextWordButton" name="chosenWord" value="Далее">');
    }

    //Подсвечиваем правильный ответ зелёным, неправильный красным
    if (correct_translation === chosen_translation) {
        $("label[for='exerciseWordButton-" + word_index + "-" + correct_translation + "']")
            .attr("class", "btn btn-success fs-5 exerciseWordButton");
    } else {
        $("label[for='exerciseWordButton-" + word_index + "-" + chosen_translation + "']")
            .attr("class", "btn btn-danger fs-5 exerciseWordButton checkLabel-" + word_index);
        $("label[for='exerciseWordButton-" + word_index + "-" + correct_translation + "']")
            .attr("class", "btn btn-success fs-5 exerciseWordButton checkLabel-" + word_index);
    }

    $('.checkLabel-' + word_index).attr('for', false);
}

function nextWord(word_index) {
    $('#word-' + word_index).attr('hidden', true);
    $('#word-' + (word_index + 1)).attr('hidden', false);
    $('#nextWordButton').detach();
}

$('#exerciseForm').one('submit', function() {
    $(this).find('input[type="submit"]').attr('disabled','disabled');
});

$(document).keyup(function (event) {
    if (event.keyCode == 13) {
        $("#completeExerciseButton").click();
        $("#nextWordButton").click();
    }
});


