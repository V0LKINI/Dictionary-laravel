//запуск функции scrolling при прокрутке
$(window).on("scroll", scrolling);

$(document).ready(function () {
    onClickAddButton();
    onClickEditButton()
    onClickResetButton();

    onClickEditPen();
    onClickDeleteBin()
    onCLickResetProgressIcon();
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
    let currentHeight = $("#content").height();

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
                url: '/dictionary/add',
                type: "post",
                dataType: "json",
                data: $("#addWordForm").serialize(),

                success: function (data) { //Слово добавлено в словарь
                    addRowInTable(data);

                    Toast.add({
                        text: "Слово добавлено в словарь",
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

            Toast.add({
                text: "Слово успешно изменено",
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
                    console.log('ошибка');
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
    $("#formName").text('Добавить слово');

    $('#addWordForm input[name="english"]').val('');
    $('#addWordForm input[name="russian"]').val('');

    $('#addButton').css('display', 'inline-block');
    $('#editButton').css('display', 'none').removeAttr('data-word-id');

    $('#errorMessage').text('');
}

function onClickEditPen() {

    $('.penIcon').click(function (){

        let arr = $(this).closest('tr').find('td'); //1 элемент-слово на русском, 2 элемент - перевод на английском
        let id = $(this).closest('tr').attr('id').match(/\d+/);

        $("#formName").text('Изменить слово');
        $("#addWordForm input[name='english']").val(arr.get(0).innerHTML);
        $("#addWordForm input[name='russian']").val(arr.get(1).innerHTML).focus();

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



function addRowInTable(data) {
    $('#tableHead').after(data);
    resetForm();
}

function editRowInTable(word_id) {

    let english = $('#addWordForm input[name="english"]').val();
    let russian = $('#addWordForm input[name="russian"]').val();
    let td = $('#tableRow-' + word_id).find('td');

    td[0].innerText = english[0].toUpperCase() + english.substring(1);
    td[1].innerText = russian[0].toUpperCase() + russian.substring(1);

    resetForm();
}

function validateFormDate() {

    let english = $('#addWordForm input[name="english"]').val();
    let russian = $('#addWordForm input[name="russian"]').val();
    let errorBlock = $('#errorMessage');

    console.log(english.match('^[a-zA-Z]+$'));

    if(english.length > 25){
        errorBlock.text('Слово слишком длинное');
        return false;
    } else if (russian.length > 25) {
        errorBlock.text('Перевод слишком длинный');
        return false;
    } else if (english.length === 0) {
        errorBlock.text('Не передано слово');
        return false;
    } else if (russian.length === 0) {
        errorBlock.text('Не передан перевод слова');
        return false;
    } else if (english.match('^[a-zA-Z,.-\\s]+$') == null) {
        errorBlock.text('Слово должно состоять из букв латиницы');
        return false;
    } else if (russian.match('^[а-яА-ЯёЁ,.-\\s]+$') == null) {
        errorBlock.text('Перевод должен состоять из букв кириллицы');
        return false;
    }
    return true;
}


