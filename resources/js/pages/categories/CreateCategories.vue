<template>
    <div id="create-categories">
        <div id="contact-us">
            <h1>Create new Category</h1>
            <div class="contact-form">
                <form @submit.prevent="submit">
                    <label for="name"><span>Name</span></label>
                    <input type="text" id="name" name="name" v-model="field.name">
                    <span v-if="errors.name" class="error">{{ errors.name }}</span>
                    <input type="submit" value="Submit">
                </form>
            </div>
            <div class="create-categories">
                <a href="">Categories list <span>&#8594;</span></a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            field:{},
            errors:{},
        };
    },
    methods:{
        submit(){
            axios
            .post("/api/categories/create", this.field)
            .then(() =>{
                this.field = {};
                this.errors = {};
            })
            .catch((error) => {
                this.errors = error.response.data.errors;
            })
        }
    }

}
</script>
<style scoped>
#create-categories{
    background-color: #f3f4f6;
    height: 90vh;
    padding: 50px;
}
</style>
