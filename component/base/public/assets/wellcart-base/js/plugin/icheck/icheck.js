/*! iCheck v2.0.0 rc1 - http://git.io/arlzeA, (c) Damir Sultanov - http://fronteed.com */
(function (r, x, m) {
    r.ichecked || (r.ichecked = function () {
        m = r.jQuery || r.Zepto;
        var A = {
            autoInit: !0,
            autoAjax: !1,
            tap: !0,
            checkboxClass: "icheckbox",
            radioClass: "iradio",
            checkedClass: "checked",
            disabledClass: "disabled",
            indeterminateClass: "indeterminate",
            hoverClass: "hover",
            callbacks: {ifCreated: !1},
            classes: {base: "icheck", div: "#-item", area: "#-area-", input: "#-input", label: "#-label"}
        };
        r.icheck = m.extend(A, r.icheck);
        var l = r.navigator.userAgent, ca = /MSIE [5-8]/.test(l) || 9 > x.documentMode, D = /Opera Mini/.test(l), E = A.classes.base,
            O = A.classes.div.replace("#", E), da = A.classes.area.replace("#", E), P = A.classes.input.replace("#", E), Q = A.classes.label.replace("#", E);
        delete A.classes;
        var ea = {}, p = {}, la = new RegExp(E + "\\[(.*?)\\]"), I = function (a, c, e) {
            a && (c = la.exec(a)) && p[c[1]] && (e = c[1]);
            return e
        }, fa = r.getComputedStyle, X = r.PointerEvent || r.MSPointerEvent, y = "ontouchend" in r, F = /mobile|tablet|phone|ip(ad|od)|android|silk|webos/i.test(l), l = ["mouse", "down", "up", "over", "out"], u = r.PointerEvent ? ["pointer", l[1], l[2], l[3], l[4]] : ["MSPointer", "Down",
            "Up", "Over", "Out"], R = ["touch", "start", "end"], S = y && F || X, T = S ? y ? R[0] + R[1] : u[0] + u[3] : l[0] + l[3], Y = S ? y ? R[0] + R[2] : u[0] + u[4] : l[0] + l[4], M = S ? y ? !1 : u[0] + u[1] : l[0] + l[1], Z = S ? y ? !1 : u[0] + u[2] : l[0] + l[2], l = D ? "" : T + ".i " + Y + ".i ", u = !D && M ? M + ".i " + Z + ".i" : "", J, U, ga = !1 !== A.areaStyle ? 'position:absolute;display:block;content:"";top:#;bottom:#;left:#;right:#;' : 0, V = function (a, c, e) {
            J || (J = x.createElement("style"), (x.head || x.getElementsByTagName("head")[0]).appendChild(J), r.createPopup || J.appendChild(x.createTextNode("")), U = J.sheet ||
                J.styleSheet);
            c || (c = "div." + (e ? da + e + ":after" : O + " input." + P));
            a = a.replace(/!/g, " !important");
            U.addRule ? U.addRule(c, a, 0) : U.insertRule(c + "{" + a + "}", 0)
        };
        V("position:absolute!;display:block!;outline:none!;" + (A.debug ? "" : "opacity:0!;z-index:-99!;clip:rect(0 0 0 0)!;"));
        (y && F || D) && V("cursor:pointer!;", "label." + Q + ",div." + O);
        V("display:none!", "iframe.icheck-frame");
        var G = function (a, c, e, b, f, d, k) {
            if (b = a.className)return f = " " + b + " ", 1 === e ? d = c : 0 === e ? k = c : (d = c[0], k = c[1]), d && 0 > f.indexOf(" " + d + " ") && (f += d + " "), k && ~f.indexOf(" " +
                k + " ") && (f = f.replace(" " + k + " ", " ")), f = f.replace(/^\s+|\s+$/g, ""), f !== b && (a.className = f), f
        }, ha = function (a, c, e, b, f, d) {
            p[c] && (b = p[c], f = b.className, d = m(K(a, "div", f)), d.length && (m(a).removeClass(P + " " + f).attr("style", b.style), m("label." + b.esc).removeClass(Q + " " + f), m(d).replaceWith(m(a)), e && N(a, c, e)), p[c] = !1)
        }, ia = function (a, c, e, b, f) {
            e = [];
            for (b = a.length; b--;)if (c = a[b], c.type)~"input[type=checkbox],input[type=radio]".indexOf(c.type) && e.push(c); else for (c = m(c).find("input[type=checkbox],input[type=radio]"),
                                                                                                                                               f = c.length; f--;)e.push(c[f]);
            return e
        }, K = function (a, c, e, b) {
            for (; a && 9 !== a.nodeType;)if ((a = a.parentNode) && a.tagName == c.toUpperCase() && ~a.className.indexOf(e)) {
                b = a;
                break
            }
            return b
        }, N = function (a, c, e) {
            e = "if" + e;
            if (p[c].callbacks && !1 !== p[c].callbacks[e] && (m(a).trigger(e), "function" == typeof p[c].callbacks[e]))p[c].callbacks[e](a, p[c])
        }, ja = function (a, c, e, b) {
            a = ia(a);
            for (var f = a.length; f--;) {
                var d = a[f], k = d.attributes, l = {}, g = k.length, h, n, u = {}, y = {}, t, q = d.id, w = d.className, z, D = d.type, aa = m.cache ? m.cache[d[m.expando]] :
                    0, B = I(w), L, v, C = "", H = !1;
                v = [];
                for (var F = r.FastClick ? " needsclick" : ""; g--;)h = k[g].name, n = k[g].value, ~h.indexOf("data-") && (u[h.substr(5)] = n), "style" == h && (z = n), l[h] = n;
                aa && aa.data && (u = m.extend(u, aa.data));
                for (t in u) {
                    n = u[t];
                    if ("true" == n || "false" == n)n = "true" == n;
                    y[t.replace(/checkbox|radio|class|id|label/g, function (a, b) {
                        return 0 === b ? a : a.charAt(0).toUpperCase() + a.slice(1)
                    })] = n
                }
                k = m.extend({}, A, r.icheck, y, c);
                g = k.handle;
                "checkbox" !== g && "radio" !== g && (g = "input[type=checkbox],input[type=radio]");
                if (!1 !== k.init && ~g.indexOf(D)) {
                    for (B && ha(d, B); !p[B];)if (B = Math.random().toString(36).substr(2, 5), !p[B]) {
                        L = E + "[" + B + "]";
                        break
                    }
                    delete k.autoInit;
                    delete k.autoAjax;
                    k.style = z || "";
                    k.className = L;
                    k.esc = L.replace(/(\[|\])/g, "\\$1");
                    p[B] = k;
                    if (g = K(d, "label", ""))!g.htmlFor && q && (g.htmlFor = q), v.push(g);
                    if (q)for (h = m('label[for="' + q + '"]'); h.length--;)q = h[h.length], q !== g && v.push(q);
                    for (n = v.length; n--;)q = v[n], h = q.className, h = (g = I(h)) ? G(q, E + "[" + g + "]", 0) : (h ? h + " " : "") + Q, q.className = h + " " + L + F;
                    v = x.createElement("div");
                    if (k.inherit)for (q =
                                           k.inherit.split(/\s*,\s*/), h = q.length; h--;)g = q[h], void 0 !== l[g] && ("class" == g ? C += l[g] + " " : v.setAttribute(g, "id" == g ? E + "-" + l[g] : l[g]));
                    C += k[D + "Class"];
                    C += " " + O + " " + L;
                    k.area && ga && (H = ("" + k.area).replace(/%|px|em|\+|-/g, "") | 0) && (ea[H] || (V(ga.replace(/#/g, "-" + H + "%"), !1, H), ea[H] = !0), C += " " + da + H);
                    v.className = C + F;
                    d.className = (w ? w + " " : "") + P + " " + L;
                    d.parentNode.replaceChild(v, d);
                    v.appendChild(d);
                    k.insert && m(v).append(k.insert);
                    H && (l = fa ? fa(v, null).getPropertyValue("position") : v.currentStyle.position, "static" ==
                    l && (v.style.position = "relative"));
                    W(d, v, B, "updated", !0, !1, e);
                    p[B].done = !0;
                    b || N(d, B, "Created")
                }
            }
        }, W = function (a, c, e, b, f, d, k) {
            var m = p[e], g = {}, h = {};
            g.checked = [a.checked, "Checked", "Unchecked"];
            d && !k || "click" === b || (g.disabled = [a.disabled, "Disabled", "Enabled"], g.indeterminate = ["true" == a.getAttribute("indeterminate") || !!a.indeterminate, "Indeterminate", "Determinate"]);
            "updated" == b || "click" == b ? (h.checked = d ? !g.checked[0] : g.checked[0], d && !k || "click" === b || (h.disabled = g.disabled[0], h.indeterminate = g.indeterminate[0])) :
                "checked" == b || "unchecked" == b ? h.checked = "checked" == b : "disabled" == b || "enabled" == b ? h.disabled = "disabled" == b : "indeterminate" == b || "determinate" == b ? h.indeterminate = "determinate" !== b : h.checked = !g.checked[0];
            ka(a, c, g, h, e, m, b, f, d, k)
        }, ka = function (a, c, e, b, f, d, k, l, g, h, n) {
            var r = a.type, u = "radio" == r ? "Radio" : "Checkbox", t, q, w, z, y, x, B, A, v, C;
            c || (c = K(a, "div", d.className));
            if (c) {
                for (t in b)if (q = b[t], e[t][0] !== q && "updated" !== k && "click" !== k && (a[t] = q), h && (q ? a.setAttribute(t, t) : a.removeAttribute(t)), d[t] !== q) {
                    d[t] = q;
                    v = !0;
                    if ("checked" == t && (C = !0, !n && q && (p[f].done || h) && "radio" == r && a.name))for (z = K(a, "form", ""), w = 'input[name="' + a.name + '"]', w = z && !h ? m(z).find(w) : m(w), z = w.length; z--;)y = w[z], x = I(y.className), a !== y && p[x] && p[x].checked && (B = {checked: [!0, "Checked", "Unchecked"]}, A = {checked: !1}, ka(y, !1, B, A, x, p[x], "updated", l, g, h, !0));
                    w = [d[t + "Class"], d[t + u + "Class"], d[e[t][1] + "Class"], d[e[t][1] + u + "Class"], d[t + "LabelClass"]];
                    z = [w[3] || w[2], w[1] || w[0]];
                    q && z.reverse();
                    G(c, z);
                    if (d.mirror && w[4])for (z = m("label." + d.esc); z.length--;)G(z[z.length],
                        w[4], q ? 1 : 0);
                    l && !n || N(a, f, e[t][q ? 1 : 2])
                }
                if (!l || n)v && N(a, f, "Changed"), C && N(a, f, "Toggled");
                d.cursor && !F && (d.disabled || d.pointer ? d.disabled && d.pointer && (c.style.cursor = "default", d.pointer = !1) : (c.style.cursor = "pointer", d.pointer = !0));
                p[f] = d
            }
        };
        m.fn.icheck = function (a, c) {
            if (/^(checked|unchecked|indeterminate|determinate|disabled|enabled|updated|toggle|destroy|data|styler)$/.test(a))for (var e = ia(this), b = e.length; b--;) {
                var f = e[b], d = I(f.className);
                if (d) {
                    if ("data" == a)return p[d];
                    if ("styler" == a)return K(f, "div",
                        p[d].className);
                    "destroy" == a ? ha(f, d, "Destroyed") : W(f, !1, d, a);
                    "function" == typeof c && c(f)
                }
            } else"object" != typeof a && a || ja(this, a || {});
            return this
        };
        var ba;
        m(x).on("click.i " + l + u, "label." + Q + ",div." + O, function (a) {
            var c = this, e = I(c.className);
            if (e) {
                var b = a.type, f = p[e], d = f.esc, e = "DIV" == c.tagName, k, l, g, h, n = [["label", f.activeLabelClass, f.hoverLabelClass], ["div", f.activeClass, f.hoverClass]];
                e && n.reverse();
                if (b == M || b == Z) {
                    n[0][1] && G(c, n[0][1], b == M ? 1 : 0);
                    if (f.mirror && n[1][1])for (g = m(n[1][0] + "." + d); g.length--;)G(g[g.length],
                        n[1][1], b == M ? 1 : 0);
                    e && b == Z && f.tap && F && X && !D && (h = !0)
                } else if (b == T || b == Y) {
                    n[0][2] && G(c, n[0][2], b == T ? 1 : 0);
                    if (f.mirror && n[1][2])for (g = m(n[1][0] + "." + d); g.length--;)G(g[g.length], n[1][2], b == T ? 1 : 0);
                    e && b == Y && f.tap && F && y && !D && (h = !0)
                } else e && (F && (y || X) && f.tap && !D || (h = !0));
                h && setTimeout(function () {
                    l = a.currentTarget || {};
                    "LABEL" !== l.tagName && (!f.change || 100 < +new Date - f.change) && (k = m(c).find("input." + d).click(), (ca || D) && k.change())
                }, 2)
            }
        }).on("click.i change.i focusin.i focusout.i keyup.i keydown.i", "input." + P, function (a) {
            var c =
                I(this.className);
            if (c) {
                var e = a.type, b = p[c], f = b.esc, d = "click" == e ? !1 : K(this, "div", b.className);
                if ("click" == e)p[c].change = +new Date, a.stopPropagation(); else if ("change" == e)d && !this.disabled && W(this, d, c, "click"); else if (~e.indexOf("focus")) {
                    if (a = [b.focusClass, b.focusLabelClass], a[0] && d && G(d, a[0], "focusin" == e ? 1 : 0), b.mirror && a[1])for (b = m("label." + f); b.length--;)G(b[b.length], a[1], "focusin" == e ? 1 : 0)
                } else d && !this.disabled && ("keyup" == e ? (("checkbox" == this.type && 32 == a.keyCode && b.keydown || "radio" == this.type && !this.checked) && W(this, d, c, "click", !1, !0), p[c].keydown = !1, p[ba] && (p[ba].keydown = !1)) : (ba = c, p[c].keydown = !0))
            }
        }).ready(function () {
            r.icheck.autoInit && m("." + E).icheck();
            if (r.jQuery) {
                var a = x.body || x.getElementsByTagName("body")[0];
                m.ajaxSetup({
                    converters: {
                        "text html": function (c) {
                            if (r.icheck.autoAjax && a) {
                                var e = x.createElement("iframe"), b;
                                ca || (e.style = "display:none");
                                e.className = "iframe.icheck-frame";
                                e.src = "about:blank";
                                a.appendChild(e);
                                b = e.contentDocument ? e.contentDocument : e.contentWindow.document;
                                b.open();
                                b.write(c);
                                b.close();
                                a.removeChild(e);
                                b = m(b);
                                ja(b.find("." + E), {}, !0);
                                b = b[0];
                                c = (b.body || b.getElementsByTagName("body")[0]).innerHTML
                            }
                            return c
                        }
                    }
                })
            }
        })
    }, "function" == typeof define && define.amd ? define("icheck", [r.jQuery ? "jquery" : "zepto"], r.ichecked) : r.ichecked())
})(window, document);