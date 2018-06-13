<form id="avatarForm" enctype="multipart/form-data" method="POST" action="{{ route('admin.avatars.update', $profile) }}">
    @csrf
    @method('PUT')
    <div class="modal-body">
        <label for="avatar">Avatar</label>
        <div class="form-group">
            <input type="file" name="filename" id="filename">
        </div>
    </div>
    
        <button  class="btn btn-primary" id="saveAvatar" type="submit">Save Avatar</button>
    
</form>