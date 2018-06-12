define([
        'jquery',
        'ko',
        'Magento_Ui/js/modal/modal',
        'jquery/ui',
        'mage/translate'
    ], function ($, ko, modal) {
        'use strict';

        return function (config) {
            var self = this;
            self.sku = config.sku;
            self.getApiUrl = function () {
                var baseUrl = config.baseUrl;
                var index = baseUrl.indexOf("index.php/");
                if (index > 0) {
                    baseUrl = baseUrl.substring(0, index);
                }

                return baseUrl + 'rest/V1/price/request/email/' + $('#price_request_email').val() + '/name/' + $('#price_request_name').val() + '/comment/' + $('#price_request_comment').val() + '/sku/' + self.sku;
            };

            self.sendData = function () {
                $.ajax(
                    {
                        type: "GET",
                        url: self.getApiUrl(),
                        contentType: "application/json",
                        dataType: "json",
                        success: function (response) {
                            response = JSON.parse(response);
                            if (response.success) {
                                $('#request-success-messages').append(
                                    '<div class="message-success success message" data-ui-id="message-success">' +
                                    '<div>' + response.message + '</div>' +
                                    '</div>'
                                );
                            } else {
                                $('#request-error-messages').append(
                                    '<div class="message-error error message" data-ui-id="message-error">' +
                                    '<div>' + response.message + '</div>' +
                                    '</div>'
                                );
                            }
                        },
                        error: function (response) {
                            $('#request-error-messages').append(
                                '<div class="message-error error message" data-ui-id="message-error">' +
                                '<div>' + $.mage.__('Something went wrong.') + '</div>' +
                                '</div>'
                            );
                        }
                    }
                );
            };

            $('#product-price-request-button').click(function () {
                $form.trigger("reset");
                $form.modal('openModal');
                $("#request-error-messages").html('');
                $("#request-success-messages").html('');
            });

            var $form = $('#popup-modal');
            var options = {
                type: 'popup',
                responsive: true,
                innerScroll: true,
                title: $.mage.__('Request Price'),
                buttons: [{
                    text: $.mage.__('Send'),
                    class: 'primary payment',
                    click: function () {
                        if ($form.valid()) {
                            self.sendData();
                        }
                    }
                }
                ]
            };

            var popup = modal(options, $form);
        }
    }
);