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
                }
            }
        );
    });
    $('.listing_delete').on('click', function(e){
        e.preventDefault();
        if (confirm('Σίγουρα θέλετε να διαγράψετε την αγγελία;')){
            //Yes
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
                        $('.row [data-listing-id='+id+']').remove();
                    }
                }
            );
        }
    });
  
});