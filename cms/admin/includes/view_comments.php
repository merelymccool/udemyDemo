<!-- Page title -->
<h3>View All Comments</h3>

<!-- Posts table -->
<table class="table table-bordered table-hover table-responsive">
    <thead>
        <tr>
            <th>ID</th>
            <th>Post ID</th>
            <th>Author</th>
            <th>Email</th>
            <th>Status</th>
            <th>Content</th>
            <th>Date</th>
            <th>Options</th>
        </tr>
    </thead>
    <tbody>
        <?php viewAllComments(); ?>
    </tbody>
</table>

<?php commentOptions(); ?> 