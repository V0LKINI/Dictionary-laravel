
$(document).ready(function () {
    sectionsOnLoad();
    sectionsOnClick();
    titleToCode();
});

function titleToCode(){
    $("#news_title").keyup(function() {
        $("#news_code").val(translit(this.value));
    });
}

function translit(str){
    var answer = '';
    var converter = {
        'а': 'a',    'б': 'b',    'в': 'v',    'г': 'g',    'д': 'd',
        'е': 'e',    'ё': 'e',    'ж': 'zh',   'з': 'z',    'и': 'i',
        'й': 'y',    'к': 'k',    'л': 'l',    'м': 'm',    'н': 'n',
        'о': 'o',    'п': 'p',    'р': 'r',    'с': 's',    'т': 't',
        'у': 'u',    'ф': 'f',    'х': 'h',    'ц': 'c',    'ч': 'ch',
        'ш': 'sh',   'щ': 'sch',  'ь': '',     'ы': 'y',    'ъ': '',
        'э': 'e',    'ю': 'yu',   'я': 'ya', ' ': '-',

        'А': 'A',    'Б': 'B',    'В': 'V',    'Г': 'G',    'Д': 'D',
        'Е': 'E',    'Ё': 'E',    'Ж': 'Zh',   'З': 'Z',    'И': 'I',
        'Й': 'Y',    'К': 'K',    'Л': 'L',    'М': 'M',    'Н': 'N',
        'О': 'O',    'П': 'P',    'Р': 'R',    'С': 'S',    'Т': 'T',
        'У': 'U',    'Ф': 'F',    'Х': 'H',    'Ц': 'C',    'Ч': 'Ch',
        'Ш': 'Sh',   'Щ': 'Sch',  'Ь': '',     'Ы': 'Y',    'Ъ': '',
        'Э': 'E',    'Ю': 'Yu',   'Я': 'Ya'
    };

    for (var i = 0; i < str.length; ++i ) {
        if (converter[str[i]] == undefined){
            answer += str[i];
        } else {
            answer += converter[str[i]];
        }
    }

    return answer;
}


function sectionsOnClick(){
    let menuItems = $('.admin__menu-item');

    menuItems.click(function(){
        let section_id = $(this).attr('data-sectionId');
        let allSections = $('section');
        let checkedSection = $('#' + section_id);

        allSections.attr('hidden', true);
        menuItems.find('a').removeClass('admin__checkedItem');
        checkedSection.attr('hidden', false);

        localStorage.setItem('section_id', section_id);
    });
}


function sectionsOnLoad(){

    let section_id = localStorage.getItem('section_id');
    if (section_id == null) {
        section_id = 'usersSection';
    }

    let allSections = $('section');
    let checkedSection = $('#' + section_id);
    let checkedMenuItem = $('[data-sectionid='+section_id+']').find('a');

    allSections.attr('hidden', true);
    checkedSection.attr('hidden', false);
    checkedMenuItem.addClass('admin__checkedItem');

}