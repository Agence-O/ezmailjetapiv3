$(function() {
    function subscribe(){
        $( "#ezmailjetapiv3_subscribe form" ).submit(function( event ) {
            event.preventDefault();
            event.stopPropagation();

            var email = $("#ezmailjetapiv3_subscribe_email").val();

            $.get(
                "mailjet/inscription/"+email,
                {},
                function( data ) {
                    console.log(data);

                    $('#ezmailjetapiv3_subscribe p').html( data.message );
                    $('#ezmailjetapiv3_subscribe_email').val("");
                }
            );
            return false;
        });
    };
    subscribe();
});