/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Require actions
 */

require('./actions/category').default.init();
require('./actions/manufacturer').default.init();
require('./actions/subcategory').default.init();
require('./actions/product').default.init();
require('./actions/search').default.init();
require('./actions/logs').default.init();
require('./actions/conf').default.init();



function offsetAnchor() {
    if (location.hash.length !== 0) {
        window.scrollTo(window.scrollX, window.scrollY - 100);
    }
}

$(document).on('click', 'a[href^="#"]', function(event) {
    window.setTimeout(function() {
        offsetAnchor();
    }, 0);
});

window.setTimeout(offsetAnchor, 0);


/* Vue JS configurations */

window.Vue = require('vue');
import VueRouter from 'vue-router';
 
// if (window.Vue) {
//   window.Vue.use(VueRouter);
// }
 
Vue.component('menu-component', require('./components/MenuComponent.vue').default);
Vue.component('parse-component', require('./components/ParseComponent.vue').default);
 
const routes = []
const router = new VueRouter({ routes })

const app = new Vue({
    routes
}).$mount('#app')


/* Finish Vue JS configurations */

$(document).on('click', '.delete-item', function () {
    let changeStatusBtn = $(this),
        route = $(this).data('url');

    changeStatusBtn.attr('disabled', true);

    BootstrapDialog.confirm({
        title: 'Are you sure ?',
        message: 'You will can not restore that item !',
        type: BootstrapDialog.TYPE_DANGER,
        closable: true,
        btnCancelLabel: 'Cancel',
        closeByBackdrop: false,
        closeByKeyboard: false,
        btnOKLabel: 'Yes, remove',
        btnOKClass: 'btn-danger',
        callback: function(result) {
            if(result) {
                $.ajax({
                    type: 'DELETE',
                    url: route,
                    dataType: 'JSON'
                }).done(function(response) {
                    console.log(response);
                    $.notify(response.message, 'success');
                    window.location.reload();
                })
                .fail(GSCommon.processFailResponse);
            }
        },
        onhide: function(){
            changeStatusBtn.attr('disabled', false);
        }
    });
});

$(document).on('click', '.check-input', function () {
    if ($(this).hasClass('list-input') && !$('.list .row-item').length) {
        return;
    }

    if (!$(this).closest('div').find('input').is(':checked')){
        $(this).closest('div').find('input').attr('checked', true);
    } else {
        $(this).closest('div').find('input').attr('checked', false);
    }
});

$(document).on('click', '.list-input', function () {
    let checkboxList = $('.list').find('.check-input');

    if (checkboxList.length) {
        let checkListState = false;
        if (!$(this).closest('div').find('input').is(':checked')){
            checkListState = true;
        }

        checkboxList.each((index, element) => {
            $(element).find('input').attr('checked', !checkListState);
        });
    }

    GSCommon.checkForUnviewed();
});

$(document).on('click', '.row-input', function () {
    GSCommon.checkForUnviewed($(this));
});

$('.mark-selected-as-viewed').on('click', function () {
    let checkboxList = $('.list').find('.check-input input:checked');

    let checkedItemsIds = [];
    if (checkboxList.length) {
        checkboxList.each((index, element) => {
            checkedItemsIds.push($($(element).find('input').prevObject[0]).val());
        });
    }

    $(this).attr('disabled', true);

    $.ajax({
        type: 'PUT',
        url: $(this).data('url'),
        data: {
            'type': $(this).data('type'),
            'items': checkedItemsIds,
        },
        dataType: 'JSON'
    }).done(function(response) {
        console.log(response);
        // $.notify(response.message, 'success');
        window.location.reload();
    })
    .fail(GSCommon.processFailResponse)
    .always(() => {
        $(this).attr('disabled', false);
    });
});


