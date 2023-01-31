<template>
    <main class="create-post">
        <div class="container">
            <h1>Create About</h1>
            <!-- succes message -->
            <div class="success-msg" v-if="success">
                <i class="fa fa-check"></i>
                About Created succefully
            </div>

            <div class="contact-form">
                <form @submit.prevent="submit">
                    <label for="name"><span>Name</span></label>
                    <input type="text" id="name" v-model="fields.name">
                    <span v-if="errors.name" class="error">{{ errors.name[0] }}</span>
                    <br>
                    <label for="image"><span>Image</span></label>
                    <input type="file" id="image" @input="grabFile">
                    <span v-if="errors.file" class="error">{{ errors.file[0] }}</span>
                    <div class="preview">
                        <img :src="url" alt="">
                    </div>
                    <br>

                    <label for="body"><span>Body</span></label>
                    <textarea id="body" v-model="fields.body"></textarea>
                    <span v-if="errors.body" class="error">{{ errors.body[0] }}</span>

                    <input class="add-post-btn" type="submit" value="Submit">
            </form>
            </div>
            <div class="create-categories">
                <router-link :to="{name: 'DashboardPostsList'}">Posts List <span>&#8594;</span></router-link>
            </div>
        </div>
    </main>
</template>
<script>
export default {
    data(){
        return{
            success: false,
            fields:{
                //category_id:''
            },
            errors:{},
            url:"",
            //categories: [],
        }
    },
    methods:{
        grabFile(e){
            const file = e.target.files[0];
            this.fields.file = file;
            this.url = URL.createObjectURL(file);
            URL.revokeObjectURL(file);
        },
        submit(){
            axios.post("/api/about", this.fields,{
                headers: {"content-type": "multipart/form-data"},
            })
            .then(()=>{
                this.fields = {},
                this.url = null,
                //this.fields.category_id = "",
                this.success = true,
                this.errors = {},
                setInterval(() =>{
                 this.success = false
                }, 2500);
            })
            .catch((error)=>{
                this.errors = error.response.data.errors;
                this.success = false
            })

        }
    },
    // mounted(){
    //     // axios.get('/api/categories')
    //     // .then((response)=> this.categories = response.data)
    //     // .catch((error)=> {
    //     //     console.log(error);
    //     // });
    // }
}
</script>
<style scoped>
    .create-post{
        background-color: #fff;
        padding: 0 3vw;
    }
    .container input,
    textarea,
    select{
        width: 100%;
        padding: 10px;
        border-radius: 4px;
        box-sizing: border-box;
        margin-top: 6px;
        margin-bottom: 20px;
        font-size: 16px;
    }
    h1{
        text-align: center;
        padding: 40px 0 50px 0;
    }
    .add-post-btn{
        background-color: black;
        color: white;
        border: none;
        cursor: pointer;
        transition: 0.3s ease;
    }
    .add-post-btn:hover{
        transform: translateY(-4px);
    }
    .preview img{
        max-width: 100%;
        max-height: 120px;
    }
</style>

