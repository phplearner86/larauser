<div class="modal" id="createAccountModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fa fa-lock"></i>
                        <span>Create Account</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                    </button>
                </div>

            {{-- FORM --}}
            <form id="createAccountForm">
                <div class="modal-body">

                    <!-- Role -->
                    <div class="form-group select-box">
                        <label for="role_id">Role</label>
                        <select class="role_id form-control req_place" name="role_id[]" id="role_id" multiple="multiple">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>

                        <span class="invalid-feedback role_id"></span>
                    </div>

                    {{-- Name --}}
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input id="name" type="text" class="form-control name" name="name" placeholder="Enter name">

                        <span class="invalid-feedback name"></span>
                    </div>


                    {{-- Email --}}
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" type="text" class="form-control email" name="email" placeholder="example@domain.com">

                        <span class="invalid-feedback email"></span>
                    </div>

                    {{-- Password --}}
                   <div class="form-group mb-0">
                       <label for="create_password" class="mb-0">Password <sup><i class="fa fa-asterisk fa-form red"></i></sup></label>

                       <input type="password" class="form-control mt-8 password admin-modal-input" id="password" name="password" placeholder="Give password to the user" />

                       <span class="invalid-feedback password"></span>
                   </div>

                   <div class="form-group mt-12">
                       <div class="form-check">
                           <input class="form-check-input admin-modal-input" type="checkbox" name="create-password" id="autoPassword" value="auto"  checked />
                           <label class="form-check-label" for="autoPassword">
                               Auto generate password
                           </label>
                       </div>
                   </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-account" id="storeAccount">Create account</button>
                </div>
            </form>

        </div>
    </div>
</div>    