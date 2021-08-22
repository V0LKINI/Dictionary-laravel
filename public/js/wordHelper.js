function add() {

    var formName = $("#formName");

    formName.text('Добавить слово');

    $('#submitWordButton').attr('onclick', 'addWord()');
    $("#submitWordButton").val('Добавить');

    $('#errorMessage').text('');
}

function edit(id) {

    let tr = $('#tableRow-'+id)[0];
    let arr = tr.innerText.trim().split('\t'); //1 элемент-слово, 2 элемент - перевод
    let formName = $("#formName");
    let wordArea = $("#english");
    let translateArea = $("#russian");

    formName.text('Изменить слово');
    wordArea.val(arr[0]);
    translateArea.val(arr[1]);
    translateArea.focus();

    $('#submitWordButton').attr('onclick', 'editWord(' + id + ')');
    $("#submitWordButton").val('Изменить');
}


