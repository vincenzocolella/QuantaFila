function addRowHandlers() {
    var rows = document.getElementById("tabella").rows;
    for (i = 0; i < rows.length; i++) {
        rows[i].onclick = function(){ return function(){
               var id = this.cells[0].innerHTML; //id = nome dell'attività
               var indirizzo = this.cells[2].innerHTML;
               alert("id:" + id);
               alert("indirizzo: "+ indirizzo)
               var ajaxRequest =$.ajax({
                    type:'POST',
                    url:'/dati_elenco.php',
                    dataType:'json',
                    data:{idutentenonautenticato:idutentenonautenticato}
                });
                ajaxRequest.done(function(return_data){
                if(return_data.success){
                    alert("Dati recuperati correttamente");
                }
                else{
                    alert(return_data.posted);
                }
            });
            ajaxRequest.fail(function(return_data){
                alert("Errore con il server, riprovare!");
            });
        };}(rows[i]);
    
}
window.onload = addRowHandlers();
};