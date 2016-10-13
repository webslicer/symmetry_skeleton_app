/*
 * The MIT License (MIT)
 *
 * Copyright (c) 2015 Chuck de Sully
 * initialize with $.jsonBurst.options({url:'/receiving-endpoint'});
 * jQuery.jsonBurst(url [,data][,success])
 * url: string
 * data: plainObject
 * success: function(plainObject data); a callback function
 */
(function ($) {
    var opts;
    var intervalId = -1;
    var count = 0;//for key naming
    var paramVault = {};
    var promiseVault = {};
    var queueCount = 0;

    var Request = function (fxKey) {
        this.key = fxKey;
    };
    Request.prototype.abort = function () {
        if (paramVault[this.key] !== undefined) {
            delete paramVault[this.key];
        }
        if (promiseVault[this.key] !== undefined) {
            promiseVault[this.key].reject();
            delete promiseVault[this.key];
        }
    };
    Request.prototype.sendNow = function () {
        stopInterval();
        postJSON();
        startInterval();
        return this;
    };

    var postJSON = function () {
        if (queueCount > 0 && opts.url !== '') {
            var params = {};
            params[opts.sendName] = paramVault;
            paramVault = {};
            queueCount = 0;

            var currKeys = [];
            for (var key in params[opts.sendName]) {
                currKeys.push(key);
            }

            $.post(opts.url,
                    params,
                    function (data) {
                        var callbackArr = data[opts.callbackName];
                        for (var x in callbackArr) {
                            promiseVault[x].resolve(callbackArr[x]);
                            delete promiseVault[x];
                        }
                    },
                    'json').fail(
                    function () {
                        for (var x in currKeys) {
                            promiseVault[currKeys[x]].reject();
                            delete promiseVault[currKeys[x]];
                        }
                    }
            );
        }
    };

    var startInterval = function () {
        intervalId = setInterval(postJSON, opts.timeout);
    };

    var stopInterval = function () {
        clearInterval(intervalId);
        intervalId = -1;
    };

    $.jsonBurst = function (url, params, fx) {
        if ($.isFunction(params)) {
            fx = params;
            params = null;
        } else if (params === undefined) {
            params = null;
        }
        if (fx === undefined) {
            fx = null;
        }

        count++;
        if (count > 999999) {
            count = 0;
        }
        var fxKey = 'fx' + count;
        paramVault[fxKey] = {url: url, params: params};
        var deferred = $.Deferred();
        if (fx !== null) {
            deferred.done(fx);
        }
        promiseVault[fxKey] = deferred;
        var newRequest = new Request(fxKey);
        queueCount++;
        if (intervalId < 0) {
            startInterval();
        }
        return deferred.promise(newRequest);
    };
    $.jsonBurst.defaults = {
        'callbackName': 'callback',
        'sendName': 'jsonBurst',
        'timeout': 3000,
        'url': ''
    };
    opts = $.jsonBurst.defaults;

    $.jsonBurst.options = function (options) {
        opts = $.extend({}, $.jsonBurst.defaults, options);
        if (intervalId > 0) {
            stopInterval();
            if (queueCount > 0) {
                //resume if options were changed in the middle of a process
                startInterval();
            }
        }
    };
}(jQuery));