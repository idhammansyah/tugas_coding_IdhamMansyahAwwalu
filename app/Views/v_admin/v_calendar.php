<?= $this->extend('V_admin/header/header');?>
<?= $this->section('page-content');?>
<section class="section dashboard">
  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-header">
          <i class="bi bi-calendar3"></i>&nbsp; View Calendar
        </div>
        <div class="card-body">
          <div id="calendar"></div>
        </div>

        <div class="container-fluid mt-5">
          <h4 class="mt-3 text-center">Agenda Information</h4>
						<?php echo session_notif(); ?>
            <div class="row" id="info_tanggalan">
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="modal fade" id="tambah_data" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Events</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form id="formDate">
				<div class="modal-body">
					<div class="form-floating mb-3">
						<input type="text" class="form-control" name="title" id="titles" placeholder="name@example.com">
						<label for="floatingInput">Title</label>
					</div>
					<div class="form-floating mb-3">
						<input type="date" class="form-control" name="date" id="dates" placeholder="dates" readonly>
						<label for="floatingPassword">Date</label>
					</div>
					<div class="form-floating">
						<textarea class="form-control" id="comments" name="notes" placeholder="Leave a comment here"
							id="floatingTextarea" rows="5"></textarea>
						<label for="floatingTextarea">Notes</label>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp; Save activity</button>
				</div>
			</form>
		</div>
	</div>
	</div>
<?= $this->endSection();?>

<?= $this->section('scripts'); ?>
<script type="text/javascript">
  $(document).ready(function () {
    load_calendar();

    $('#formDate').submit(function (event) {
			// Prevent the default form submission
			event.preventDefault();

			// Serialize the form data
			let formData = $(this).serialize();

			// Send the serialized data using $.ajax
			$.ajax({
				type: 'POST',
				url: '<?= route_to('save_event_calendar'); ?>',
				data: formData,
				success: function (response) {
					// Handle the response from the server
					$("#dates").val('');
					$("#comments").val('');
					$("#titles").val('');

					$("#tambah_data").modal('hide');
          alertify.set('notifier', 'position', 'bottom-right');
          let responseString = JSON.stringify(response);
          if(responseString.indexOf("failed") !== -1) {
            alertify.error(response.status);
          } else{
            alertify.success(response.status);
          }
          setTimeout(function() {
            window.location.reload();
          }, 3000);
				},
				error: function (error) {
					// Handle errors
					console.error('Error:', error);
				}
			});
		});
  });

  function load_calendar() 
	{
		$.ajax({
		  url: '<?= route_to('load_events_calendar'); ?>',
			type: 'GET',
			error: function () {
				let my_calendar = $("#calendar").dnCalendar({
					dataTitles: {
						defaultDate: 'default',
						today: 'Today'
					},
					monthNames: [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ],
          monthNamesShort: [ 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dec' ],
					dayNames: [ 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
					dayNamesShort: [ 'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat' ],
					dayUseShortName: true,
					monthUseShortName: true,
					notes: [],
					showNotes: true,
					dayClick: function (date, view) {
						let clickedDate = $(this).text();
						if (clickedDate >= 1 && clickedDate <= 9) {
							clickedDate = '0' + clickedDate;
						}

						let clickedMonth = $(this).data("month");
						if (clickedMonth >= 1 && clickedMonth <= 9) {
							clickedMonth = '0' + clickedMonth;
						}

						let clickedYear = $(this).data("year");

						// show modal to add new tasks
						$("#tambah_data").modal('show');
						// and set date input value based on clicked
						$('#dates').val(clickedYear + "-" + clickedMonth + "-" + clickedDate);
					}
				});

				my_calendar.build();

				$("#info_tanggalan").append('\
					<div class="col-xl-12 col-md-12 col-sm-12 mt-3">\
						<div class="card shadow">\
							<div class="card-body">\
								<h5 class="text-danger text-center fw-bold">No data.</h5>\
							</div>\
						</div>\
					</div>'
				);
			},
			success: function (response) {
				let my_calendar = $("#calendar").dnCalendar({
					dataTitles: {
						defaultDate: 'default',
						today: 'Today'
					},
					monthNames: [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ],
					monthNamesShort: [ 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dec' ],
					dayNames: [ 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
					dayNamesShort: [ 'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat' ],
					dayUseShortName: true,
					monthUseShortName: true,
					notes: [],
					showNotes: true,
					dayClick: function (date, view) {
						let clickedDate = $(this).text();
						if (clickedDate >= 1 && clickedDate <= 9) {
							clickedDate = '0' + clickedDate;
						}
	
						let clickedMonth = $(this).data("month");
						if (clickedMonth >= 1 && clickedMonth <= 9) {
							clickedMonth = '0' + clickedMonth;
						}
	
						let clickedYear = $(this).data("year");
	
						// show modal to add new tasks
						$("#tambah_data").modal('show');
						// and set date input value based on clicked
						$('#dates').val(clickedYear + "-" + clickedMonth + "-" + clickedDate);
					}
				});
	
				my_calendar.build();

				let ingpo = [];
				// lalu me-explode array tsb
				response.forEach(function (item) 
				{
					let startDate = new Date(item.start_date);
	
					let formattedDate = startDate.toLocaleDateString('id-ID', {
						day: 'numeric',
						month: 'long',
						year: 'numeric'
					});
	
					let endDate = new Date(item.end_date);
	
					let formattedEnd = endDate.toLocaleDateString('id-ID', {
						day: 'numeric',
						month: 'long',
						year: 'numeric'
					});
	
					let created_at = new Date(item.created_at);
	
					let createds = created_at.toLocaleDateString('id-ID', {
						day: 'numeric',
						month: 'long',
						year: 'numeric'
					});
	
					ingpo.push({
						"date": item.start_date,
						// "note": `<div class="note">${item.notes_event}</div>`
						"note": item.title_events
					});
	
					my_calendar.update({
						notes: ingpo
					});
	
					$('#info_tanggalan').append('\
						<div class="col-xl-4 col-md-4 col-sm-12 mt-3">\
							<div class="card shadow mb-3">\
								<div class="card-body">\
									<div class="mb-3 card-text">\
										<label class="fw-bold text-info">Title : </label> \
										<h6>' + item.title_events + '</h6>\
									</div>\
									<div class="mb-3">\
										<label>Date Event : </label> \
										<h6>' + formattedDate + '</h6>\
									</div>\
									<div class="mb-3">\
										<label>Notes : </label>\
										<br>' + item.notes_events + '\
									</div>\
									<br><br><small class="text-muted float-end" style="font-size:8pt"> Dibuat oleh : '+ item.created_by +' pada ' + createds +'</small>\
								</div>\
								<div class="card-footer">\
									<a href="<?= base_url("4/delete-event")?>/'+item.id_events+'" class="float-end btn btn-danger">\
										<i class="bi bi-trash"></i>\
									</a>\
									<a href="<?= base_url('4/edit-event')?>/'+item.id_events+'" class="float-end btn btn-warning me-2">\
										<i class="bi bi-pencil-square"></i>\
									</a>\
								</div>\
							</div>\
						</div>'
					);
				});	
									
			}
		});
	}
</script>
<?= $this->endSection();?>