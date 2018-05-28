/*
 * Copyright (c) 2017 BrainActs Commerce OÜ, All rights reserved.
 * See LICENSE.txt for license details.
 */
define(
    [
        'jquery',
        'ko',
        'uiComponent',
        'Magento_Checkout/js/model/quote',
        'BrainActs_RewardPoints/js/action/set-reward-points',
        'Magento_Checkout/js/model/totals',
        'mage/translate',
        'jquery/ui'
    ],
    function ($, ko, Component, quote, setRewardPointsAction, totals, $t) {
        'use strict';

        var totals = quote.getTotals(),
            rewardPoints = ko.observable(null),
            isApplied = ko.observable(rewardPoints() != null),
            isVisible  = ko.observable(null);

        if (totals()) {
            var value = parseInt(window.checkoutConfig.reward.selected_points);
            rewardPoints(value);
            isVisible(window.checkoutConfig.reward.is_visible);
        }

        return Component.extend(
            {
                defaults: {
                    template: 'BrainActs_RewardPoints/checkout/payment/reward-points'
                },

                rewardPoints: rewardPoints,

                /**
                 * Applied flag
                 */
                isApplied: isApplied,

                isVisible: isVisible,

                /**
                 * RP application procedure
                 */
                apply: function () {
                    if($("#reward-points").val() <= window.checkoutConfig.reward.available_points*0.20){

                        if (this.validate()) {
                            setRewardPointsAction(rewardPoints(), isApplied);
                        }
                    }else{
                        window.alert("Error: you can spend maximum "+ Math.round(window.checkoutConfig.reward.available_points*20)/100 +" point(s)");
                    }

                },

                /**
                 * Points form validation
                 *
                 * @returns {Boolean}
                 */
                validate: function () {
                    var form = '#reward-points-form';

                    return $(form).validation() && $(form).validation('isValid');
                },

                initSlider: function () {
                    var maxValue = Math.round(window.checkoutConfig.reward.available_points*20)/100,
                    value = 0;//parseInt(window.checkoutConfig.reward.selected_points);
					setRewardPointsAction(0, isApplied);
                    $("#reward-slider").slider(
                        {
                            classes: {
                                "ui-slider": "highlight"
                            },
                            range: "max",
                            min: 0,
                            max: maxValue,
                            value: value,
                            slide: function (event, ui) {
                                $("#reward-points").val(ui.value);
                                rewardPoints(ui.value);
                            },
                            stop: function (event, ui) {

                            }
                        }
                    );
                    $("#reward-points").val(value);
                },


                getCurrentPointsText: function(){
                    return $.mage.__('You have %1 point(s). You can spend maximum %2 point(s).')
                        .replace('%1', window.checkoutConfig.reward.max_points)
                        .replace('%2',Math.round(window.checkoutConfig.reward.available_points*20)/100);
                    //return $t('You have %1 points.(%2)', 1,2);
                }
            }
        );
    }
);
