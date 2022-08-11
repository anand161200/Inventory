<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <style>
        .gradient-custom {
            background: #f093fb;
            background: -webkit-linear-gradient(to bottom right, rgba(240, 147, 251, 1), rgba(245, 87, 108, 1));
            background: linear-gradient(to bottom right, rgba(240, 147, 251, 1), rgba(245, 87, 108, 1))
        }
        .card-registration .select-input.form-control[readonly]:not([disabled]) {
            font-size: 1rem;
            line-height: 2.15;
            padding-left: .75em;
            padding-right: .75em;
        }
        .card-registration .select-arrow {
            top: 13px;
        }
        .error {
        color: #F00;
        background-color: #FFF;
        }
    </style>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

  <section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
      <div class="row justify-content-center align-items-center h-100">
        <div class="col-12 col-lg-9 col-xl-7">
          <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
            <div class="card-body p-4 p-md-5">
                <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 text-center">Login</h3>
                <form action="{{route('register')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-4 pb-2">
        
                          <div class="form-outline">
                            <input type="password" name="email" class="form-control form-control-lg" />
                            <label class="form-label" >Email</label>
                          </div>

                        </div>
  
                      <div class="col-md-6 mb-4 pb-2">
        
                        <div class="form-outline">
                          <input type="password"  name="password" class="form-control form-control-lg" />
                          <label class="form-label" > Password</label>
                        </div>
                      </div>
                    </div>
                    <div class="mt-4 pt-2 text-center">
                      <button class="btn btn-primary btn-lg " type="submit">Submit</button>
                    </div>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>
</html>