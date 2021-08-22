//запуск функции scrolling при прокрутке
// $(window).on("scroll", scrolling);
//
// var page = 1;
// var block_show = false;
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
        type: "POST",
        dataType: "html",
        data: $("#addWordForm").serialize(),
        success: function(data) { //Слово добавлено в словарь
            addRowInTable(data);
            let selected_word = '#' + $('tr').eq(1).attr('id');
            $(selected_word).detach();
            $(selected_word).detach();
            addRowInTable(data);
        },
        error: function(xhr) { //Слово не добавлено
            $("#errorMessage").html(xhr.responseText);
        }
    });
}


function deleteWord(word_id) {
    let url = '/words/' + word_id + '/delete';
    let selected_word = '#tableRow-' + word_id;
    $(selected_word).detach();

    $.ajax({
        url: url,
        method: 'get',
        dataType: 'html'
    });
}


// function editWord(word_id) {
//     $.ajax({
//         url: '/words/edit',
//         type: "POST",
//         dataType: "html",
//         data: $("#addWordForm").serialize() + "&word_id=" + word_id,
//         success: function(data) { //Слово добавлено в словарь
//             let selected_word = '#tableRow-' + word_id;
//             $(selected_word).detach();
//
//             addRowInTable(data);
//
//             $("#formName").text('Добавить слово');
//             $('#submitWordButton').attr('onclick', 'addWord()');
//             $("#submitWordButton").val('Добавить');
//         },
//         error: function(xhr) { //Слово не добавлено
//             $("#errorMessage").html(xhr.responseText);
//         }
//     });
// }


function addRowInTable(data){
    //Добавляем строку в таблицу
    let tableHead = document.getElementById('tableHead');
    let newRow = document.createElement('tr');
    newRow.innerHTML = data;
    tableHead.parentNode.insertBefore(newRow, tableHead.nextElementSibling );

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

// function resetWordProgress (word_id){
//     let url = '/words/reset';
//     let selected_word = '#tableRow-' + word_id;
//     $(selected_word + " #wordProgress").text('0%');
//
//     $.ajax({
//         url: url,
//         method: 'post',
//         dataType: 'html',
//         data: {word_id: word_id},
//     });
// }
