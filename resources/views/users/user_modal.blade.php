<div id="createUserModal" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="userId">
                <div class="form-group">
                    <label for="userName" class="col-form-label">User name</label>
                    <input type="text" class="block w-full rounded-md border-gray-300 pl-7 pr-12 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" id="userName">
                </div>
                <div class="form-group">
                    <label for="userEmail" class="col-form-label">User Email</label>
                    <input type="text" class="block w-full rounded-md border-gray-300 pl-7 pr-12 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" id="userEmail">
                </div>
                <div class="input-group mb-3">
                    <select class="custom-select" id="userRole">
                        <option value="1" selected>User</option>
                        <option value="2">Admin</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="createUserSubmit" type="button" class="btn btn-primary">Create</button>
                <button id="editUserSubmit" type="button" class="btn btn-primary" hidden>Edit</button>
            </div>
        </div>
    </div>
</div>
