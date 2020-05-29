$(document).ready(function(){
    /*var rows = document.getElementById("tabella").rows;
    for (i = 0; i < rows.length; i++) {
        rows[i].onclick = function(){ return function(){
               var id = this.cells[0].innerHTML; //id = nome dell'attività
               var indirizzo = this.cells[2].innerHTML;
               alert("id:" + id);

$(document).ready(function(){
    /*var rows = document.getElementById("tabella").rows;
               alert("indirizzo: "+ indirizzo) */
               //var IDUtenteNonAutenticato = '1';
               var citta = 'Roma';
               var ajaxRequest =$.ajax({
                    type:'POST',
                    url:'dati_elenco.php',
                    dataType:'json',
                    data:{citta:citta} });

               
                ajaxRequest.done(function(return_data){
                if(return_data.success){

                    //codice
                    var trHTML = '';
                    trHTML = "<table class='table' id='tabella'>"
                                    + "<tr>" 
                                        + "<th scope='col'>Nome</th>"
                                        + "<th scope='col'>tipo</th>"
                                        + "<th scope='col'>indirizzo</th>"
                                        + "<th scope='col'>Attesa</th>"
                                    + "</tr>";
                        $.each(return_data.data, function (i,item) {
                            trHTML += '<tr><td>' + item[0]
                                + '</td><td>' + item[1]
                                + '</td><td>' + item[2]
                                + '</td><td>' + item[3]
                                + '</td></tr>'; 
                        });
                        trHTML += "</table>";

                        $('#tabella').append(trHTML);
                    
                    
                }
                else{
                    alert(return_data.posted);
                    }
            });
            ajaxRequest.fail(function(return_data){
                alert("Errore con il server, riprovare!");
            });
            

      /*  };}(rows[i]);
    

window.onload = addRowHandlers();  */
});

