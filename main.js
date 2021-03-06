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
                else{
                    location.reload();
                }
                
            }
        );
    });

    //Handle user logout
    $('#btn_logout').on('click', function(e){
        e.preventDefault();
        $.post('ajax-handler.php',
        {type: 'logout'},
            function(data, status){
                location.reload();
            }
        );
    });

    //Handle listing form submit
    $('#listing_form').on('submit', function(e){
        e.preventDefault();
        $.post('ajax-handler.php',
            $('#listing_form').serialize(),
            function(data, status){
                data = JSON.parse(data);
                if (data['error']){
                    alert(data['error']);
                }
                else{
                    //append listing to list
                    var l = $("#listing_template").clone(true, true);
                    l.attr('id', ' ');
                    l.attr('data-listing-id', data['id']);
                    l.find('.listing_text').text(data['string']);
                    l.find('.listing_delete').attr('data-listing-id', data['id']);
                    l.show();
                    l.appendTo('#listings_col');
                    $('#listing_form').closest('form').find("input[type=text]").val("");
                    //Hide the no listings message
                    $('#no_listings_msg').hide();
                }
            }
        );
    });

    //Handle listing delete
    $('.listing_delete').on('click', function(e){
        e.preventDefault();
        var id = $(this).attr('data-listing-id');
        $.post('ajax-handler.php',
            {type: 'listing_delete', id: id},
            function(data, status){
                data = JSON.parse(data);
                if (data['error']){
                    alert(data['error']);
                }
                else{
                    //delete listing from list
                    alert('?? ?????????????? ???????????????????? ???? ????????????????');
                    $('.row [data-listing-id='+id+']').remove();
                    //Check if there are any listings on display
                    if( $('.row [data-listing-id]').length <= 1 ){
                        $('#no_listings_msg').show();
                    }
                }
            }
        );
    });
  
});