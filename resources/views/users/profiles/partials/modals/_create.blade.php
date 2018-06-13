<div class="modal" tabindex="-1" role="dialog" id="saveProfileModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">User profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

        <form id="saveProfileForm">
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name') ?: optional($user->profile)->name }}" placeholder="Enter name">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="saveProfile">Save Profile</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </form>

    </div>
  </div>
</div>