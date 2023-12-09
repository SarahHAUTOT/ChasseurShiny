function updateCount(numChasse, action)
{
    var nbRencontreElement = document.getElementById('nbRencontre_' + numChasse);
    var displayElement = document.getElementById('displayNbRencontre_' + numChasse);

    var currentValue = parseInt(nbRencontreElement.value);
    var newValue = (action === '+') ? currentValue + 1 : currentValue - 1;

    if (newValue >= 0)
    {
        nbRencontreElement.value = newValue;
        displayElement.innerHTML = newValue;

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function ()
        {
            if (this.readyState == 4 && this.status == 200)
            {
                console.log("La mise à jour a réussi !");
            }
        };
        
        var params = "numChasse=" + numChasse + "&newValue=" + newValue;

        xhttp.open("POST", "updateCount.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(params);
    }
}
