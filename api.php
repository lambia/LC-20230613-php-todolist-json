<?php
// include "debug.php";

//impostiamo l'header che avvisa del contenuto json
header('Content-Type: application/json');

//leggiamo il contenuto del file json. todoList è una stringa json
$todoList = file_get_contents("dati.json");

//volendo potremmo già stampare il JSON in alterato con echo $todoList;

//nel caso volessimo lavorare i dati
//creiamo array php decodificando il json (deserializzazione)
//ricordate il booleano a true se usate degli array associativi (!!!)
$todoListDati = json_decode($todoList, true);

//possiamo usare l'array come un normalissimo array php
// $todoListDati[] = "ulteriore dato";
// $todoListDati[4] = "sostituto";

if( isset($_POST['newTask']) ) {

    $nuovaTask = [
        'text' => $_POST['newTask'],
        'done' => false
    ];

    $todoListDati[] = $nuovaTask;

    file_put_contents("dati.json", json_encode($todoListDati) );

} else if( isset($_POST['toggleIndex']) ) {
    
    $indice = $_POST['toggleIndex'];

    $todoListDati[$indice]['done'] = !$todoListDati[$indice]['done'];

    file_put_contents("dati.json", json_encode($todoListDati) );

} else if( isset($_POST['editText']) ) {
    
    $nuovoTesto = $_POST['editText'];

    $todoListDati[$indice]['text'] = $nuovoTesto;

    file_put_contents("dati.json", json_encode($todoListDati) );

} else if( isset($_POST['deleteAll']) ) {

    $todoListDati = [];

    file_put_contents("dati.json", json_encode($todoListDati) );

} else if( isset($_POST['deleteIndex'] )) {

    $indice = $_POST['deleteIndex'];

    // debugga("Array iniziale", $todoListDati);

    array_splice($todoListDati, $indice, 1);

    file_put_contents("dati.json", json_encode($todoListDati) );

}

//serializziamo il nostro array PHP come una stringa JSON
//sovrascriviamo la vecchia stringa con una nuova, con dati aggiornati
$todoList = json_encode($todoListDati);

//restituiamo il JSON a chi ci ha chiamato
echo $todoList;

?>