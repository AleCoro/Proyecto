<!-- Footer Start -->
<div class="container-fluid bg-secondary text-white mt-5 py-5 px-sm-3 px-md-5">
  <div class="row pt-5">
    <div class="col-lg-3 col-md-6 mb-5">
      <a href="" class="navbar-brand font-weight-bold text-primary m-0 mb-4 p-0" style="font-size: 40px; line-height: 40px">
        <i class="flaticon-043-teddy-bear"></i>
        <span class="text-white">KidKinder</span>
      </a>
      <p>
        Labore dolor amet ipsum ea, erat sit ipsum duo eos. Volup amet ea
        dolor et magna dolor, elitr rebum duo est sed diam elitr. Stet elitr
        stet diam duo eos rebum ipsum diam ipsum elitr.
      </p>
      <div class="d-flex justify-content-start mt-4">
        <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0" style="width: 38px; height: 38px" href="#"><i class="fab fa-twitter"></i></a>
        <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0" style="width: 38px; height: 38px" href="#"><i class="fab fa-facebook-f"></i></a>
        <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0" style="width: 38px; height: 38px" href="#"><i class="fab fa-linkedin-in"></i></a>
        <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0" style="width: 38px; height: 38px" href="#"><i class="fab fa-instagram"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-5">
      <h3 class="text-primary mb-4">Get In Touch</h3>
      <div class="d-flex">
        <h4 class="fa fa-map-marker-alt text-primary"></h4>
        <div class="pl-3">
          <h5 class="text-white">Address</h5>
          <p>123 Street, New York, USA</p>
        </div>
      </div>
      <div class="d-flex">
        <h4 class="fa fa-envelope text-primary"></h4>
        <div class="pl-3">
          <h5 class="text-white">Email</h5>
          <p>info@example.com</p>
        </div>
      </div>
      <div class="d-flex">
        <h4 class="fa fa-phone-alt text-primary"></h4>
        <div class="pl-3">
          <h5 class="text-white">Phone</h5>
          <p>+012 345 67890</p>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-5">
      <h3 class="text-primary mb-4">Quick Links</h3>
      <div class="d-flex flex-column justify-content-start">
        <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Home</a>
        <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>About Us</a>
        <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Our Classes</a>
        <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Our Teachers</a>
        <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Our Blog</a>
        <a class="text-white" href="#"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-5">
      <h3 class="text-primary mb-4">Newsletter</h3>
      <form action="">
        <div class="form-group">
          <input type="text" class="form-control border-0 py-4" placeholder="Your Name" required="required" />
        </div>
        <div class="form-group">
          <input type="email" class="form-control border-0 py-4" placeholder="Your Email" required="required" />
        </div>
        <div>
          <button class="btn btn-primary btn-block border-0 py-3" type="submit">
            Submit Now
          </button>
        </div>
      </form>
    </div>
  </div>
  <div class="container-fluid pt-5" style="border-top: 1px solid rgba(23, 162, 184, 0.2) ;">
    <p class="m-0 text-center text-white">
      &copy;
      <a class="text-primary font-weight-bold" href="#">Your Site Name</a>.
      All Rights Reserved.

      <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
      Designed by
      <a class="text-primary font-weight-bold" href="https://htmlcodex.com">HTML Codex</a>
      <br />Distributed By:
      <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
    </p>
  </div>
</div>
<!-- Footer End -->

<!-- Back to Top -->
<a href="#" class="btn btn-primary p-3 back-to-top"><i class="fa fa-angle-double-up"></i></a>

<!-- FULL CALENDAR -->
<!-- jQuery -->
<script src="admin/views/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="admin/views/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jQuery UI -->
<script src="admin/views/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- AdminLTE App -->
<script src="admin/views/dist/js/adminlte.min.js"></script>
<!-- fullCalendar 2.2.5 -->
<script src="admin/views/plugins/moment/moment.min.js"></script>
<script src="admin/views/plugins/fullcalendar/main.js"></script>

<!-- Page specific script -->
<script>
  $(function() {

    /* initialize the external events
     -----------------------------------------------------------------*/
    function ini_events(ele) {
      ele.each(function() {

        // create an Event Object (https://fullcalendar.io/docs/event-object)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        }

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject)

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex: 1070,
          revert: true, // will cause the event to go back to its
          revertDuration: 0 //  original position after the drag
        })

      })
    }

    ini_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d = date.getDate(),
      m = date.getMonth(),
      y = date.getFullYear()

    var Calendar = FullCalendar.Calendar;
    var Draggable = FullCalendar.Draggable;

    var containerEl = document.getElementById('external-events');
    var checkbox = document.getElementById('drop-remove');
    var calendarEl = document.getElementById('calendar');

    // initialize the external events
    // -----------------------------------------------------------------

    new Draggable(containerEl, {
      itemSelector: '.external-event',
      eventData: function(eventEl) {
        return {
          title: eventEl.innerText,
          backgroundColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
          borderColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
          textColor: window.getComputedStyle(eventEl, null).getPropertyValue('color'),
        };
      }
    });

    var calendar = new Calendar(calendarEl, {
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      themeSystem: 'bootstrap',
      //Random default events
      events: [{
          title: 'All Day Event',
          start: new Date(y, m, 1),
          backgroundColor: '#f56954', //red
          borderColor: '#f56954', //red
          allDay: true
        },
        {
          title: 'Long Event',
          start: new Date(y, m, d - 5),
          end: new Date(y, m, d - 2),
          backgroundColor: '#f39c12', //yellow
          borderColor: '#f39c12' //yellow
        },
        {
          title: 'Meeting',
          start: new Date(y, m, d, 10, 30),
          allDay: false,
          backgroundColor: '#0073b7', //Blue
          borderColor: '#0073b7' //Blue
        },
        {
          title: 'Lunch',
          start: new Date(y, m, d, 12, 0),
          end: new Date(y, m, d, 14, 0),
          allDay: false,
          backgroundColor: '#00c0ef', //Info (aqua)
          borderColor: '#00c0ef' //Info (aqua)
        },
        {
          title: 'Birthday Party',
          start: new Date(y, m, d + 1, 19, 0),
          end: new Date(y, m, d + 1, 22, 30),
          allDay: false,
          backgroundColor: '#00a65a', //Success (green)
          borderColor: '#00a65a' //Success (green)
        },
        {
          title: 'Click for Google',
          start: new Date(y, m, 28),
          end: new Date(y, m, 29),
          url: 'https://www.google.com/',
          backgroundColor: '#3c8dbc', //Primary (light-blue)
          borderColor: '#3c8dbc' //Primary (light-blue)
        }
      ],
      editable: true,
      droppable: true, // this allows things to be dropped onto the calendar !!!
      drop: function(info) {
        // is the "remove after drop" checkbox checked?
        if (checkbox.checked) {
          // if so, remove the element from the "Draggable Events" list
          info.draggedEl.parentNode.removeChild(info.draggedEl);
        }
      }
    });

    calendar.render();
    // $('#calendar').fullCalendar()

    /* ADDING EVENTS */
    var currColor = '#3c8dbc' //Red by default
    // Color chooser button
    $('#color-chooser > li > a').click(function(e) {
      e.preventDefault()
      // Save color
      currColor = $(this).css('color')
      // Add color effect to button
      $('#add-new-event').css({
        'background-color': currColor,
        'border-color': currColor
      })
    })
    $('#add-new-event').click(function(e) {
      e.preventDefault()
      // Get value and make sure it is not null
      var val = $('#new-event').val()
      if (val.length == 0) {
        return
      }

      // Create events
      var event = $('<div />')
      event.css({
        'background-color': currColor,
        'border-color': currColor,
        'color': '#fff'
      }).addClass('external-event')
      event.text(val)
      $('#external-events').prepend(event)

      // Add draggable funtionality
      ini_events(event)

      // Remove event from text input
      $('#new-event').val('')
    })
  });
</script>
</body>

</html>