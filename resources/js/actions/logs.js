export default {
    init: function () {
        GSCommon.makeParentOf(this);
        this.initListeners('logs', {
            delete: 'submit'
        });
    },

    actionDelete: function ($form) {
        GSCommon.clearFormErrors();

        $.ajax({
            type: 'delete',
            dataType: "json",
            cache: false,
        }).done(function (response) {
            console.log(response);
        }).fail(GSCommon.processFailResponse);
        
    }
};