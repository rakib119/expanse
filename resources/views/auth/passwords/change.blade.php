 @extends('layouts.app')
 @section('main-content')
     <div class="card mb-5 shadow-sm">
         <h5 class="card-header">Change Password</h5>
         <div class="card-body">
             <div class="row mb-5 justify-content-center">
                 <div class="col-sm-12 col-md-6 ">
                     <div class="row">
                         <div class="col-12 ">
                             <form method="POST" action="{{ route('password.change') }}">
                                 @csrf
                                 <div class="form-row">
                                     <div class="form-group col-12">
                                         <label for="CurrentPassword">Current Password <span
                                                 class="text-danger">*</span></label>
                                         <input required type="text" id="CurrentPassword" name="current_password"
                                             class="form-control" placeholder="Enter your current password">
                                         @error('current_password')
                                             <span class="text-danger">{{ $message }}</span>
                                         @enderror
                                     </div>
                                     <div class="form-group col-12">
                                         <label for="newPassword">New Password <span class="text-danger">*</span></label>
                                         <input required type="text" id="newPassword" name="password"
                                             class="form-control" placeholder="Enter new password">
                                         @error('password')
                                             <span class="text-danger">{{ $message }}</span>
                                         @enderror
                                     </div>
                                     <div class="form-group col-12">
                                         <label for="password_confirmation">Confirm Password <span
                                                 class="text-danger">*</span></label>
                                         <input required type="text" id="password_confirmation"
                                             name="password_confirmation" class="form-control"
                                             placeholder="Enter password again">
                                         @error('password_confirmation')
                                             <span class="text-danger">{{ $message }}</span>
                                         @enderror
                                     </div>
                                 </div>
                                 <button class="btn btn-warning" type="submit">Update</button>
                             </form>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 @endsection
