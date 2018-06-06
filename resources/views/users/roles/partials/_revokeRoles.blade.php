<div class="modal" id="revokeRolesModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            {{-- FORM --}}
            <form id="revokeRolesForm">
                <div class="modal-header">
                    <h5 class="modal-title">Revoke Roles</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="role_id">Revoke Role(s)</label>
                        <div id="role"> 

                            {{-- render checkbox values for the specific user by using ajax --}}

                        </div>
                        

                        <span class="invalid-feedback role_id"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-role" id="revokeRoles">Revoke</button>
                </div>
            </form>

        </div>
    </div>
</div>