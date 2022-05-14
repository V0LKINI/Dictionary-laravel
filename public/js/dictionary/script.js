//запуск функции scrolling при прокрутке
$(window).on("scroll", scrolling);

$(document).ready(function () {
    onClickAddButton();
    onClickEditButton()
    onClickResetButton();

    onClickEditPen();
    onClickDeleteBin()
    onCLickResetProgressIcon();

    onChangeFormInput();
});

function onWordAddingEditing(){
    onClickEditPen();
    onClickDeleteBin()
    onCLickResetProgressIcon();
}

var page = 1;
var block_show = false;
var csrf_token = $('meta[name="csrf-token"]').attr('content');

function scrolling() {
    if (block_show) {
        return false;
    }
    let currentHeight = $(".content").height();
    //проверка достижения конца прокрутки
    if ($(this).scrollTop() >= (currentHeight - $(this).height() - 2000)) {
        //функция реализующая загрузку контента
        loadWords();
        block_show = true;
        page++;
    }
}

function loadWords() {

    $.ajax({
        url: 'dictionary/load',
        method: 'post',
        dataType: 'html',
        data: {page: page},
        headers: {
            'X-CSRF-TOKEN': csrf_token
        },
        success: function (data) {
            //Добавляем слова в таблицу
            $('.tableRow').last().after(data);
            block_show = false;
        }
    });
}

function onClickAddButton() {
    $('#addButton').click(function (){

        if(validateFormDate()){
            $.ajax({
                url: '/dictionary/addtest',
                type: "post",
                dataType: "json",
                data: $("#addWordForm").serialize(),

                success: function (data) { //Слово добавлено в словарь

                    $('#tableHead').after(data);
                    resetForm();

                    Toast.add({
                        text: locale.dictionary.word_added_to_dict,
                        color: "#28a745",
                        autohide: true,
                        delay: 3000
                    });

                    onWordAddingEditing();

                }, error: function (xhr) {
                    if (xhr.status === 422) {
                        let errors = Object.entries(xhr.responseJSON.errors);
                        $("#errorMessage").html(errors[0][1]);
                    } else if (xhr.status === 400) {
                        $("#errorMessage").html(xhr.responseText);
                    }
                }
            });
        }

    });

}

function onClickEditButton() {
    $('#editButton').click(function (){

        if (validateFormDate()){
            let word_id = $(this).attr('data-word-id');
            let serialisedData = $("#addWordForm").serialize();

            editRowInTable(word_id);
            resetForm();

            Toast.add({
                text: locale.dictionary.word_successfully_changed,
                color: "#28a745",
                autohide: true,
                delay: 3000
            });


            $.ajax({
                url: '/dictionary/edit/' + word_id,
                type: "put",
                dataType: "json",
                data: serialisedData + "&id=" + word_id,
                error: function (xhr) { //Слово НЕ отредактировалось

                    if (xhr.status === 422) {
                        let errors = Object.entries(xhr.responseJSON.errors);
                        $("#errorMessage").html(errors[0][1]);
                    } else if (xhr.status === 403 || xhr.status === 400) {
                        $("#errorMessage").html(xhr.responseText);
                    }
                }
            });
        }


    });
}

function onClickResetButton() {

    $('#resetButton').click(function (){
        resetForm();
    });

}

function resetForm(){
    let wrapperEng = $('#englishInputWrapper');
    let wrapperRu = $('#russianInputWrapper');

    $("#formNameAdd").attr('hidden', false);
    $("#formNameEdit").attr('hidden', true);

    $('#addWordForm input[name="english"]').val('');
    $('#addWordForm input[name="russian"]').val('');

    $('#addButton').css('display', 'inline-block');
    $('#editButton').css('display', 'none').removeAttr('data-word-id');

    $('#errorMessage').text('');

    wrapperEng.removeClass('form-has-error');
    wrapperRu.removeClass('form-has-error');

    wrapperEng.find('input').removeClass('hasValue');
    wrapperRu.find('input').removeClass('hasValue');

    wrapperEng.find('.form-element-hint').html('');
    wrapperRu.find('.form-element-hint').html('');
}

function onClickEditPen() {

    $('.penIcon').click(function (){

        let arr = $(this).closest('tr').find('td'); //1 элемент-слово на русском, 2 элемент - перевод на английском
        let id = $(this).closest('tr').attr('id').match(/\d+/);

        $("#formNameAdd").attr('hidden', true);
        $("#formNameEdit").attr('hidden', false);

        $("#addWordForm input[name='english']").val(arr.get(0).innerHTML).addClass('hasValue');
        $("#addWordForm input[name='russian']").val(arr.get(1).innerHTML).addClass('hasValue').focus();

        $('#addButton').css('display', 'none');
        $('#editButton').attr('data-word-id', id).css('display', 'inline-block');

    });

}


function onClickDeleteBin() {

    $('.binIcon').click(function () {
        let tr = $(this).closest('tr')
        let id = tr.attr('id').match(/\d+/);
        let url = '/dictionary/delete/' + id;

        tr.detach();

        $.ajax({
            url: url,
            method: 'delete',
            dataType: 'html',
            headers: {
                'X-CSRF-TOKEN': csrf_token
            },
            error: function (xhr) { //Слово НЕ удалилось
                if (xhr.status === 403 || xhr.status === 400) {
                    $("#errorMessage").html(xhr.responseText);
                }
            }
        });

    });

}


function onCLickResetProgressIcon() {

    $('.resetIcon').click(function () {

        let tr = $(this).closest('tr')
        let id = tr.attr('id').match(/\d+/);
        let url = '/dictionary/reset/' + id;

        tr.find("#wordProgress").text('0%');

        $.ajax({
            url: url,
            method: 'put',
            dataType: 'html',
            data: {word_id: id},
            headers: {
                'X-CSRF-TOKEN': csrf_token
            },
            error: function (xhr) { //Прогресс не сбросился
                if (xhr.status === 403 || xhr.status === 400) {
                    $("#errorMessage").html(xhr.responseText);
                }
            }
        });
    });
}


function editRowInTable(word_id) {

    let english = $('input[name="english"]').val();
    let russian = $('input[name="russian"]').val();
    let td = $('#tableRow-' + word_id).find('td');

    td[0].innerText = english[0].toUpperCase() + english.substring(1);
    td[1].innerText = russian[0].toUpperCase() + russian.substring(1);

}

function validateFormDate() {

    let wrapperEng = $('#englishInputWrapper');
    let wrapperRu = $('#russianInputWrapper');

    let englishText = wrapperEng.find('input[name="english"]').val();
    let russianText = wrapperRu.find('input[name="russian"]').val();

    let errorBlockEng = wrapperEng.find('.form-element-hint');
    let errorBlockRu = wrapperRu.find('.form-element-hint');

    let isError = false;

    //validate english input
    if(englishText.length > 25){
        wrapperEng.addClass('form-has-error');
        errorBlockEng.html(locale.dictionary.validation.word_too_long);
        isError = true;
    } else if (englishText.length === 0) {
        wrapperEng.addClass('form-has-error');
        errorBlockEng.html(locale.dictionary.validation.word_wasnt_entered);
        isError = true;
    } else if (englishText.match('^[a-zA-ZÄäÖöẞßÜü,.-\\s]+$') == null) {
        wrapperEng.addClass('form-has-error');
        errorBlockEng.html(locale.dictionary.validation.word_must_be_latin);
        isError = true;
    } else {
        wrapperEng.removeClass('form-has-error');
        errorBlockEng.html('');
    }

    //validate russian input
    if (russianText.length > 25) {
        wrapperRu.addClass('form-has-error');
        errorBlockRu.html(locale.dictionary.validation.translation_too_long);
        isError = true;
    } else if (russianText.length === 0) {
        wrapperRu.addClass('form-has-error');
        errorBlockRu.html(locale.dictionary.validation.translation_wasnt_entered);
        isError = true;
    } else if (russianText.match('^[а-яА-ЯёЁ,.-\\s]+$') == null) {
        wrapperRu.addClass('form-has-error');
        errorBlockRu.html(locale.dictionary.validation.translation_must_be_cyrillic);
        isError = true;
    } else {
        wrapperRu.removeClass('form-has-error');
        errorBlockRu.html('');
    }

    return !isError;

}

function onChangeFormInput(){
    $('.form-element-input').change(function() {
        if($(this).val()) {
            $(this).addClass('hasValue');
        } else {
            $(this).removeClass('hasValue');
        }
    });
}



