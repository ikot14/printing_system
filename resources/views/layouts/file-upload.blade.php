<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Laravel File Upload Form</title>
      <!-- Link to SB Admin Bootstrap CSS -->
      <link href="https://cdn.jsdelivr.net/npm/sb-admin-2@4.1.4/dist/css/sb-admin-2.min.css" rel="stylesheet">
      <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
      <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
      <style>
         body {
            background-color: #f8f9fc;
         }
         .container {
            max-width: 800px;
            margin-top: 50px;
         }
         .panel-body {
            background-color: white;
            padding: 30px;
            border-radius: 5px;
         }
         label {
            font-weight: bold;
         }
         input[type="text"], input[type="file"] {
            margin-bottom: 15px;
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
         }
         button {
            background-color: #4e73df;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
         }
         button:hover {
            background-color: #2e59d9;
         }
      </style>
   </head>
   <body id="page-top">

      <!-- SB Admin Sidebar and Navbar -->
      <div id="wrapper">
         <!-- Sidebar -->
         

         <!-- Content Wrapper -->
         <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
               <!-- Topbar -->
               

               <!-- Main Content Container -->
               <div class="container">
                  <div class="panel panel-primary">
                     <div class="panel-heading">
                        <h2 class="text-center">Upload Imong File Anhi</h2>
                     </div>
                     <div class="panel-body">
                        @if ($message = Session::get('success'))
                           <div class="alert alert-success alert-block">
                              <button type="button" class="close" data-dismiss="alert">×</button>
                              <strong>{{ $message }}</strong>
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

                        <!-- Form for File Upload -->
                        <form action="{{ route('store.file') }}" method="POST" enctype="multipart/form-data">
                           @csrf
                           
                           <!-- Student Name -->
                           <div class="form-group">
                              <label for="student_name">Student Name</label>
                              <input type="text" name="student_name" id="student_name" class="form-control" required>
                           </div>

                           <!-- Student ID -->
                           <div class="form-group">
                              <label for="student_id">Student ID</label>
                              <input type="text" name="student_id" id="student_id" class="form-control" required>
                           </div>

                           <!-- File Upload -->
                           <div class="form-group">
                              <label for="file">Upload File</label>
                              <input type="file" name="file" id="file" class="form-control" required>
                           </div>

                           <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <!-- SB Admin JS and Bootstrap JS -->
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.bundle.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/sb-admin-2@4.1.4/dist/js/sb-admin-2.min.js"></script>
   </body>
</html>
