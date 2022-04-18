<!-- Search Modal -->
<div class="modal fade fade-scale searchmodal" id="searchmodal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
        </div>
        <form class="search-form">
          <input type="text" class="form-control" id="search" placeholder="Search...">
          <button type="submit" class="search-btn"><i class="icofont-search"></i></button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End Search Modal --> <div class="page-banner banner-bg-one">
  <div class="container">
    <div class="banner-text">
      <h1>Sign Up</h1>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Sign Up</li>
        </ol>
      </nav>
    </div>
  </div>
</div>
<section class="register-section pt-100 pb-180">
  <div class="container">
    <div class="register-form box-content">
      <h3 class="title">Register Now</h3>
      <form name="frmSignUp" id="frmSignUp" class="form" method="post" enctype="multipart/form-data">
        <div class="row">
        <div class="col-md-12">
          <div class="form-group"> 
            <!--<label>Member Type :</label>-->
            <select id="memberType" name="memberType" title="Member Type" class="form-control">
              <option value="">--Select Member Type--</option>
              <option value="2">Student</option>
              <option value="3">Institute</option>            
            </select>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group"> 
            <!--<label>Name :</label>-->
            <input type="text" name="memberName" id="memberName" title="Name" class="form-control" placeholder="Name" />
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group"> 
            <!--<label>Email :</label>-->
            <input type="text" id="email" name="email" title="" class="form-control" placeholder="Email" error-msg="This is not a valid Email ID">
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group"> 
            <!--<label>Password :</label>-->
            <input type="password" name="password" id="password" title="Password" class="form-control" placeholder="Password">
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group"> 
            <!--<label>Confirm Password  :</label>-->
            <input type="password" id="confirmPassword" name="confirmPassword" title="Confirm Password" class="form-control" placeholder="Confirm Password">
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group"> 
            <!-- <label>Mobile No  :</label>-->
            <input type="text" id="mobileNo" name="mobileNo" title="" class="form-control" placeholder="Mobile No" error-msg="This is not a valid Mobile No" maxlength="10">
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-foot">
            <button type="button" class="btn default-btn" onclick="SubmitForm()">Sign Up</button>
            <!-- <input type="hidden" name="mxValidate" id="mxValidate" value="%7B%22memberName%22%3A%22isBlank%22%2C%22email%22%3A%22isBlank%2CisEmail%22%2C%22password%22%3A%22isPassword%22%2C%22confirmPassword%22%3A%22isEqual%3Apassword%22%2C%22mobileNo%22%3A%22isMobile%22%7D" />
            <input type="hidden" name="_Action" id="_Action" value="_InsertMember" /> -->
            <div>Already have a account <a href="{{url('/')}}/sign-in">Login here</a></div>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>
<!-- End Footer Area -->

<script type="text/javascript">
  function SubmitForm()
  {
    alert()
  }
</script>