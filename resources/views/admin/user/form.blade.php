<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel"      aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title_text"></h5>
                <button type="button" class="btn-close" onClick="closemodel()" ></button>
            </div>
            <div class="modal-body p-4">
                <form id="frm">
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                              <div class="form-outline">
                                <input type="text" id="firstName"  name="firstName" class="form-control form-control-lg"/>
                                <label class="form-label" for="firstName">First Name</label>
                              </div>
                              <span class="text-danger err_msg" id="firstname"></span>
                            </div>
                            <div class="col-md-6 mb-4">
                              <div class="form-outline">
                                  <input type="text" id="lastName" name="lastName" class="form-control form-control-lg" />
                                  <label class="form-label" for="lastName">Last Name</label>
                              </div>
                              <span class="text-danger err_msg" id="lastname"></span>
                            </div>
                          </div>
                      
                          <div class="row">
                            <div class="col-md-6 mb-4 d-flex align-items-center">
                                <div class="form-outline datepicker w-100">
                                    <input type="text" id="address"  class="form-control form-control-lg" name="address"/>
                                    <label for="address" class="form-label">Address</label><br>
                                    <span class="text-danger err_msg" id="Address"></span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                              <h6 class="mb-2 pb-1">Gender: </h6>
                              <div class="form-check">
                                <input class="form-check-input Gender " id="Gender" type="radio" name="Gender" value="F"/>
                                <label class="form-check-label" for="femaleGender">Female</label>
                              </div>
                      
                              <div class="form-check">
                                <input class="form-check-input Gender" id="Gender" type="radio" name="Gender" value="M" />
                                <label class="form-check-label" for="maleGender">Male</label>
                              </div>
                              <span class="text-danger err_msg" id="gender"></span>
                            </div>
                          </div>
                      
                          <div class="row">
                            <div class="col-md-6 mb-4 pb-2">
                              <div class="form-outline">
                                <input type="email" id="email"  name="email" class="form-control form-control-lg" />
                                <label class="form-label" for="emailAddress">Email</label>
                              </div>
                              <span class="text-danger err_msg" id="Email"></span>
                            </div>
                            <div class="col-md-6 mb-4 pb-2">
                      
                              <div class="form-outline">
                                <input type="tel" id="phoneNumber" name="phoneNumber" class="form-control form-control-lg"/>
                                <label class="form-label" for="phoneNumber">Phone Number</label>
                              </div>
                              <span class="text-danger err_msg" id="phonenumber"></span>
                            </div>      
                          </div>
                          <div class="row">
                            <div class="col-md-6 mb-4 pb-2">
                              <div class="form-outline">
                                <select class="form-select" id="select_role" aria-label="Default select example">
                                  <option value="">select Role</option> 
                                  @foreach ($role as $val)
                                  <option value="{{ $val->id}}">
                                      {{ $val->name}} </option>
                                  @endforeach
                              </select>
                              </div>
                              <span class="text-danger err_msg" id="select_name"></span>
                            </div>
                            <div class="col-md-6 mb-4 pb-2">
                      
                              <div class="form-outline">
                               <input type="password" id="password" name="password" class="form-control form-control-lg" />
                              <label class="form-label" >Password</label>
                              </div>
                              <span class="text-danger err_msg" id="Password"></span>
                            </div>      
                          </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="submit" onClick="FromSubmit()" value="" class="btn btn-primary" id="button_text">Submit</button>
            </div>
        </div>
    </div>
</div>



<form>
    
</form><br>