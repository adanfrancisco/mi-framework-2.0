///<reference path="../libs/index.d.ts"/>

export function shot(x:number , y:number ) :void{
    let pagina = "battleShip/";
    let datoObjeto ={  
                        "x" : x,
                        "y" : y
                    };                
    $.ajax({
        type: 'GET',            
        url: pagina,
        dataType: "json",
        data : datoObjeto,
        async: true
    })                
    .done(function (obj):void {
        console.log("todo bien");                    
    })
    .fail(function (jqXHR:any, textStatus:any, errorThrown:any) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });
}
