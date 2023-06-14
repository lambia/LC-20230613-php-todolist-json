const { createApp } = Vue;

createApp({

    data() {
        return {
            apiUrl: "api.php",
            todoList: [],
            newTask: ""
        }
    },
    mounted() {
        this.getDati();
    },
    methods: {
        getTextClass(item) {
            let classObj = {
                'text-decoration-line-through': item.done
            };
            return classObj;
        },
        getDati() {
            //Faccio una chiamata ad un API specificata nel data
            axios.get(this.apiUrl).then((response) => {
                console.log("Dati ricevuti: ", response.data);
                this.todoList = response.data;
            });
        },
        addNewTask() {
            const data = { newTask: this.newTask };

            this.sendData(data);
        },
        toggleStatus(i) {
            const data = { toggleIndex: i };

            this.sendData(data);
        },
        deleteItem(i) {
            console.log("Hai cliccato sull'item", i);

            const data = { deleteIndex: i };

            this.sendData(data);
        },
        deleteAllTasks() {
            const data = { deleteAll: true };

            this.sendData(data);
        },
        sendData(data) {
            //Faccio una chiamata POST ad apiUrl, passando il data
            axios.post(this.apiUrl, data, {
                headers: { 'Content-Type': 'multipart/form-data' }
            }).then((response) => {
                console.log("Dati ricevuti: ", response.data);
                this.todoList = response.data;
                this.newTask = "";
            });
        }
    }

}).mount("#app");