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
      <h3 class="title">Login Your Account</h3>
      <form name="frmSignIn" id="frmSignIn" method="post" enctype="multipart/form-data" onsubmit="return MemberLogin(this);">
        @csrf
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Email :</label>
              <input type="text" id="email" name="email" title="" class="form-control" placeholder="Email" error-msg="This is not a valid Email ID">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Password : </label>
              <span style="float:right;"><a href="{{url('/')}}/forgot-password">Forgot your password?</a></span>
              <input type="password" name="password" id="password" title="Password" class="form-control" placeholder="Password" error-msg="Password should be alphanumeric and contain no space">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-foot">
              <button type="submit" class="btn default-btn" name="btnSubmit" value="true">Sign In </button>
          <!--     <input type="hidden" name="mxValidate" id="mxValidate" value="%7B%22email%22%3A%22isBlank%2CisEmail%22%2C%22password%22%3A%22isBlank%22%7D"> -->
              <input type="hidden" name="_Action" id="_Action" value="_MemberLogin">
              <div><a href="{{url('/')}}/sign-up">Create your Online Exam account</a></div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>
<!-- End Footer Area -->