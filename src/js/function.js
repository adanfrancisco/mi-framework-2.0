"use strict";
///<reference path="./../../node_modules/@types/jquery/index.d.ts" />
var BattleShip;
(function (BattleShip) {
    function shot(x, y) {
        console.log("(" + x + "," + y + ")");
        var pagina = "/shot/";
        var datoObjeto = {
            "x": x,
            "y": y
        };
        $.ajax({
            type: 'POST',
            url: pagina,
            dataType: "JSON",
            data: datoObjeto,
            async: true
        })
            .done(function (obj) {
            console.log((obj));
            if (obj[0].mensaje === 'AGUA') {
                var td = $('#enemy').find("td[id='" + obj[0].shot[0] + obj[0].shot[1] + "']");
                td.attr('bgcolor', "#87ceeb");
                console.log(obj[0].mensaje + " en " + obj[0].shot[0] + "," + obj[0].shot[1]);
            }
            else if (obj[0].mensaje === 'BARCO') {
                var td = $('#enemy').find("td[id='" + obj[0].shot[0] + obj[0].shot[1] + "']");
                td.attr('bgcolor', "red");
                console.log(obj[0].mensaje + " en " + obj[0].shot[0] + "," + obj[0].shot[1]);
            }
            if (obj[1].mensaje === 'AGUA') {
                var td = $('#player').find("td[id='" + obj[1].shot[0] + obj[1].shot[1] + "']");
                td.attr('bgcolor', "#87ceeb");
                console.log(obj[1].mensaje + " en " + obj[1].shot[0] + "," + obj[1].shot[1]);
            }
            else if (obj[1].mensaje === 'BARCO') {
                var td = $('#player').find("td[id='" + obj[1].shot[0] + obj[1].shot[1] + "']");
                td.attr('bgcolor', "red");
                console.log(obj[1].mensaje + " en " + obj[1].shot[0] + "," + obj[1].shot[1]);
            }
            if ((obj[0].mensaje !== 'AGUA' && obj[0].mensaje !== 'BARCO')) {
                alert(obj[0].mensaje);
            }
            else if (obj[1].mensaje !== 'AGUA' && obj[1].mensaje !== 'BARCO') {
                alert(obj[1].mensaje);
            }
        })
            .fail(function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
        });
    }
    BattleShip.shot = shot;
})(BattleShip || (BattleShip = {}));
//# sourceMappingURL=function.js.map