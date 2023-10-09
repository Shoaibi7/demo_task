<div class="container">
    <form method="GET" action="{{ route('notifications.index') }}">
        <div class="form-group">
            <label for="role">Filter by Role:</label>
            <select name="role" id="role" class="form-control">
                <option value="">Select Role</option>
                <option value="user">User</option>
                <option value="company">Company</option>
            </select>
        </div>

        <div class="form-group">
            <label for="name">Filter by Name:</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name">
        </div>

        <div class="form-group">
            <label for="email">Filter by Email:</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Apply Filters</button>
        </div>
    </form>
</div>
