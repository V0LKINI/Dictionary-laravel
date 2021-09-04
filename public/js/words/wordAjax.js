//запуск функции scrolling при прокрутке
// $(window).on("scroll", scrolling);
//
// var page = 1;
// var block_show = false;
//
var csrf_token = $('meta[name="csrf-token"]').attr('content');
//
// function scrolling(){
//     if (block_show) {
//         return false;
//     }
//     let currentHeight = $("#content").height();
//
//     //проверка достижения конца прокрутки
//     if($(this).scrollTop() >= (currentHeight - $(this).height()-2000)){
//         //функция реализующая загрузку контента
//         loadWords();
//         block_show = true;
//         page++;
//     }
// }
//
// function loadWords(){
//     $.ajax({
//         url: 'words/load',
//         method: 'post',
//         dataType: 'html',
//         data: {page: page},
//         success: function(data){
//             //Добавляем слова в таблицу
//             $('#mainTable tr:last').after(data);
//             block_show = false;
//         }
//     });
// }


function addWord() {
    $.ajax({
        url: '/words/add',
        type: "post",
        dataType: "json",
        data: $("#addWordForm").serialize(),
        success: function (data) { //Слово добавлено в словарь

            addRowInTable(data);
            let selected_word = '#' + $('tr').eq(1).attr('id');
            $(selected_word).detach();
            $(selected_word).detach();
            addRowInTable(data);

            Toast.add({
                text: "Слово добавлено в словарь",
                color: "#28a745",
                autohide: true,
                delay: 3000
            });

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


function deleteWord(word_id) {

    let url = '/words/delete/' + word_id;
    let selected_word = '#tableRow-' + word_id;

    $(selected_word).detach();

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
}


function editWord(word_id) {
    $.ajax({
        url: '/words/edit/' + word_id,
        type: "put",
        dataType: "json",
        data: $("#addWordForm").serialize() + "&id=" + word_id,
        success: function (data) { //Слово отредактировалось
            let selected_word = '#tableRow-' + word_id;
            $(selected_word).detach();
            addRowInTable(data);

            Toast.add({
                text: "Слово успешно изменено",
                color: "#28a745",
                autohide: true,
                delay: 3000
            });

            $("#formName").text('Добавить слово');
            $('#submitWordButton').attr('onclick', 'addWord()');
            $("#submitWordButton").val('Добавить');
        },
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

function resetWordProgress(word_id) {
    let url = '/words/reset/' + word_id;
    let selected_word = '#tableRow-' + word_id;
    $(selected_word + " #wordProgress").text('0%');

    $.ajax({
        url: url,
        method: 'put',
        dataType: 'html',
        data: {word_id: word_id},
        headers: {
            'X-CSRF-TOKEN': csrf_token
        },
        error: function (xhr) { //Прогресс не сбросился
            if (xhr.status === 403 || xhr.status === 400) {
                $("#errorMessage").html(xhr.responseText);
            }
        }
    });
}


function addRowInTable(data) {
    //Добавляем строку в таблицу
    let tableHead = document.getElementById('tableHead');
    let newRow = document.createElement('tr');
    newRow.innerHTML = data;

    tableHead.parentNode.insertBefore(newRow, tableHead.nextElementSibling);

    //Добавляем class и id только что добавленной строке
    let onclick = tableHead.nextElementSibling.children[2].children[0].getAttribute('onclick');
    let id = onclick.match(/\d+/)[0];
    newRow.className = 'tableRow';
    newRow.id = 'tableRow-' + id;

    //Очищаем форму
    $("#english").val('');
    $("#russian").val('');
    $("#errorMessage").text('');
}


