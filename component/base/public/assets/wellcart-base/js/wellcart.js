/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
;
(function () {
    'use strict';
    var WellCart = {
        VERSION: '0.1.0',
        url: function (url) {
            if (!url) {
                return url;
            }

            // If it's a non relative URL, return it.
            if (url.indexOf('http') === 0) return url;

            var u = (ENV.baseUrl === undefined ? "/" : ENV.baseUrl);
            if (u[u.length - 1] === '/') {
                u = u.substring(0, u.length - 1);
            }
            if (url.indexOf(u) !== -1) return url;

            if (u.length > 0 && url[0] !== "/") {
                // we got to root this
                url = "/" + url;
            }

            return u + url;
        },

        /**
         * Generates a URL based on a route
         *
         * @param  string route name
         * @param  object params Parameters to use in url generation, if any
         */
        urlToRoute: function (routeName, params) {
            var route = null;
            for (var key in  ENV.routes) {
                if (key == routeName) {
                    route = ENV.routes[routeName];
                    break;
                }
            }

            if (typeof route === 'null') {
                route = '/';
            }
            if (typeof params === 'object') {
                for (var key in params) {
                    var val = params[key];
                    route = route.replace(":" + key, val);
                }
            }
            return WellCart.url(route);
        },

        /**
         * Method handling redirects and page refresh
         * @param {String} url - redirect URL
         * @param {(undefined|String)} type - 'assign', 'reload', 'replace'
         * @param {(undefined|Number)} timeout - timeout in milliseconds before processing the redirect or reload
         * @param {(undefined|Boolean)} forced - true|false used for 'reload' only
         */
        redirect: function (url, type, timeout, forced) {
            var _redirect;

            forced = !!forced;
            timeout = timeout || 0;
            type = type || 'assign';

            _redirect = function () {
                window.location[type](type === 'reload' ? forced : url);
            };

            timeout ? setTimeout(_redirect, timeout) : _redirect();
        },

        /**
         * Serializes and sends data via POST request.
         *
         * @param {Object} options -
         *      Options object that consists of
         *      a 'url' and 'data' properties.
         */
        submit: function (options) {
            var form = document.createElement('form'),
                data = this.serialize(options.data),
                field;

            form.setAttribute('action', options.url);
            form.setAttribute('method', 'post');

            _.each(data, function (value, name) {
                field = document.createElement('input');

                field.setAttribute('name', name);
                field.setAttribute('type', 'hidden');

                field.value = value;

                form.appendChild(field);
            });

            document.body.appendChild(form);

            form.submit();
        }
    };

    window.WellCart = WellCart;
    return WellCart;
})();