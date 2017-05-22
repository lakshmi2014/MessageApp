
<nav class="navbar navbar-default">
  <div class="container-fluid" style ="background-color:#8b9dc3" >
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header" >
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" id ="heading" href="#" style ="color:white">Socialnet</a>
    </div>

         
    
      <form class="navbar-form navbar-right" action ="login.php" method ="GET">
        <div class ="form-group">
          <label>Email</label>
          <input type="email" name ="email" class ="form-control" required >
          <label>Password</label>
          <input type="password" name ="pass" class ="form-control"  required>
          <button type="submit" >Login</button>
          <div>
          <a href ="recover.php" style ="color:#f7f7f7">Forgotten account?</a>
         </div>
            
        </div>
      </form>
        

      
    
  </div>
</nav>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
