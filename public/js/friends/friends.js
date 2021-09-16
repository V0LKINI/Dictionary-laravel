var csrf_token = $('meta[name="csrf-token"]').attr('content');

function deleteFriend(event, friend_id) {
    event.preventDefault();

    let url = '/friends/id' + friend_id;
    $.ajax({
        url: url,
        method: 'delete',
        dataType: 'html',
        data: {friend_id: friend_id},
        headers: {
            'X-CSRF-TOKEN': csrf_token
        }
    });
}