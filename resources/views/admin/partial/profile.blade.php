

<section id="profile" style="display: flex">
    <form>
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ Auth::guard('admin')->user()->name }}" readonly>
            <button type="button" class="edit-btn" onclick="editingName()">Change</button>
        </div>

        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ Auth::guard('admin')->user()->email }}" readonly>
            <button type="button" class="edit-btn" onclick="editingEmail()">Change</button>
        </div>
        
    
    <button onclick="showChangePasswordModel()" type="button" class="btn btn-primary" >
        Change Password
    </button>
    </form>
</section>




<div id="editNameModal" class="admin_profile_modal" style="display: none;">
    <div class="modal-content" style="width: fit-content;">


        <form id="updateForm"  >
            @csrf
            <div>
                <label for="newName">Name <span id="fieldLabel"></span>:</label>
                <input type="text" id="newName" name="newName" value="{{ Auth::guard('admin')->user()->name }}">
            </div>

            <div style="display:flex;">
            <button type="button" class="btn save-btn" onclick="saveNameChange()">Save</button>
            <button type="button" class="btn save-btn" onclick="closeNameModal()">cancel</button>
            </div>
            
            
        </form>
    </div>
</div> 



<!-- change email -->
<div id="editEmailModal" class="admin_profile_modal" style="display: none;">
    <div class="modal-content" style="width: fit-content;">


        <form id="updateForm"  >
            @csrf
            <div>
                <label for="newEmail">Email <span id="fieldLabel"></span>:</label>
                <input type="text" id="newEmail" name="newEmail" value="{{ Auth::guard('admin')->user()->email }}">
            </div>

            <div style="display:flex;">
            <button type="button" class="btn save-btn" onclick="saveEmailChange()">Save</button>
            <button type="button" class="btn save-btn" onclick="closeEmailModal()">cancel</button>
            </div>
            
        </form>
    </div>
</div>


<!-- Change Password Modal -->
 <div class="admin_profile_modal"  id="change-password-model" style="display: none">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">update password  </h6>
                    <form class="form-sample">
                        {{csrf_field()}}

                        <div class="row mb-3">
                            <label class="col-sm-3 col-foem-lable">old password<span style="color: red;">

                            </span> 
                        </label>
                        <div class="col-sm-9"><input type="text" name="old password" id="old_password" class="form-control" placeholder="old password" required>
                     </div>
                    </div>
                    <hr> 
                    <div class="row mb-3">
                            <label class="col-sm-3 col-foem-lable">new password<span style="color: red;">

                            </span> 
                        </label>
                        <div class="col-sm-9"><input type="text" id="new_password"  name="new password"class="form-control" placeholder="new password" required>
                     </div>
                    </div>
                    <hr> 
                    <div class="row mb-3">
                            <label class="col-sm-3 col-foem-lable">confirm password<span style="color: red;">

                            </span> 
                        </label>
                        <div class="col-sm-9"><input type="text" id="confirm_password" name="confirm password"class="form-control" placeholder="confirm password" required>
                     </div>
                    </div>




                    <button type="button" class="btn btn-primary me-2" onclick="savePasswordBtn()">update</button>
                    <button type="button" class="btn btn-primary me-2" onclick="closeChangePasswordModel()">cancel</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

