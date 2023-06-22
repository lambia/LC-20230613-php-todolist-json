const { createApp } = Vue;

createApp({

    data() {
        return {
            // apiUrl: "api.php",
            apiUrl: "api-v2.php",
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
            const data = { action: "create", text: this.newTask };
            this.sendData(data);
        },
        editTask(i, $event) {
            const data = { action: "update", index: i, text: $event.target.value };
            this.sendData(data);
        },
        toggleStatus(i) {
            const data = { action: "toggle", index: i };
            this.sendData(data);
        },
        deleteItem(i) {
            const data = { action: "delete", index: i };
            this.sendData(data);
        },

        deleteAllTasks() {
            const data = { action: "delete-all" };

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