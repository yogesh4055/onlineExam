 <!-- start page content wrapper-->
<div class="page-content-wrapper">
  <!-- start page content-->
  <div class="page-content">
    <!--start breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">Forms</div>
      <div class="ps-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 p-0 align-items-center">
            <li class="breadcrumb-item">
              <a href="{{url('/')}}/admin/dashboard"><ion-icon name="home-outline"></ion-icon></a>
            </li>
            <li class="breadcrumb-item"><a href="{{url('/')}}/admin/gallery">Gallery</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Edit News</li>
          </ol>
        </nav>
      </div>
    </div>
    <!--end breadcrumb-->
    <div class="card">
      <div class="card-header">
        <h6 class="mb-0">News Input</h6>
      </div>
      <div class="card-body">
          <div class="product-grid">
              <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4">
                @foreach ($arrImages as $key => $row)
                <div class="col">
                  <div class="card product-card">
                    <img src="{{$row->imagePath}}" class="card-img-top" alt="...">
                    <div class="card-body">
                      <div class="product-info">
                        <div class="product-action mt-2">
                          <div class="d-grid">
                            <a href="javascript:;" class="btn btn-primary btn-ecomm"><i class="trash-sharp"></i>Remove</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
              <!--end row-->
            </div>
      </div>
    </div>
  </div>
  <!-- end page content-->
</div>
<script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>

<script>
CKEDITOR.replace( 'description' );
CKEDITOR.replace( 'subject' );
</script>