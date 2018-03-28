  <div class="col-md-4">
    <div class="card mb-4 box-shadow bg-lightest-grey">
        <div class="card-body">
            <h5 class="mb-3">
                <a href="" class="ls-1 text-uppercase text-bold-grey">
                    {{ $role->name }}
                </a>
            </h5>
            <p class="card-text">
                Some quick example text to build on the card title and make up the bulk of the card's content.
            </p>
            <div class="flex justify-between">
                <div>
                    <a href="" class="btn btn-danger btn-edit">Details</a>
                    <button type="button" id="editRole" class="btn btn-danger btn-delete" value="{{ $role->id }}">Edit</button>
                </div>
                <button type="button" id="deleteRole" class="btn btn-danger btn-delete" value="{{ $role->id }}"><i class="fa fa-trash fs-18"></i></button>
            </div>
        </div>
    </div>
</div>