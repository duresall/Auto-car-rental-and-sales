
<aside class="col-md-6 offset-md-3">
<div class="sidebar_widget text-center">
    <div class="widget_heading">
        <h5><i class="fa fa-envelope" aria-hidden="true"></i> Schedule Appointment</h5>
    </div>
    <form method="post">
        <div class="form-group">
            <label>Vehicle Plate Number:</label>
            <input type="text" class="form-control" name="plate_number" placeholder="Vehicle Plate Number" required>
        </div>
        <div class="form-group">
            <label>Message:</label>
            <textarea rows="4" class="form-control" name="message" placeholder="Message" required></textarea>
        </div>
        <?php if($_SESSION['login']) { ?>
            <div class="form-group">
                <input type="submit" class="btn"  name="submit" value="Request Appointment">
            </div>
        <?php } else { ?>
            <a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal">Login To Schedule</a>
        <?php } ?>
    </form>
</div>
</aside>

