    function likePost(postId) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../Controller/like.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                document.getElementById("like_form_" + postId).innerHTML = xhr.responseText;
            }
        };
        xhr.send("like_post=" + postId);
        return false;
    }
