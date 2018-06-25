<div class="modal" tabindex="-1" role="dialog" id="createSubjectModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Subjects</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form id="createSubjectForm">
            <div class="form-group">
              <label for="name">Subject</label>
              <input type="text" name="subject_id" id="subject_id" class="form-control">
            </div>
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="storeSubject">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>