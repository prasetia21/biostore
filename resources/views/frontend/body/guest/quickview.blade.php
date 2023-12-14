  <div class="modal fade custom-modal" id="quickViewModal" tabindex="-1" aria-labelledby="quickViewModalLabel"
      aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeModal"></button>
              <div class="modal-body">
                  <div class="row">
                      <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                          <div class="detail-gallery">

                              <!-- MAIN SLIDES -->
                              <img src=" " alt="product image" id="pimage" />

                          </div>
                          <!-- End Gallery -->
                      </div>
                      <div class="col-md-6 col-sm-12 col-xs-12">
                          <div class="detail-info pr-30 pl-30">
                              <h5 class="title-detail"><a href=" " class="text-heading" id="pname"> </a></h5>
                             
                              <div class="clearfix product-price-cover">
                                  <div class="product-price primary-color float-left">
                                      <span class="current-price text-brand">Rp.</span>
                                      <span class="current-price text-brand" id="pprice"> </span>
                                        <br />
                                      <span class="old-price font-md ml-15">Rp.</span>
                                      <span class="old-price font-md ml-15" id="oldprice"> </span>

                                  </div>
                              </div>
                              <div class="detail-extralink mb-30">
                                  <div class="detail-qty border radius">
                                      <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                      <input type="text" name="qty" id="qty" class="qty-val" value="1"
                                          min="1">

                                      <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                  </div>
                                  <div class="product-extra-link2">
                                      <input type="hidden" id="product_id">
                                      <input type="hidden" id="product_dimension_x">
                                      <input type="hidden" id="product_dimension_y">
                                      <input type="hidden" id="product_dimension_z">
                                      <input type="hidden" id="product_weight">
                                      <button type="submit" class="button button-add-to-cart" onclick="addToCart()"><i
                                              class="fi-rs-shopping-cart"></i>Add to cart</button>
                                  </div>
                              </div>

                              <div class="row">
                                  <div class="col-md-6">

                                      <div class="font-xs">
                                          <ul>
                                              <li class="mb-3">Brand: <span class="text-brand" id="pbrand"> </span>
                                              </li>
                                              <li class="mb-3">Category: <span class="text-brand" id="pcategory">
                                                  </span></li>
                                          </ul>
                                      </div>

                                  </div> <!-- // End col  -->


                                  <div class="col-md-6">

                                      <div class="font-xs">
                                          <ul>
                                              <li class="mb-3">Product Code : <span class="text-brand" id="pcode">
                                                  </span></li>
                                              <li class="mb-3">Stock: <span class="badge badge-pill badge-success"
                                                      id="aviable" style="background:green; color: white;"> </span>
                                                  <span class="badge badge-pill badge-danger" id="stockout"
                                                      style="background:red; color: white;"> </span>
                                              </li>
                                          </ul>
                                      </div>

                                  </div> <!-- // End col  -->



                              </div> <!-- // end row -->



                          </div>
                          <!-- Detail Info -->
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
