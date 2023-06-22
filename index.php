<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP + Vue</title>

    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <div id="app">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>ToDo List</h1>

                    <ul v-if="todoList.length">
                        <li v-for="(item, i) in todoList" class="my-2">
                            <span @click="deleteItem(i)" class="badge bg-danger p-2 me-2">
                                <i class="fa fa-trash"></i>
                            </span>
                            <span @click="toggleStatus(i)" :class="getTextClass(item)">{{ item.text }}</span>
                            <input @change="editTask(i, $event)" type="text" v-model="todoList[i].text" placeholder="Inserisci attività" >
                        </li>
                    </ul>
                    <h2 v-else>Nessun dato da visualizzare</h2>

                    <div class="input-group">
                        <input v-model="newTask" @keyup.enter="addNewTask" type="text" class="form-control" placeholder="Inserisci la nuova attività">
                        <button @click="addNewTask" class="btn btn-primary">Aggiungi</button>
                    </div>

                    <div class="input-group mt-4">
                        <button @click="deleteAllTasks" class="btn btn-secondary">Elimina tutti</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="./main.js"></script>

    <!-- Cosa succede se invece del tag script usassimo il tag div? -->
    <script>
    <?php
        $prova = 123;
        echo "console.log('Valore stampato da PHP: ', $prova);"
    ?>
    </script>

</body>

</html>