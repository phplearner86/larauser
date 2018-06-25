<div class="modal" tabindex="-1" role="dialog" id="avatarModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Profile avatar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

        <form id="avatarForm" enctype="multipart/form-data">
            <div class="modal-body">
                <label for="avatar">Avatar</label>
                <div class="form-group">
                    <input type="file" name="filename" id="filename">
                    <p>
                        <span class="invalid-feedback filename"></span>
                    </p>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="saveAvatar">Save Avatar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </form>

    </div>
  </div>
</div>