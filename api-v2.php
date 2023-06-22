<?php
// include "debug.php";

//impostiamo l'header che avvisa del contenuto json
// header('Content-Type: application/json');

function newTask($text = "", $done = false) {
    return [
        'text' => '',
        'done' => false
    ];
}

function checkData($index) {

    //bisognerebbe anche controllare che a quell'indice
    //esista un oggetto con la proprietà done

    return isset($index) && $index>=0;
}

//leggiamo il contenuto del file json. todoList è una stringa json
$todoList = file_get_contents("dati.json");

//Con chiamata GET (quella iniziale), non entriamo qui dentro
if( isset($_POST['action']) ) {
    $action = $_POST['action'];
    $index = isset($_POST['index']) ? $_POST['index'] : null;
    $text = isset($_POST['text']) ? $_POST['text'] : null;
    
    //creiamo array php decodificando il json (deserializzazione)
    //ricordate il booleano a true se usate degli array associativi (!!!)
    $todoListDati = json_decode($todoList, true);

    if( $action == "create" ) {

        $todoListDati[] = newTask( $_POST['newTask'] );

    } else if( $action == "toggle" && checkData($index) ) {

        $todoListDati[$index]['done'] = !$todoListDati[$index]['done'];

    }  else if( $action == "update" && checkData($index) ) {

        if(isset($text) && strlen($text)) {
            $todoListDati[$index]['text'] = $nuovoTesto;
        }

    } else if( $action == "delete" && checkData($index) ) {

        array_splice($todoListDati, $index, 1);

    } else if( $action == "delete-all" ) {

        // debugga("Array iniziale", $todoListDati);
        $todoListDati = [];

    } 
    
    //serializziamo il nostro array PHP come una stringa JSON
    //sovrascriviamo la vecchia stringa con una nuova, con dati aggiornati
    $todoList = json_encode($todoListDati);

    //scriviamo il nuovo json su file
    // file_put_contents("dati.json", $todoList );

}

//restituiamo il JSON a chi ci ha chiamato
echo $todoList;

?>