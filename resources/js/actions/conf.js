export default {
    init: function () {
        GSCommon.makeParentOf(this);
        this.initListeners('conf', {
            update: 'submit',
            click: 'submit',
        });
    },

    actionUpdate: function ($form) {
        GSCommon.clearFormErrors();
        $.ajax({
            type: 'delete',
            url: '/configurations/myproductsDeleteAll', 
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            cache: false,
        }).done(function (response) {
            console.log(response);
        }).fail(GSCommon.processFailResponse);
    },

    actionClick: function ($form) {
        GSCommon.clearFormErrors();

        $.ajax({
            type: 'delete',
            url: '/logs/myproductsDeleteAll', 
            data: $form.serializeArray(),
            dataType: 'json',
            cache: false,
        }).done(function (response) {
            console.log(response);
        }).fail(GSCommon.processFailResponse);
    }

};