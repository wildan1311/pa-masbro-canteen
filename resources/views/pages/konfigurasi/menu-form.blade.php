<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <form action="{{$action}}" method="post" id="form_action">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="basicInput" class="form-label">Name</label>
                            <input type="text" placeholder="Input Here" class="form-control" id="basicInput" name="name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="basicInput" class="form-label">Url</label>
                            <input type="text" placeholder="Input Here" class="form-control" id="basicInput" name="url">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="basicInput" class="form-label">Category</label>
                            <input type="text" placeholder="Input Here" class="form-control" id="basicInput" name="category">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="">Permission</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1"
                                value="option1">
                            <label class="form-check-label" for="inlineCheckbox1">Create</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2"
                                value="option2">
                            <label class="form-check-label" for="inlineCheckbox2">Read</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2"
                                value="option2">
                            <label class="form-check-label" for="inlineCheckbox2">Update</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2"
                                value="option2">
                            <label class="form-check-label" for="inlineCheckbox2">Delete</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
    </div>
</div>
