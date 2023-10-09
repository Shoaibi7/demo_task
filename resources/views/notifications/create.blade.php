<div class="container">
    <h2>Create Notification</h2>
    <form method="POST" action="{{ route('notifications.store') }}">
        @csrf

        <!-- Add a hidden input field to store the recipient's ID -->
        <input type="hidden" name="recipient_id" value="{{ $recipient->id }}">

        <div class="form-group">
            <label for="subject">Subject:</label>
            <input type="text" name="subject" id="subject" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="body">Notification Body:</label>
            <textarea name="body" id="body" class="form-control" rows="4" required></textarea>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Send Notification</button>
        </div>
    </form>
</div>
