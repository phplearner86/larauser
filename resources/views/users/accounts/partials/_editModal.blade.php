<div class="modal" id="editAccountModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fa fa-lock"></i>
                        <span>Edit Account</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                    </button>
                </div>

            {{-- FORM --}}
            <form id="editAccountForm">
                <div class="modal-body">

                    <!-- Role -->
                    <div class="form-group select-box">
                        <label for="_role_id">Role</label>
                        <select class="role_id form-control req_place" name="role_id[]" id="_role_id" multiple="multiple">
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
                        <label for="_name">Name</label>
                        <input id="_name" type="text" class="form-control name" name="name" placeholder="Enter name">

                        <span class="invalid-feedback name"></span>
                    </div>


                    {{-- Email --}}
                    <div class="form-group">
                        <label for="_email">Email</label>
                        <input id="_email" type="text" class="form-control email" name="email" placeholder="example@domain.com">

                        <span class="invalid-feedback email"></span>
                    </div>

                    {{-- Password --}}
                    <div class="form-group" >
                        <label for="_password">Password</label>
                        <input id="_password" type="password" class="form-control password" name="password" placeholder="Give password to the user">

                        <span class="invalid-feedback password"></span>
                    </div>

                    <div class="form-group" id="check-password">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="create-password" id="_unchangedPassword" value="unchanged" checked="">
                            <label class="form-check-label" for="_unchangedPassword">
                                Do not change password
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="create-password" id="_autoPassword" value="auto">
                            <label class="form-check-label" for="_autoPassword">
                                Auto generate password
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="create-password" id="_manualPassword" value="manual">
                            <label class="form-check-label" for="_manualPassword">
                                Create password for the user
                            </label>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-account" id="updateAccount">Save changes</button>
                </div>
            </form>

        </div>
    </div>
</div>    