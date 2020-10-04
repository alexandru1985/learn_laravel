<template>
    <div>
<link type="text/css" rel="stylesheet" href="https://unpkg.com/bootstrap/dist/css/bootstrap.min.css"/>
<link type="text/css" rel="stylesheet" href="https://unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.css"/>
        <h3 class="text-center">Add Book</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addBook">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="book.name">
                    </div>
                    <div class="form-group">
                        <label>Language</label>
                      <select name="language_id" v-model="book.language_id" id="language_id">
                      <option value="1">English</option>
                      <option value="2">French</option>
                      <option value="3">Italian</option>
                    </select>
                    
                    </div>
                    <div class="form-group">
                        <label for="author1"> Hugo</label>
                        <input type="checkbox" id="author1" name="author[]" v-model="book.checkedAuthors" value="1">
                        <label for="author2"> Balzac</label>
                        <input type="checkbox" id="author2" name="author[]" v-model="book.checkedAuthors" value="2">


                    <span>Checked names: {{ book.checkedAuthors }}</span>
                    </div>

                    <button type="submit" class="btn btn-primary">Add Book</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                book: {
                checkedAuthors: []
               },

            }
        },
        methods: {
            addBook() {

                this.axios
                    .post('http://127.0.0.1:8000/api/book/add', this.book)
                    .then(response => (
                        this.$router.push({name: 'home'})
                        // console.log(response.data)
                    ))
                    .catch(error => console.log(error))
                    .finally(() => this.loading = false)
            }
        }
    }
</script>
