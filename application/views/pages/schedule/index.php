<div class="row">
  <div class="col">
    <div class="card">
      <!-- Card header -->
      <div class="card-header border-0">
        <h3 class="mb-0">Jadwal Rapat</h3>
      </div>
      <div class="card-body">
        <div id="calendar"></div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="scheduleModal" tabindex="-1" aria-labelledby="scheduleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="scheduleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="meeting_title">Judul Rapat</label>
          <input type="text" class="form-control bg-white" id="meeting_title" name="meeting_title" readonly>
        </div>
        <div class="form-group">
          <label for="description">Deskripsi</label>
          <textarea name="description" class="form-control bg-white" id="description" rows="5" readonly></textarea>
        </div>
        <div class="form-group">
          <label for="start_time">Mulai pada</label>
          <input type="text" class="form-control bg-white" id="start_time" name="start_time" readonly>
        </div>
        <div class="form-group">
          <label for="finish_time">Selesai pada</label>
          <input type="text" class="form-control bg-white" id="finish_time" name="finish_time" readonly>
        </div>
        <div class="form-group">
          <label for="meeting_participant">Jumlah Peserta</label>
          <input type="number" min="1" class="form-control bg-white" id="meeting_participant" name="meeting_participant" readonly>
        </div>
        <div class="form-group">
          <label for="room_name">Ruangan</label>
          <input type="text" class="form-control bg-white" id="room_name" name="room_name" readonly>
        </div>
        <div class="form-group">
          <label for="room_name">Dibooking oleh</label>
          <input type="text" class="form-control bg-white" id="booker" name="booker" readonly>
        </div>
        <div class="form-group">
          <label for="supporting_file">Berkas Pendukung</label>
          <p>
            <a id="supporting_file"></a>
          </p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      headerToolbar: {
        left: 'prev,next',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
      },
      events: [
        <?php
        foreach ($meetings as $meeting) :
        ?> {
            id: '<?= $meeting->id ?>',
            title: '<?= $meeting->meeting_title ?>',
            start: '<?= mdate('%Y-%m-%dT%H:%i', strtotime($meeting->start_time)) ?>',
            end: '<?= mdate('%Y-%m-%dT%H:%i', strtotime($meeting->finish_time)) ?>',
            <?php if ($meeting->accepted === null): ?>
              backgroundColor: 'gray',
            <?php else: ?>
              backgroundColor: '<?= $meeting->accepted === 't' ? 'green' : 'red' ?>',
            <?php endif ?>
            extendedProps: {
              booker: '<?= $meeting->user_fullname === null ? $meeting->guest_fullname : $meeting->user_fullname ?>',
              meeting_participant: '<?= $meeting->meeting_participant ?>',
              room_name: '<?= $meeting->room_name ?>',
              description: '<?= $meeting->description ?>',
              supporting_file: '<?= $meeting->supporting_file ?>'
            }
          },
        <?php
        endforeach;
        ?>
      ],
      eventClick: function(info) {
        const modal = $('#scheduleModal');
        modal.find('.modal-title').text(`Rapat #${info.event.id}`);
        modal.find('#meeting_title').val(info.event.title);
        modal.find('#start_time').val(info.event.start);
        modal.find('#finish_time').val(info.event.end);
        modal.find('#meeting_participant').val(info.event.extendedProps.meeting_participant);
        modal.find('#booker').val(info.event.extendedProps.booker);
        modal.find('#room_name').val(info.event.extendedProps.room_name);
        modal.find('#description').val(info.event.extendedProps.description);
        if (info.event.extendedProps.supporting_file != '') {
          modal.find('#supporting_file').text('Unduh');
          modal.find('#supporting_file').addClass('btn btn-sm btn-outline-primary');
          modal.find('#supporting_file').attr('href', `<?= base_url('uploads') ?>/${info.event.extendedProps.supporting_file}`);
        } else {
          modal.find('#supporting_file').text('Tidak ada berkas');
          modal.find('#supporting_file').removeClass('btn btn-sm btn-outline-primary');
          modal.find('#supporting_file').removeAttr('href');
        }

        modal.modal('show');
      }
    });
    calendar.render();
  });
</script>