// script.js

function updateCount(numChasse, action)
{
    var nbRencontreElement = document.getElementById('nbRencontre_' + numChasse);
    var displayElement = document.getElementById('displayNbRencontre_' + numChasse);

    var currentValue = parseInt(nbRencontreElement.value);
    var newValue = (action === '+') ? currentValue + 1 : currentValue - 1;

    if (newValue >= 0)
    {
        // Mettez à jour les valeurs sans rechargement de la page
        nbRencontreElement.value = newValue;
        displayElement.innerHTML = newValue;

        // Utilisez AJAX pour envoyer la nouvelle valeur au serveur
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function ()
        {
            if (this.readyState == 4 && this.status == 200)
            {
                // La requête a réussi, vous pouvez effectuer des actions supplémentaires si nécessaire
                console.log("La mise à jour a réussi !");
            }
        };
        
        // Préparez les données à envoyer
        var params = "numChasse=" + numChasse + "&newValue=" + newValue;

        // Ouvrez et envoyez la requête POST
        xhttp.open("POST", "updateCount.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(params);
    }
}
