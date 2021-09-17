function deleteFriend(event,friend_id) {
    event.preventDefault();
    document.getElementById('deleteFriend-'+friend_id).submit();
}