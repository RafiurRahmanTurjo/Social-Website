$(document).ready(function() {
        $('.post h2').click(function() {
            var username = $(this).text().trim();
            window.location.href = '../view/profile.php?username=' + username;
        });

        $('.likebutton').click(function() {
            var postId = $(this).data('post-id');
            alert('You liked post with ID: ' + postId);
        });
    });