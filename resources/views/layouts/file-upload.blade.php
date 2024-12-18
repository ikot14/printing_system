<!DOCTYPE html>
<html>
   <head>
      <title>Laravel File Upload Form</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
   </head>
   <body>
      <div class="container">
         <div class="panel panel-primary">
            <div class="panel-heading">
               <h2>Laravel File Upload Form</h2>
            </div>
            <div class="panel-body">
               @if ($message = Session::get('success'))
                   <div class="alert alert-success alert-block">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                      <strong>{{ $message }}</strong>s
                   </div>
               @endif
 
               @if (count($errors) > 0)
               <div class="alert alert-danger">
                  <strong>Whoops!</strong> There were some problems with your input.
                  <ul>
                     @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                     @endforeach
                  </ul>
               </div>
               @endif
 
                                 <form action="{{ route('file.store') }}" method="POST" enctype="multipart/form-data">
                     @csrf

                     <!-- Student Name -->
                     <label for="student_name">Student Name</label>
                     <input type="text" name="student_name" id="student_name" required>

                     <!-- Student ID -->
                     <label for="student_id">Student ID</label>
                     <input type="text" name="student_id" id="student_id" required>

                     <!-- File Upload -->
                     <label for="file">Upload File</label>
                     <input type="file" name="file" id="file" required>

                     <button type="submit">Submit</button>
                  </form>

            </div>
         </div>
      </div>
   </body>
</html>