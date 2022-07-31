export default {
    init: function () {
        GSCommon.makeParentOf(this);
        this.initListeners('search', {
            update: 'submit'
        });
    },

    actionUpdate: function ($form) {
        GSCommon.clearFormErrors();

        var search_txt = $('#search').val();


        if($.trim(search_txt) != '') {
            $.ajax({
                type: 'post',
                url: $form.attr('action'), 
                data: $form.serializeArray(),
                dataType: 'json',
                cache: false,
            }).done(function (response) {

                if(response.success == true) {
                    $('tbody').replaceWith(response.html);
                    $('#total').replaceWith(response.total);
                    $("#search_btn").attr("disabled", true); 
                }

            }).fail(GSCommon.processFailResponse);
        } else {
            location.reload();
        } 

        
    }
};