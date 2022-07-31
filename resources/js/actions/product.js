export default {
    init: function () {
        GSCommon.makeParentOf(this);
        this.initListeners('product', {
            update: 'submit'
        });
    },

    actionUpdate: function ($form) {
        GSCommon.clearFormErrors();

        $.ajax({
            type: 'post',
            url: $form.attr('action'), 
            data: $form.serializeArray(),
            dataType: 'json',
            cache: false,
            beforeSend: function() {
                $('.loading').show();
            },
            complete: function() {
                $('.loading').hide();
            }
        }).done(function (response) {
            
            if(response.success == true) {
                $('#persik').html(response.html);
            }

        }).fail(GSCommon.processFailResponse);
        
    }
};