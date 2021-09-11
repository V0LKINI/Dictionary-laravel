function checkAnswerRepetition(answer, word_id, word_index, count) {

    //Отображение кнопок "Далее" или "Завершить" после нажатие на ответ
    if (word_index === count) {
        if ($("#completeExerciseButton").length === 0) {
            $('#nextWordDiv').append('<input type="submit" class="btn btn-primary fs-5" id="completeExerciseButton" ' +
                'value="Завершить">');
        }
    } else {
        if ($("#nextWordButton").length === 0) {
            $('#nextWordDiv').append('<input type="button" class="btn btn-primary fs-5"' +
                ' onclick="nextWordRepetition(' + word_index + ')"' +
                ' id="nextWordButton" value="Далее">');
        }
    }

    //Показываем перевод слова
    $('#translation-' + word_index).attr("hidden", false);
}

function nextWordRepetition(word_index){
    $('#word-' + word_index).attr('hidden', true);
    $('#word-' + (word_index + 1)).attr('hidden', false);
    $('#nextWordButton').detach();
    $('#previousWordButton').detach();
}

