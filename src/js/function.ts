///<reference path="./../../node_modules/@types/jquery/index.d.ts" />


namespace BattleShip{
    export function shot(x:number , y:number ) :void{
        console.log("("+x+","+y+")");
        
        let pagina = "/shot/";
        let datoObjeto ={  
                            "x" : x,
                            "y" : y
                        };
        $.ajax({
            type: 'POST',            
            url: pagina,
            dataType: "JSON",
            data : datoObjeto,
            async: true
        })                
        .done(function (obj):void {
            console.log(( obj ));
            
            if( obj[0].mensaje === 'AGUA'){
                let td = $('#enemy').find("td[id='"+ obj[0].shot[0]+obj[0].shot[1] +"']");
                td.attr('bgcolor',"#87ceeb");
                console.log(obj[0].mensaje+" en "+obj[0].shot[0]+","+obj[0].shot[1]);
            }else if( obj[0].mensaje === 'BARCO'){
                let td = $('#enemy').find("td[id='"+ obj[0].shot[0]+obj[0].shot[1] +"']");
                td.attr('bgcolor',"red");
                console.log(obj[0].mensaje+" en "+obj[0].shot[0]+","+obj[0].shot[1]);
            }
            if( obj[1].mensaje === 'AGUA'){
                let td = $('#player').find("td[id='"+ obj[1].shot[0]+obj[1].shot[1] +"']");
                td.attr('bgcolor',"#87ceeb");
                console.log(obj[1].mensaje+" en "+obj[1].shot[0]+","+obj[1].shot[1]);
            }else if( obj[1].mensaje === 'BARCO'){
                let td = $('#player').find("td[id='"+ obj[1].shot[0]+obj[1].shot[1] +"']");
                td.attr('bgcolor',"red");
                console.log(obj[1].mensaje+" en "+obj[1].shot[0]+","+obj[1].shot[1]);
            }
            
            if( (obj[0].mensaje !== 'AGUA' && obj[0].mensaje !== 'BARCO') ){ 
                alert( obj[0].mensaje );
            }else if( obj[1].mensaje !== 'AGUA' && obj[1].mensaje !== 'BARCO'){
                alert( obj[1].mensaje );
            }
                  
        })
        .fail(function (jqXHR:any, textStatus:any, errorThrown:any) {
            alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
        }); 
    
    }

}
