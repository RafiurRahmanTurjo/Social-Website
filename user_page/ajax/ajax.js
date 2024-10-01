$(document).ready(function(){
    $('#fetchUserForm').submit(function(event) {
      event.preventDefault(); 
      
      var username = $('#username').val(); 
      fetchUser(username);
    });
    
    function fetchUser(username) {
  
    $.ajax({
      url: '../model/search.php',
      method: 'GET',
      data: {
      
        username: username,
      },
      success: function(response) {

        $('#userDetails').html(response);
      },
      error: function(xhr, status, error) {
        console.error('Error fetching user:', error);
      }
    });
}
});