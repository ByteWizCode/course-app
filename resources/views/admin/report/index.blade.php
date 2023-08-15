@extends('layout.backend.app',[
'title' => 'Manage Report',
'pageTitle' =>'Manage Report',
])

@push('css')
<link href="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="notify"></div>

<div class="card">
  <div class="card-body">
    <form method="get" action="{{ route('reportresult.index') }}">
      <div class="row">
        <div class="col-sm-3">
          <div class="form-group">
            <label for="rszs">Member Customer</label>
            <select name="Member" id="rszs" class="form-control">
              <option value="">- Choose One -</option>
              <option value="non member">Non Member</option>
              <option value="silver">Silver</option>
              <option value="gold">Gold</option>
              <option value="platinum">Platinum</option>
            </select>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <label for="arszs">Course Name</label>
            <select name="CourseID" id="arszs" class="form-control">
              <option value="">- Choose One -</option>
              @foreach($courses as $course)
              <option value="{{$course->ID}}">{{$course->CourseName}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <label for="brszs">Instructor Name</label>
            <select name="InstructorID" id="brszs" class="form-control">
              <option value="">- Choose One -</option>
              @foreach($instructors as $instructor)
              <option value="{{$instructor->ID}}">{{$instructor->InstructorName}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="col-sm-3">
          <label style="color: #fff;" for="rszs">.</label><br />
          <button class="btn btn-md btn-primary">Get Report</a>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Modal Create -->
<div class="modal fade" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="create-modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="create-modalLabel">Create Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="createForm">
          <div class="form-group">
            <label for="rszs">Course</label>
            <select name="TopicID" id="rszs" class="form-control">
              <option disabled="">- Choose One -</option>
              @foreach($courses as $course)
              <option value="{{$course->ID}}">{{$course->CourseName}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="rss">Instructor</label>
            <select name="InstructorID" id="rss" class="form-control">
              <option disabled="">- Choose One -</option>
              @foreach($instructors as $instructor)
              <option value="{{$instructor->ID}}">{{$instructor->InstructorName}}</option>
              @endforeach
            </select>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary btn-store">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal Create -->

<!-- Modal Edit -->
<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="edit-modalLabel">Edit Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editForm">
          <input type="hidden" required="" id="id" name="ID" class="form-control">
          <div class="form-group">
            <label for="TopicID">Course</label>
            <select name="TopicID" id="TopicID" class="form-control">
              <option disabled="">- Choose One -</option>
              @foreach($courses as $course)
              <option value="{{$course->ID}}">{{$course->CourseName}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="InstructorID">Instructor</label>
            <select name="InstructorID" id="InstructorID" class="form-control">
              <option disabled="">- Choose One -</option>
              @foreach($instructors as $instructor)
              <option value="{{$instructor->ID}}">{{$instructor->InstructorName}}</option>
              @endforeach
            </select>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary btn-update">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal Edit -->

<!-- Destroy Modal -->
<div class="modal fade" id="destroy-modal" tabindex="-1" role="dialog" aria-labelledby="destroy-modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="destroy-modalLabel">Yakin Hapus ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-danger btn-destroy">Hapus</button>
      </div>
    </div>
  </div>
</div>
<!-- Destroy Modal -->

@stop

@push('js')
<script src="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('template/backend/sb-admin-2') }}/js/demo/datatables-demo.js"></script>

<script type="text/javascript">
  $(function() {

    var table = $('.data-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('qualification.index') }}",
      columns: [{
          data: 'DT_RowIndex',
          name: 'ID'
        },
        {
          data: 'TopicID',
          name: 'TopicID'
        },
        {
          data: 'InstructorID',
          name: 'InstructorID'
        },
        {
          data: 'action',
          name: 'action',
          orderable: false,
          searchable: true
        },
      ]
    });
  });


  // Reset Form
  function resetForm() {
    $("[name='TopicID']").val("")
    $("[name='InstructorID']").val("")
  }
  //

  // Create 

  $("#createForm").on("submit", function(e) {
    e.preventDefault()

    $.ajax({
      url: "/admin/qualification",
      method: "POST",
      data: $(this).serialize(),
      success: function() {
        $("#create-modal").modal("hide")
        $('.data-table').DataTable().ajax.reload();
        flash("success", "Data berhasil ditambah")
        resetForm()
      }
    })
  })

  // Create

  // Edit & Update
  $('body').on("click", ".btn-edit", function() {
    var id = $(this).attr("id")

    $.ajax({
      url: "/admin/qualification/" + id + "/edit",
      method: "GET",
      success: function(response) {
        $("#edit-modal").modal("show")
        $("#id").val(response.ID)
        $("#TopicID").val(response.TopicID)
        $("#InstructorID").val(response.InstructorID)
      }
    })
  });

  $("#editForm").on("submit", function(e) {
    e.preventDefault()
    var id = $("#id").val()

    $.ajax({
      url: "/admin/qualification/" + id,
      method: "PATCH",
      data: $(this).serialize(),
      success: function() {
        $('.data-table').DataTable().ajax.reload();
        $("#edit-modal").modal("hide")
        flash("success", "Data berhasil diupdate")
      }
    })
  })
  //Edit & Update

  $('body').on("click", ".btn-delete", function() {
    var id = $(this).attr("id")
    $(".btn-destroy").attr("id", id)
    $("#destroy-modal").modal("show")
  });

  $(".btn-destroy").on("click", function() {
    var id = $(this).attr("id")

    $.ajax({
      url: "/admin/qualification/" + id,
      method: "DELETE",
      success: function() {
        $("#destroy-modal").modal("hide")
        $('.data-table').DataTable().ajax.reload();
        flash('success', 'Data berhasil dihapus')
      }
    });
  })

  function flash(type, message) {
    $(".notify").html(`<div class="alert alert-` + type + ` alert-dismissible fade show" role="alert">
                              ` + message + `
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>`)
  }
</script>
@endpush