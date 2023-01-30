<template>
     <div id="wrapper">
      <!-- sidebar -->
      <div class="sidebar" :class="{showOverlay: overlayVisibility}">
        <span class="closeButton" @click="hideOverlay">&times;</span>
        <p class="brand-title"><a href="">Winner Blog</a></p>

        <div class="side-links">
          <ul>
            <li><RouterLink @click="hideOverlay" :to="{name: 'Home'}">Home</RouterLink> </li>
            <li><RouterLink @click="hideOverlay" :to="{name: 'Blog'}">Blog</RouterLink> </li>
            <li><RouterLink @click="hideOverlay" :to="{name: 'About'}">About</RouterLink> </li>
            <li><RouterLink @click="hideOverlay" :to="{name: 'Contact'}">Contact</RouterLink> </li>
            <li v-if="!loggedIn"><RouterLink @click="hideOverlay" :to="{name: 'Register'}">Register</RouterLink> </li>
            <li v-if="!loggedIn"><RouterLink @click="hideOverlay" :to="{name: 'Login'}">Login</RouterLink> </li>
            <li v-if="loggedIn"><RouterLink @click="hideOverlay" :to="{name: 'Dashboard'}">Dashboard</RouterLink> </li>
        </ul>
        </div>

        <!-- sidebar footer -->
        <footer class="sidebar-footer">
          <div>
            <a href=""><i class="fab fa-facebook-f"></i></a>
            <a href=""><i class="fab fa-instagram"></i></a>
            <a href=""><i class="fab fa-twitter"></i></a>
          </div>

          <small>&copy; 2021 Winner Blog</small>
        </footer>
      </div>
      <!-- Menu Button -->
      <div class="menuButton" @click="ShowOverlay">
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
      </div>
      <!-- main -->
      <main class="container">

        <!-- render components depending on the page visited -->
        <router-view
        @update-sidebar="updateSidebar"
        @show-edit-succes="showEditSucces"
        :editSuccess="editSuccess"
        :key="$route.path"></router-view>

      </main>

      <!-- Main footer -->
      <!-- <footer class="main-footer">
        <div>
          <a href=""><i class="fab fa-facebook-f"></i></a>
          <a href=""><i class="fab fa-instagram"></i></a>
          <a href=""><i class="fab fa-twitter"></i></a>
        </div>
        <small>&copy; 2023 Winner Blog</small>
      </footer> -->
    </div>

</template>
<script>
export default {
    data(){
        return {
            overlayVisibility:false,
            loggedIn: false,
            editSuccess: false,
        };
    },
    methods:{
        ShowOverlay(){
            this.overlayVisibility = true
        },
        hideOverlay(){
            this.overlayVisibility = false
        },
        updateSidebar(){
            this.loggedIn = !this.loggedIn;
        },
        showEditSucces(){
            this.editSuccess = true;
        }
    },
    mounted(){
        if(localStorage.getItem('authenticated')){
            this.loggedIn = true
        }else{
            this.loggedIn = false
        }
    }
}
</script>
<style scoped>
.showOverlay{
    width: 100%;
    z-index: 5;
}
</style>
