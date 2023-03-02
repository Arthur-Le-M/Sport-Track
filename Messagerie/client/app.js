var conn = new WebSocket('ws://193.55.218.254:8080');

conn.onopen = function(e) {
    console.log("Connection ouvert!");
};

conn.onmessage = function(e) {
    //Récupération du JSON
    var data = JSON.parse(e.data);
    //Ajouter le message en html sur la page
};

conn.onclose = function(e) {
    console.log("Connection fermé!");
}

function leaveChat(){

    $.ajax({
        url:"action.php",
        method:"post",
        data: "userId="+userId+"&action=leave"
    }).done(function(result){
        var data = JSON.parse(result);
        if(data.status == 1) {
            conn.close();
            location = "index.php";
        } else {
            console.log(data.msg);
        }		
    });
}