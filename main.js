$(document).ready(function(){
    //Handle user login
    $('#login_form').on('submit', function(e){
        e.preventDefault();
        $.post('ajax-handler.php',
            $('#login_form').serialize(),
            function(data, status){
                data = JSON.parse(data);
                if (data['error']){
                    alert(data['error']);
                }
                location.reload();
            }
        );
    });
  
});