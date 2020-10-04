<template>
    <div>
<link type="text/css" rel="stylesheet" href="https://unpkg.com/bootstrap/dist/css/bootstrap.min.css"/>
<link type="text/css" rel="stylesheet" href="https://unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.css"/>
        <h3 class="text-center">All Books</h3><br/>
        <div class="form-group">
            <label for="author1"> English</label>
            <input type="checkbox" id="author1" value="1" @click="filterLanguage()">
            <label for="author2"> French</label>
            <input type="checkbox" id="author2" value="2" @click="filterLanguage()">
            <label for="author3"> Italian</label>
            <input type="checkbox" id="author3" value="3" @click="filterLanguage()">
        </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Language</th>
                <th>Authors</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="book in books" :key="book.id">
                <td>{{ book.id }}</td>
                <td>{{ book.name }}</td>
                <td>{{ book.language.name }}</td>
                <td><span v-for="(item,index) in  book.authors" :key="item.name">{{ item.name }}<span v-if="index+1 <  book.authors.length">, </span></span></td>
                <td>{{ book.created_at }}</td>
                <td>{{ book.updated_at }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'edit', params: { id: book.id }}" class="btn btn-primary">Edit
                        </router-link>
                        <button class="btn btn-danger" @click="deleteBook(book.id)">Delete</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                language: null,
                books: {}
            }
        },
        created() {
             this.loadBooks();
        },
        methods: {
            loadBooks() {
                this.axios
                .get('http://127.0.0.1:8000/api/books', {
                    params: {
                      language: this.language
                    }
                })
                .then(response => {
                    this.books = response.data;
                });
            },
            deleteBook(id) {
                this.axios
                    .delete(`http://localhost:8000/api/book/delete/${id}`)
                    .then(response => {
                        let i = this.books.map(item => item.id).indexOf(id); // find index of your object
                        this.books.splice(i, 1)
                    });
            },
            filterLanguage() {
            var languages = $('input:checked').map(function(){

              return $(this).val();

            });

            this.language = languages.get();
            console.log(this.language);
            this.loadBooks();
                }
            }
    }
</script>
