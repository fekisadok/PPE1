$(document).ready(function() {
    var blnScroll = true;
    getMessage ();


    $('[data-confirm]').on('click', function (e) {
        e.preventDefault(); //Annuler l'action par défaut

        //Récupérer la valeur de l'attribut href
        var href = $(this).attr('href');

        //Récupérer la valeur de l'attribut data-confirm
         var message = $(this).data('confirm');

        //Afficher la popup SweetAlert
        swal({
            title: "Êtes-vous sûr?",
            text: message, //Utiliser la valeur de data-confirm comme text
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "Annuler",
            confirmButtonText: "Oui",
            confirmButtonColor: "#DD6B55"
        }, function (isConfirm) {
            if (isConfirm) {
                //Si l'utilisateur clique sur Oui,
                //Il faudra le rediriger l'utilisateur vers la page
                //de suppression
                window.location.href = href;
            }
        });
    });
    var url = 'ajax/search.php'
    $('#searchbox').on('keyup', function(){
        var query = $(this).val();

        if (query.length>0) {
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    query: query
                },
                success: function (data) {
                    $("#display-results").html(data).show();

                }
            });
        }else{
            $("#display-results").hide();
        }
    });

    $('#btn-chat').click (function(){
        var url = 'ajax/tchat.php';
        var message = $('#btn-input').val();
        var id_sender = $(this).data('id_sender');
        var id_receiver = $(this).data('id_receiver');
        if (message != ''){
            $.ajax({
                type:'POST',
                url:url,
                data : {
                    id_sender : id_sender,
                    id_receiver: id_receiver,
                    message : message
                },
                success: function(){
                    getMessage();
                    $('#btn-input').val('');

                }
            });
        };
    });

    function getMessage () {
        $.post('ajax/recup_tchat.php', function (data) {
            $('.msg_container_base').html(data);
            if (blnScroll) {
                document.getElementById("content_msg").scrollTop = document.getElementById("content_msg").scrollHeight;
            }

        });
    }

    function getMessageInbox () {
        $.post('ajax/recup_tchat_inbox.php', function (data) {
            $('.chat_area').html(data);
            // if (blnScroll) {
            //     document.getElementById("content_msg").scrollTop = document.getElementById("content_msg").scrollHeight;
            // }

        });
    }

    setInterval(getMessage, 1000);
    setInterval(getMessageInbox, 1000);
});

$(document).on('click', '.panel-heading span.icon_minim', function (e) {
    var $this = $(this);
    if (!$this.hasClass('panel-collapsed')) {
        $this.parents('.panel').find('.panel-body').slideUp();
        $this.addClass('panel-collapsed');
        $this.removeClass('glyphicon-minus').addClass('glyphicon-plus');
    } else {
        $this.parents('.panel').find('.panel-body').slideDown();
        $this.removeClass('panel-collapsed');
        $this.removeClass('glyphicon-plus').addClass('glyphicon-minus');
    }
});
$(document).on('focus', '.panel-footer input.chat_input', function (e) {
    var $this = $(this);
    if ($('#minim_chat_window').hasClass('panel-collapsed')) {
        $this.parents('.panel').find('.panel-body').slideDown();
        $('#minim_chat_window').removeClass('panel-collapsed');
        $('#minim_chat_window').removeClass('glyphicon-plus').addClass('glyphicon-minus');
    }
});
// $(document).on('click', '#new_chat', function (e) {
//     var size = $( "#chat_window_1" ).css("margin-left");
//     alert(size);
//     size_total = parseInt(size) - 400;
//     alert(size_total);
//     var clone = $( "#chat_window_1" ).clone().appendTo( ".container" );
//     clone.css("margin-left", size_total);
// });
$(document).on('click', '.icon_close', function (e) {
    //$(this).parent().parent().parent().parent().remove();
    $( "#chat_window_1" ).remove();
});
