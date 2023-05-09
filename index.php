<?php
  session_start();
  if (!isset($_SESSION["user_id"])) {
    header("Location: ./login.html");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Zoznam úloh</title>
</head>
<body>
  <div id="app" class="container">
    <h1>Zoznam úloh</h1>
      <div class="d-flex">
        <div class="mr-1">
          <button @click="addTodo" class="btn btn-outline-primary">Pridaj ulohu</button>
        </div>
        <div class="">
          <input v-model="newTodo" class="form-control">
        </div>
        
      </div><hr>

    <h1>Ulohy</h1>
    <div v-for="todo in todos" :key="todo.id" class="todo-row">
      <div class="d-flex">
        <div class="pr-2">
          <button @click="deleteTodo(todo)"class="btn btn-outline-danger mr-1">X</button>
          <button @click="zmenHodnotu(todo)" class="btn btn-outline-success">Hotovo</button>
        </div>

        <div class="align-self-center">
          {{todo.todos}}
        </div>
        
        </div>
    </div>

    <hr>
    
    <h1>Hotove ulohy</h1>
    <div v-for="done in todosDone" :key="done.id" class="todo-row">
      <div class="d-flex">
        <div calss="ml-2">
          <button @click="deleteTodo(done)"class="btn btn-outline-danger mr-1">X</button>
          <button @click="zmenHodnotu(done)" class="btn btn-outline-warning">Nie je hotova</button>
        </div>
          <div class="align-self-center ml-2">

            {{done.todos}}
          </div>  
            
            
      </div>  
        
    </div>
    <form class="logout" action="./api/user/logout.php" method="GET">
      <button type="submit" class="btn btn-danger">Odhlasit</button>
    </form>
  </div>
</body>

<script src="./assets/js/vue.global.js"></script>
<script>
  const { createApp } = Vue

  createApp({
    data(){
    return{
      newTodo: '',
      datas: null,
      todos: null,
      todosDone: null
    }
 },
  methods:{
      
      getAll() {
        const request = new XMLHttpRequest();
        request.open('GET', "./api/todo/getAll.php")
        request.send()
        request.responseType = "json";
        request.onload = () => {
          if (request.readyState == 4 && request.status == 200) {
            this.datas = request.response;
            this.separateTodos();
          } else {
            console.log(`Error: ${request.status}`);
          }          
        };
      },

      separateTodos() {
        this.todos = this.datas.filter(todo => todo.doneTodo != '0');
        this.todosDone = this.datas.filter(todo => todo.doneTodo == '0');
        console.log('... ', this.todosX)
      },

      async addTodo() {
        await fetch("./api/todo/insert.php", {
            method : "POST",
            body : JSON.stringify({
                todos : this.newTodo
            })
        }).then(
            response => response.text() 
        ).then(
            html => console.log(html)
        );
        this.getAll()
        this.newTodo = ""
      },

      async zmenHodnotu(data) {
        await fetch("./api/todo/changeDone.php", {
            method : "POST",
            body : JSON.stringify({
                data: data
            })
        }).then(
            response => response.text() 
        ).then(
            html => console.log(html)
        );
        this.getAll()
      },
      
      async deleteTodo(data) {
        await fetch("./api/todo/delete.php", {
            method : "POST",
            body : JSON.stringify({
                data: data
            })
        }).then(
            response => response.text() 
        ).then(
            html => console.log(html)
        );
        this.getAll()
      },

  },
  mounted() {
    this.getAll()
  }
  }).mount('#app')
</script>
<style>
  .todo-row :hover {
    font-weight: bold;    
  }
  .todo-row {
    padding-top: 0.3rem;
    padding-bottom: 0.3rem;
  }
  .logout{
    position: fixed;
    top: 5px;
    right: 5px;
  }
</style>
</html>