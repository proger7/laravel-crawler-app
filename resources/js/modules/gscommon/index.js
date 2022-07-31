window.GSCommon = {
    fiatCurrency: 'USD',
    cryptoCurrency: 'BTC',
    btnSubmitHtml: '',
    makeParentOf: function (child) {
        for (let item in this) {
            child[item] = this[item];
        }
    },
    initListeners: function (namespace, exceptions) {
        let self = this;
        exceptions = exceptions || {};

        for (let method in self) {
            if (typeof self[method] !== 'function' || method.indexOf('action') === -1) continue;
            let actionName = method.replace('action', '');
            actionName = actionName.charAt(0).toLowerCase() + actionName.substr(1, actionName.length - 1);

            let exception = exceptions[actionName] ? exceptions[actionName] : false,
                eventName = 'click.gs',
                preventDefault = true;

            if (exception !== false) {
                if (typeof exception === 'object') {
                    eventName = exception['eventName'] + '.gs';
                    preventDefault = exception['preventDefault'];
                } else {
                    eventName = exception + '.gs';
                }
            }

            let selector = '.js-' + namespace + '-' + actionName;
            let handler = function (e) {
                if (preventDefault) {
                    e.preventDefault();
                }

                self[method]($(this), e);
            };

            // use event namespace ".gs" to off all attached before events.. and then attache events again (to not attach an event twice)
            $(document).off('.gs', selector);
            $(document).on(eventName, selector, handler);
        }
    },
    modal: {
        list: {},
        show: function (params) {
            let self = this;
            if (!params || !params.url) throw new Error('Params are required, and param.url is required!');

            if (params.actionElement) params.actionElement.attr('disabled', true);

            return $.ajax({
                type: params.type || 'GET',
                url: params.url,
                loader: true,
                data: params.data
            }).then(function (data) {
                let jsonResponse = false;

                try {
                    jsonResponse = JSON.parse(data);
                } catch (err) {}

                if (jsonResponse) {
                    return $.notify(jsonResponse);
                }

                if (params.unievedType) {
                    $.ajax({
                        type: 'GET',
                        url: '/admin/unviewed/count',
                        data: {
                            type: params.unievedType
                        },
                        dataType: 'json'
                    }).then(function (response) {
                        GSCommon.initModal(self, params, data, response);
                    });
                } else {
                    GSCommon.initModal(self, params, data);
                }

            }).fail(GSCommon.processFailResponse);
        }
    },
    initModal(modalInstance, params, data, additionalData = {}) {
        modalInstance.list[params.name || +(new Date)] = BootstrapDialog.show({
            title: params.title,
            size: params.size || BootstrapDialog.SIZE_NORMAL,
            type: params.dialogType || BootstrapDialog.TYPE_PRIMARY,
            closeByBackdrop: false,
            closeByKeyboard: false,
            onshow: params.onshow,
            onshown: function (d) {
                d.getModalDialog().data('modal', d); // can be accessed by $('.modal-dialog').data('modal')
                d.setMessage($(data));
                $('.modal').scroll(function () {
                    $(this).modal('adjustBackdrop');
                }).removeAttr('tabindex');

                params.onshown && params.onshown(d, additionalData);
            },
            onhide: function() {
                if (params.actionElement) params.actionElement.attr('disabled', false);
            },
            buttons: params.buttons
        });
    },
    processFailResponse: function (error) {
        if (error['responseJSON']['message'] && !error['responseJSON']['errors']) {
            return $.notify(error['responseJSON']['message'], 'error');
        }

        let errorsList = error['responseJSON']['errors'];

        for (let _ in errorsList) {
            $.notify(errorsList[_], 'error');
        }
    },
    processFailFormResponse: function ($form) {
        return function (error) {
            GSCommon.clearFormErrors();

            let errorsList = error['responseJSON']['errors'],
                errorMessage = error['responseJSON']['message'];

            for (let _ in errorsList) {
                let fieldWasFound = false;
                $('input, select', $form).each(function (index, element) {
                    let $field = $(element);

                    if ($field.attr('name') === _) {
                        $field.closest('.form-group').addClass('has-error');
                        $field.closest('.form-group').append(`<small class="error-message help-block">` + errorsList[_] + `</small>`);

                        fieldWasFound = true;
                    }
                }).promise().done( function(){
                    if (!fieldWasFound) {
                        $.notify(errorsList[_], 'error');
                    }
                });
            }

            if (errorMessage) {
                $.notify(errorMessage, 'error');

                setTimeout(() => { document.location.reload() }, 2000);
            }
        };
    },
    clearFormErrors: function () {
        $('.has-error').removeClass('has-error');
        let errorMessages = $('.error-message');

        if (errorMessages.length) {
            errorMessages.each(function (index, element) {
                $(element).remove();
            })
        }
    },
    getParameterByName(name) {
        let match = RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);
        return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
    },
    convertToCrypto($value, $type) {
        if ($type === 'BTC') {
            return this.formatBitcoin($value);
        }

        if ($type === 'ETH') {
            return this.formatEthereum($value);
        }
    },
    formSubmitStart($form) {
        let btnSubmit = $form.find('button[type="submit"]');

        this.btnSubmitHtml = btnSubmit.html();

        btnSubmit.html('<i class="fas fa-spinner fa-spin"></i> ' + btnSubmit.text());
        btnSubmit.attr('disabled', true);
    },
    formSubmitEnd($form) {
        let btnSubmit = $form.find('button[type="submit"]');

        btnSubmit.html(this.btnSubmitHtml);
        btnSubmit.attr('disabled', false);
    },
    formatBitcoin($value) {
        return $value.toFixed(8);
    },
    formatEthereum($value) {
        return $value.toFixed(18);
    },
    checkForUnviewed(element) {
        let markSelectedAsViewed = $('.mark-selected-as-viewed');

        if (element) {
            if (element.closest('tr').hasClass('item-unviewed')) {
                markSelectedAsViewed.addClass('active-element');
            }
        } else {
            if ($('.list').find('.item-unviewed').length) {
                markSelectedAsViewed.addClass('active-element');
            } else {
                markSelectedAsViewed.removeClass('active-element');
            }
        }

        if(!$('.check-input input:checked').length) {
            markSelectedAsViewed.removeClass('active-element');
        }
    }
}

