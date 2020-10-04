<template>
    <div>
<link type="text/css" rel="stylesheet" href="https://unpkg.com/bootstrap/dist/css/bootstrap.min.css"/>
<link type="text/css" rel="stylesheet" href="https://unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.css"/>
        <h3 class="text-center">Edit Book</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateBook">
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
                        <input type="checkbox" id="author1" class="author" name="author[]"  :checked="getChecked(1)" value="1"  @click="getAuthors()">
                        <label for="author2"> Balzac</label>
                        <input type="checkbox" id="author2" class="author" name="author[]"  :checked="getChecked(2)" value="2"  @click="getAuthors()">
                <span>Checked names: {{ book }}</span>
</div>
                    <button type="submit" class="btn btn-primary">Update Book</button>
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
                }
            }
        },
        created() {
            this.axios
                .get(`http://127.0.0.1:8000/api/book/edit/${this.$route.params.id}`)
                .then((response) => {
                    this.book = response.data;
                    console.log(this.book);
                });
            
        },
        mounted() {this.getAuthors();},
        methods: {
            getChecked(value){
            var checked;
            var arr = [];
                $.each(this.book.authors, function( index, value ) {
//                    console.log(this.pivot.author_id);
                    var author = parseInt($("#author"+(index+1)).val());
                    arr.push(this.pivot.author_id);
                    });
//                console.log(arr);
//                alert(value);
                if(arr.includes(value)) {
                    return checked = true;
                }
            },

            updateBook() {
                this.axios
                    .post(`http://127.0.0.1:8000/api/book/update/${this.$route.params.id}`, this.book)
                    .then((response) => {
                        this.$router.push({name: 'home'});
                    });
            },
            getAuthors() {
            var authors = $('input:checked').map(function(){

              return $(this).val();

            });

            this.book.checkedAuthors = authors.get();
            console.log(this.book.checkedAuthors);

            }
        }
    }
</script>