<div id="ct-content">
    <div class="co-title">Contact us</div>
    <div id="co-form">
        <form id="fInfo" action="index.php?p=check-out" method="post">
            <label>Email</label><input id="ct-email" name="email" type="email" placeholder="Please input your email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="ie: quando@gmail.com"/>
            <label id="ct-subject">Subject</label>
                <select id="ct-select" name="subject">
                    <option value="1">General Enquiry</option>
                    <option value="2">Group and Corporate Bookings</option>
                    <option value="3">Suggestions &amp; Complaints</option>
                </select>
            <label>Message</label><input name="name" type="text" required placeholder="Your enquiry here" />
            <input type="submit" class="button co-submit" value="Submit Enquiry"/>
        </form>
    </div>
</div>