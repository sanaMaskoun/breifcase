

$(document).ready(function() {
    let memberIds = $('#groupList li').map(function() {
        return $(this).data('id');
    }).get();

    $('#memberIds').val(memberIds.join(','));

    $('.user-list-create-group li').click(function() {
        const userId = $(this).data('id');
        const userName = $(this).data('name');

        if ($('#groupList li[data-id="' + userId + '"]').length === 0) {
            $('#groupList').append('<li data-id="' + userId + '"><i class="fas fa-user"></i>' + userName + '</li>');
            memberIds.push(userId);
            $('#memberIds').val(memberIds.join(','));
        }
    });

    $('#groupList').on('click', 'li', function() {
        const userId = $(this).data('id');
        $(this).remove();
        memberIds = memberIds.filter(id => id !== userId);
        $('#memberIds').val(memberIds.join(','));
    });
});



