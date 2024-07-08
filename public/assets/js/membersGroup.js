//create group
$(document).ready(function() {
    let memberIds = [];

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

//update group

$(document).ready(function() {
    let memberIds = [];

    $('#groupList li').each(function() {
        memberIds.push($(this).data('id'));
    });
    $('#memberIds').val(memberIds.join(','));

    $('#userList').on('click', 'li', function() {
        const userId = $(this).data('id');
        const userName = $(this).data('name');

        if ($('#groupList li[data-id="' + userId + '"]').length === 0) {
            $('#groupList').append('<li data-id="' + userId + '"><i class="fas fa-user"></i>' + userName + '</li>');
            memberIds.push(userId);
            $('#memberIds').val(memberIds.join(','));
            $(this).remove();
        }
    });

    $('#groupList').on('click', 'li', function() {
        const userId = $(this).data('id');
        const userName = $(this).data('name');

        if ($('#userList li[data-id="' + userId + '"]').length === 0) {
            $('#userList').append('<li data-id="' + userId + '" data-name="' + userName + '"><i class="fas fa-user"></i>' + userName + ' <i class="fas fa-comment-dots ml-auto"></i></li>');
            memberIds = memberIds.filter(id => id !== userId);
            $('#memberIds').val(memberIds.join(','));
            $(this).remove();
        }
    });
});

