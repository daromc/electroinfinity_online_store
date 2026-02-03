<!-- login File -->
<?php
include('header.php');
?>

<div class="container col-md-6">

  <div class="card text-center mt-5">

    <div class="card-body">

      <div class="d-flex justify-content-center">
        <!--------- Slide Tab ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Sign In</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Sign Up</button>
          </li>
        </ul>
      </div>

        <img src="../images/admin_logo.png" class="card-img-top mb-3" alt="..." style="width: 13rem;">
     
      <div class="tab-content" id="pills-tabContent">
        <!--------- Login Tab Content Start -------------------------------------------------------------------------------->
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
          
          <form action="login_verify.php" method="POST">
            <div class="form-floating mb-3">
              <input type="text" name="username" class="form-control" id="floatingInput" placeholder="name@example.com" required>
              <label for="floatingInput">Login ID</label>
            </div>
            <div class="form-floating mb-3">
              <input type="password" name="pass" minlength="8" class="form-control" id="floatingPassword" placeholder="Password" required>
              <label for="floatingPassword">Password</label>
            </div>
          
            <!-- 2 column grid layout for inline styling -->
            <div class="row mb-4">
              <div class="col d-flex justify-content-center">
                <!-- Checkbox -->
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                  <label class="form-check-label" for="form2Example31"> Remember me </label>
                </div>
              </div>
          
              <div class="col">
                <!-- Simple link -->
                <a href="#!">Forgot password?</a>
              </div>
            </div>
          
            <!-- Submit button -->
            <button type="submit" value="SUBMIT" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4">Login</button>
          
            <!-- Register buttons -->
            <div class="text-center">
              <p>Are you a normal user? <a href="user_login.php">Log in - User</a></p>
            </div>
          </form>

        </div>
        <!--------- Login Tab Content End -------------------------------------------------------------------------------->


        <!------------------------ Register Tab Content------------------------------------------------------------------->
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
          <div class="form-floating mb-3">
            <input type="text" name="username" class="form-control" id="floatingInput" placeholder="username">
            <label for="floatingInput">Login ID</label>
          </div>
          <div class="form-floating mb-3">
            <input type="password" name="pass" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" name="fullname" class="form-control" id="floatingFullname" placeholder="fullname">
            <label for="floatingFullname">Name</label>
          </div>
          <div class="form-floating mb-3">
            <input type="email" name="email" class="form-control" id="floatingEmail" placeholder="Email">
            <label for="floatingEmail">Email</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" name="address" class="form-control" id="floatingAddress" placeholder="Address">
            <label for="floatingAddress">Address</label>
          </div>
          <button type="submit" value="SUBMIT" class="btn btn-primary btn-block mb-4">Register</button>
        </div>


      </div>  
  
   </div>
  </div>

</div>

<?php
include('footer.php');
?>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
  document.getElementById('register-link').addEventListener('click', function(e) {
    e.preventDefault();
    var signUpTab = new bootstrap.Tab(document.querySelector('#pills-profile-tab'));
    signUpTab.show();
  });
</script>

</body>
</html>
