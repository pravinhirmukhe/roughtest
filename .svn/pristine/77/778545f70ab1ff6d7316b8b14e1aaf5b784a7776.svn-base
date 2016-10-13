/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

app.filter('startFrom', function () {
    return function (input, start) {
        if (!input || !input.length) {
            return;
        }
        start = +start; //parse to int
        return input.slice(start);
    };
});
app.filter('shortname', function ($sce) {
    return function (input, size) {
        $v = input;
        if ($v.length > size) {
            $v = $v.substr(0, size) + "...<br> <a href='#' data-toggle='modal' class='pull-right' data-target='.modalUpdatedNews'>Read More</a>";
        }
        return $sce.trustAsHtml($v);
    }
});
app.filter('splitme', function ($sce) {
    return function (input) {
        $v = input;
        if ($v) {
            $v = $v.split(",");
            $str = "";
            for (i = 0; i < $v.length; i++) {
                if ($v[i].trim() != "")
                    $str += "<li>" + $v[i].trim() + "</li>";
            }
            return $sce.trustAsHtml($str);
        } else {
            return input;
        }
    }
});
app.filter('shortdesc', function ($sce) {
    return function (input, size) {
        $v = input;
        if ($v.length > size) {
            $v = $v.substr(0, size) + "...";
        }
        return $sce.trustAsHtml($v);
    }
});
app.filter('setmap', function ($sce) {
    return function (input) {
        $v = input;
        return $sce.trustAsResourceUrl('https://www.google.com/maps/embed/v1/place?q=' + encodeURI($v) + '&key=AIzaSyAE6TJ7w3I5CcQlFVUzO0v3k9af8NKvfA0');
    }
});
app.filter('noimage', function ($sce) {
    return function (input) {
        $v = input;
        $str = "";
        if ($v != "" && $v) {
            $str = res + "/" + $v;
        } else {
            $str = res + "/NOIMAGE.jpeg";
        }
        return $sce.trustAsHtml($str);
    }
});
app.directive("timer", ["$compile", function (a) {
        return{restrict: "EA", replace: !1, scope: {interval: "=interval", startTimeAttr: "=startTime", endTimeAttr: "=endTime", countdownattr: "=countdown", finishCallback: "&finishCallback", autoStart: "&autoStart", language: "@?", fallback: "@?", maxTimeUnit: "=", seconds: "=?", minutes: "=?", hours: "=?", days: "=?", months: "=?", years: "=?", secondsS: "=?", minutesS: "=?", hoursS: "=?", daysS: "=?", monthsS: "=?", yearsS: "=?"}, controller: ["$scope", "$element", "$attrs", "$timeout", "I18nService", "$interpolate", "progressBarService", function (b, c, d, e, f, g, h) {
                    function i() {
                        b.timeoutId && clearTimeout(b.timeoutId)
                    }
                    function j() {
                        var a = {};
                        void 0 !== d.startTime && (b.millis = moment().diff(moment(b.startTimeAttr))), a = k.getTimeUnits(b.millis), b.maxTimeUnit && "day" !== b.maxTimeUnit ? "second" === b.maxTimeUnit ? (b.seconds = Math.floor(b.millis / 1e3), b.minutes = 0, b.hours = 0, b.days = 0, b.months = 0, b.years = 0) : "minute" === b.maxTimeUnit ? (b.seconds = Math.floor(b.millis / 1e3 % 60), b.minutes = Math.floor(b.millis / 6e4), b.hours = 0, b.days = 0, b.months = 0, b.years = 0) : "hour" === b.maxTimeUnit ? (b.seconds = Math.floor(b.millis / 1e3 % 60), b.minutes = Math.floor(b.millis / 6e4 % 60), b.hours = Math.floor(b.millis / 36e5), b.days = 0, b.months = 0, b.years = 0) : "month" === b.maxTimeUnit ? (b.seconds = Math.floor(b.millis / 1e3 % 60), b.minutes = Math.floor(b.millis / 6e4 % 60), b.hours = Math.floor(b.millis / 36e5 % 24), b.days = Math.floor(b.millis / 36e5 / 24 % 30), b.months = Math.floor(b.millis / 36e5 / 24 / 30), b.years = 0) : "year" === b.maxTimeUnit && (b.seconds = Math.floor(b.millis / 1e3 % 60), b.minutes = Math.floor(b.millis / 6e4 % 60), b.hours = Math.floor(b.millis / 36e5 % 24), b.days = Math.floor(b.millis / 36e5 / 24 % 30), b.months = Math.floor(b.millis / 36e5 / 24 / 30 % 12), b.years = Math.floor(b.millis / 36e5 / 24 / 365)) : (b.seconds = Math.floor(b.millis / 1e3 % 60), b.minutes = Math.floor(b.millis / 6e4 % 60), b.hours = Math.floor(b.millis / 36e5 % 24), b.days = Math.floor(b.millis / 36e5 / 24), b.months = 0, b.years = 0), b.secondsS = 1 === b.seconds ? "" : "s", b.minutesS = 1 === b.minutes ? "" : "s", b.hoursS = 1 === b.hours ? "" : "s", b.daysS = 1 === b.days ? "" : "s", b.monthsS = 1 === b.months ? "" : "s", b.yearsS = 1 === b.years ? "" : "s", b.secondUnit = a.seconds, b.minuteUnit = a.minutes, b.hourUnit = a.hours, b.dayUnit = a.days, b.monthUnit = a.months, b.yearUnit = a.years, b.sseconds = b.seconds < 10 ? "0" + b.seconds : b.seconds, b.mminutes = b.minutes < 10 ? "0" + b.minutes : b.minutes, b.hhours = b.hours < 10 ? "0" + b.hours : b.hours, b.ddays = b.days < 10 ? "0" + b.days : b.days, b.mmonths = b.months < 10 ? "0" + b.months : b.months, b.yyears = b.years < 10 ? "0" + b.years : b.years
                    }
                    "function" != typeof String.prototype.trim && (String.prototype.trim = function () {
                        return this.replace(/^\s+|\s+$/g, "")
                    }), b.autoStart = d.autoStart || d.autostart, b.language = b.language || "en", b.fallback = b.fallback || "en", b.$watch("language", function (a) {
                        void 0 !== a && k.init(a, b.fallback)
                    });
                    var k = new f;
                    k.init(b.language, b.fallback), b.displayProgressBar = 0, b.displayProgressActive = "active", c.append(0 === c.html().trim().length ? a("<span>" + g.startSymbol() + "millis" + g.endSymbol() + "</span>")(b) : a(c.contents())(b)), b.startTime = null, b.endTime = null, b.timeoutId = null, b.countdown = angular.isNumber(b.countdownattr) && parseInt(b.countdownattr, 10) >= 0 ? parseInt(b.countdownattr, 10) : void 0, b.isRunning = !1, b.$on("timer-start", function () {
                        b.start()
                    }), b.$on("timer-resume", function () {
                        b.resume()
                    }), b.$on("timer-stop", function () {
                        b.stop()
                    }), b.$on("timer-clear", function () {
                        b.clear()
                    }), b.$on("timer-reset", function () {
                        b.reset()
                    }), b.$on("timer-set-countdown", function (a, c) {
                        b.countdown = c
                    }), b.$watch("startTimeAttr", function (a, c) {
                        a !== c && b.isRunning && b.start()
                    }), b.$watch("endTimeAttr", function (a, c) {
                        a !== c && b.isRunning && b.start()
                    }), b.start = c[0].start = function () {
                        b.startTime = b.startTimeAttr ? moment(b.startTimeAttr) : moment(), b.endTime = b.endTimeAttr ? moment(b.endTimeAttr) : null, angular.isNumber(b.countdown) || (b.countdown = angular.isNumber(b.countdownattr) && parseInt(b.countdownattr, 10) > 0 ? parseInt(b.countdownattr, 10) : void 0), i(), l(), b.isRunning = !0
                    }, b.resume = c[0].resume = function () {
                        i(), b.countdownattr && (b.countdown += 1), b.startTime = moment().diff(moment(b.stoppedTime).diff(moment(b.startTime))), l(), b.isRunning = !0
                    }, b.stop = b.pause = c[0].stop = c[0].pause = function () {
                        var a = b.timeoutId;
                        b.clear(), b.$emit("timer-stopped", {timeoutId: a, millis: b.millis, seconds: b.seconds, minutes: b.minutes, hours: b.hours, days: b.days})
                    }, b.clear = c[0].clear = function () {
                        b.stoppedTime = moment(), i(), b.timeoutId = null, b.isRunning = !1
                    }, b.reset = c[0].reset = function () {
                        b.startTime = b.startTimeAttr ? moment(b.startTimeAttr) : moment(), b.endTime = b.endTimeAttr ? moment(b.endTimeAttr) : null, b.countdown = angular.isNumber(b.countdownattr) && parseInt(b.countdownattr, 10) > 0 ? parseInt(b.countdownattr, 10) : void 0, i(), l(), b.isRunning = !1, b.clear()
                    }, c.bind("$destroy", function () {
                        i(), b.isRunning = !1
                    }), b.countdownattr ? (b.millis = 1e3 * b.countdownattr, b.addCDSeconds = c[0].addCDSeconds = function (a) {
                        b.countdown += a, b.$digest(), b.isRunning || b.start()
                    }, b.$on("timer-add-cd-seconds", function (a, c) {
                        e(function () {
                            b.addCDSeconds(c)
                        })
                    }), b.$on("timer-set-countdown-seconds", function (a, c) {
                        b.isRunning || b.clear(), b.countdown = c, b.millis = 1e3 * c, j()
                    })) : b.millis = 0, j();
                    var l = function m() {
                        var a = null;
                        b.millis = moment().diff(b.startTime);
                        var d = b.millis % 1e3;
                        return b.endTimeAttr && (a = b.endTimeAttr, b.millis = moment(b.endTime).diff(moment()), d = b.interval - b.millis % 1e3), b.countdownattr && (a = b.countdownattr, b.millis = 1e3 * b.countdown), b.millis < 0 ? (b.stop(), b.millis = 0, j(), void(b.finishCallback && b.$eval(b.finishCallback))) : (j(), b.timeoutId = setTimeout(function () {
                            m(), b.$digest()
                        }, b.interval - d), b.$emit("timer-tick", {timeoutId: b.timeoutId, millis: b.millis, timerElement: c[0]}), b.countdown > 0 ? b.countdown-- : b.countdown <= 0 && (b.stop(), b.finishCallback && b.$eval(b.finishCallback)), void(null !== a && (b.progressBar = h.calculateProgressBar(b.startTime, b.millis, b.endTime, b.countdownattr), 100 === b.progressBar && (b.displayProgressActive = ""))))
                    };
                    (void 0 === b.autoStart || b.autoStart === !0) && b.start()
                }]}
    }]);
"undefined" != typeof module && "undefined" != typeof exports && module.exports === exports && (module.exports = timerModule);
app.factory("I18nService", function () {
    var a = function () {
    };
    return a.prototype.language = "en", a.prototype.fallback = "en", a.prototype.timeHumanizer = {}, a.prototype.init = function (a, b) {
        var c = humanizeDuration.getSupportedLanguages();
        this.fallback = void 0 !== b ? b : "en", -1 === c.indexOf(b) && (this.fallback = "en"), this.language = a, -1 === c.indexOf(a) && (this.language = this.fallback), moment.locale(this.language), this.timeHumanizer = humanizeDuration.humanizer({language: this.language, halfUnit: !1})
    }, a.prototype.getTimeUnits = function (a) {
        var b = 1e3 * Math.round(a / 1e3), c = {};
        return"undefined" != typeof this.timeHumanizer ? c = {millis: this.timeHumanizer(b, {units: ["milliseconds"]}), seconds: this.timeHumanizer(b, {units: ["seconds"]}), minutes: this.timeHumanizer(b, {units: ["minutes", "seconds"]}), hours: this.timeHumanizer(b, {units: ["hours", "minutes", "seconds"]}), days: this.timeHumanizer(b, {units: ["days", "hours", "minutes", "seconds"]}), months: this.timeHumanizer(b, {units: ["months", "days", "hours", "minutes", "seconds"]}), years: this.timeHumanizer(b, {units: ["years", "months", "days", "hours", "minutes", "seconds"]})} : console.error('i18nService has not been initialized. You must call i18nService.init("en") for example'), c
    }, a
});
app.factory("progressBarService", function () {
    var a = function () {
    };
    return a.prototype.calculateProgressBar = function (a, b, c, d) {
        var e, f, g = 0;
        return b /= 1e3, null !== c ? (e = moment(c), f = e.diff(a, "seconds"), g = 100 * b / f) : g = 100 * b / d, g = 100 - g, g = Math.round(10 * g) / 10, g > 100 && (g = 100), g
    }, new a
});

(function () {

    var UNITS = {
        year: 31557600000,
        month: 2629800000,
        week: 604800000,
        day: 86400000,
        hour: 3600000,
        minute: 60000,
        second: 1000,
        millisecond: 1
    };

    var languages = {
        en: {
            year: function (c) {
                return "year" + ((c !== 1) ? "s" : "");
            },
            month: function (c) {
                return "month" + ((c !== 1) ? "s" : "");
            },
            week: function (c) {
                return "week" + ((c !== 1) ? "s" : "");
            },
            day: function (c) {
                return "day" + ((c !== 1) ? "s" : "");
            },
            hour: function (c) {
                return "hour" + ((c !== 1) ? "s" : "");
            },
            minute: function (c) {
                return "minute" + ((c !== 1) ? "s" : "");
            },
            second: function (c) {
                return "second" + ((c !== 1) ? "s" : "");
            },
            millisecond: function (c) {
                return "millisecond" + ((c !== 1) ? "s" : "");
            }
        },
    };

    // You can create a humanizer, which returns a function with defaults
    // parameters.
    function humanizer(passedOptions) {

        var result = function humanizer(ms, humanizerOptions) {
            var options = extend({}, result, humanizerOptions || {});
            return doHumanization(ms, options);
        };

        return extend(result, {
            language: "en",
            delimiter: ", ",
            spacer: " ",
            units: ["year", "month", "week", "day", "hour", "minute", "second"],
            languages: {},
            halfUnit: true,
            round: false
        }, passedOptions);

    }

    // The main function is just a wrapper around a default humanizer.
    var defaultHumanizer = humanizer({});
    function humanizeDuration() {
        return defaultHumanizer.apply(defaultHumanizer, arguments);
    }

    // doHumanization does the bulk of the work.
    function doHumanization(ms, options) {

        // Make sure we have a positive number.
        // Has the nice sideffect of turning Number objects into primitives.
        ms = Math.abs(ms);

        if (ms === 0) {
            return "0";
        }

        var dictionary = options.languages[options.language] || languages[options.language];
        if (!dictionary) {
            throw new Error("No language " + dictionary + ".");
        }

        var result = [];

        // Start at the top and keep removing units, bit by bit.
        var unitName, unitMS, unitCount, mightBeHalfUnit;
        for (var i = 0, len = options.units.length; i < len; i++) {

            unitName = options.units[i];
            if (unitName[unitName.length - 1] === "s") { // strip plurals
                unitName = unitName.substring(0, unitName.length - 1);
            }
            unitMS = UNITS[unitName];

            // If it's a half-unit interval, we're done.
            if (result.length === 0 && options.halfUnit) {
                mightBeHalfUnit = (ms / unitMS) * 2;
                if (mightBeHalfUnit === Math.floor(mightBeHalfUnit)) {
                    return render(mightBeHalfUnit / 2, unitName, dictionary, options.spacer);
                }
            }

            // What's the number of full units we can fit?
            if ((i + 1) === len) {
                unitCount = ms / unitMS;
                if (options.round) {
                    unitCount = Math.round(unitCount);
                }
            } else {
                unitCount = Math.floor(ms / unitMS);
            }

            // Add the string.
            if (unitCount) {
                result.push(render(unitCount, unitName, dictionary, options.spacer));
            }

            // Remove what we just figured out.
            ms -= unitCount * unitMS;

        }

        return result.join(options.delimiter);

    }

    function render(count, type, dictionary, spacer) {
        var dictionaryValue = dictionary[type];
        var word;
        if (typeof dictionaryValue === "function") {
            word = dictionaryValue(count);
        } else {
            word = dictionaryValue;
        }
        return count + spacer + word;
    }

    function extend(destination) {
        var source;
        for (var i = 1; i < arguments.length; i++) {
            source = arguments[i];
            for (var prop in source) {
                if (source.hasOwnProperty(prop)) {
                    destination[prop] = source[prop];
                }
            }
        }
        return destination;
    }

    // Internal helper function for Polish language.


    // Internal helper function for Russian language.


    function getSupportedLanguages() {
        var result = [];
        for (var language in languages) {
            if (languages.hasOwnProperty(language)) {
                result.push(language);
            }
        }
        return result;
    }

    humanizeDuration.humanizer = humanizer;
    humanizeDuration.getSupportedLanguages = getSupportedLanguages;

    if (typeof define === "function" && define.amd) {
        define(function () {
            return humanizeDuration;
        });
    } else if (typeof module !== "undefined" && module.exports) {
        module.exports = humanizeDuration;
    } else {
        this.humanizeDuration = humanizeDuration;
    }
})();
