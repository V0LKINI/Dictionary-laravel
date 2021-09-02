function submitAndNextRepetition(answer, word_id, word_index, count) {

    //Запрещаем выбирать ответ ещё раз, показываем перевод слова
    $('.exerciseWordButton-' + word_index).prop("onclick", null).off("click");
    $('#translation-' + word_index).attr("hidden", false);

    //Отображение кнопки "Не помню" после нажатие на ответ
    $('#nextWordDiv').append('<input type="button" class="btn btn-primary fs-5"' +
        'id="dontRemember" value="Не помню" onclick="dontRemember(' + word_id + ',' + word_index + ')">');

    //Отображение кнопок "Далее" или "Завершить" после нажатие на ответ
    if (word_index === count) {
        if ($("#nextWordButton").length == 0) {
            $('#nextWordDiv').append('<input type="button" class="btn btn-primary fs-5" ' +
                'onclick="viewExerciseResult(\'repetition\', ' + count + ')" ' +
                'id="completeExerciseButton" name="chosenWord" value="Завершить">');
        }
    } else {
        if ($("#nextWordButton").length == 0) {
            $('#nextWordDiv').append('<input type="button" class="btn btn-primary fs-5"' +
                'onclick="nextWordRepetition(' + word_index + ')"' +
                'id="nextWordButton" name="chosenWord" value="Далее">');
        }
    }

    //проверяется ответ пользователя. Если он помнит слово, результат true
    let result = answer === 'Помню';

    //Увеличиваем опыт есть пользователь помнит слово
    if (result){
        let span = $("#userExperience");
        span.text(Number(span.text()) + 1);
    }

    //Отправка ajax запроса
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
