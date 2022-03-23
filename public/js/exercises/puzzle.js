$('.puzzle__letter').click(function(){
    let letterWrap = $(this);
    let dropzone = $('.puzzle__wrapper:visible').find('.puzzle__dropzone:empty').first();

    if (dropzone.length !== 0) {
        dropzone.html(letterWrap.clone());
        letterWrap.html('');
        letterWrap.attr('id', '');
        letterWrap.css('pointer-events', 'none');
    }

    //if user entered all letters
    let dropzones = $('.puzzle__wrapper:visible').find('.puzzle__dropzone:empty');
    if (dropzones.length === 0){
        checkWord();
    }

});

$('.puzzle__dropzone').click(function(){
    let letterWrap = $(this).children();
    let dropzone = $('.puzzle__letters-wrapper:visible').find('.puzzle__letter:empty').first();

    letterWrap.detach();
    dropzone.html(letterWrap.html());
    dropzone.attr('id', letterWrap.attr('id'));
    dropzone.css('pointer-events', 'auto');
});

function checkWord() {
    let translate = $('.puzzle__wrapper:visible').find('input[name="translate"]').val();
    let correctLetters = translate.toLowerCase().split('');
    let isCorrect = true;
    let i = 0;

    $('.puzzle__dropzone:visible').each(function(){
        let id = $(this).find('.puzzle__letter').attr('id');

        if(correctLetters[i] != id.replace(/[0-9]/g, '')){
            isCorrect = false;
            $(this).css('background-color', '#f55343');
        } else {
            $(this).css({'background-color': '#47c56a', 'pointer-events': 'none'});
        }
        i++;
    });

    //if entered word is correct
    if(isCorrect){
        nextPuzzleWord();
    }

}

function nextPuzzleWord(){
    let index = $('.puzzle__wrapper:visible').find('input[name="index"]').val();
    let currentZone = $('input[name="index"][value="'+ index + '"]').parent();
    let nextZone = $('input[name="index"][value="'+ (+index+1)+ '"]').parent();

    setTimeout(function() {

        if(nextZone.length !== 0){
            currentZone.attr('hidden', true);
            nextZone.attr('hidden', false);
        } else {
            $('#puzzleForm').submit();
        }

    }, 2000);
}
