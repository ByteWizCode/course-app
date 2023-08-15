@extends('layout.backend.app',[
'title' => 'Transaction History',
'pageTitle' =>'Transaction History',
])

@push('css')
<link href="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="notify"></div>

<style>
  .modal-table td {
    white-space: normal;
  }

  .modal-body {
    overflow-x: auto;
  }
</style>

<div class="card">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered data-table">
        <thead>
          <tr>
            <th>No</th>
            <th>Transaction Code</th>
            <th>Transaction Date</th>
            <th>Customer Name</th>
            <th>Member</th>
            <th>Subtotal</th>
            <th>Discount</th>
            <th>Total</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
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
          <div class="form-group">
            <label for="TransCode">Transaction Code</label>
            <input readonly="readonly" id="TransCode" name="TransCode" class="form-control">
          </div>
          <div class="form-group">
            <label for="TransDate">Transaction Date</label>
            <input readonly="readonly" id="TransDate" name="TransDate" class="form-control">
          </div>
          <div class="form-group">
            <label for="CustName">Customer Name</label>
            <input readonly="readonly" id="CustName" name="CustName" class="form-control">
          </div>
          <div class="form-group">
            <label for="Member">Member</label>
            <input readonly="readonly" id="Member" name="Member" class="form-control">
          </div>
          <div class="form-group">
            <label for="Subtotal">Subtotal</label>
            <input readonly="readonly" id="Subtotal" name="Subtotal" class="form-control">
          </div>
          <div class="form-group">
            <label for="Discount">Discount</label>
            <input readonly="readonly" id="Discount" name="Discount" class="form-control">
          </div>
          <div class="form-group">
            <label for="Total">Total</label>
            <input readonly="readonly" id="Total" name="Total" class="form-control">
          </div>
          <div class="form-group">
            <label for="Total">Details</label>
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Course Name</th>
                    <th>Instructor Name</th>
                    <th>Start Date</th>
                    <th>Price</th>
                    <th>Discount</th>
                  </tr>
                </thead>
                <tbody id="details">
                </tbody>
              </table>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="submit" class="btn btn-primary btn-update">Update</button> -->
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
      ajax: "{{ route('transaction.index') }}?Member={{ $Member }}&CourseID={{ $CourseID }}&InstructorID={{ $InstructorID }}",
      columns: [{
          data: 'DT_RowIndex',
          name: 'ID'
        },
        {
          data: 'TransCode',
          name: 'TransCode'
        },
        {
          data: 'TransDate',
          name: 'TransDate'
        },
        {
          data: 'CustName',
          name: 'CustName'
        },
        {
          data: 'Member',
          name: 'Member'
        },
        {
          data: 'Subtotal',
          name: 'Subtotal'
        },
        {
          data: 'Discount',
          name: 'Discount'
        },
        {
          data: 'Total',
          name: 'Total'
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
  // function resetForm() {
  //   $("[name='TopicID']").val("")
  //   $("[name='InstructorID']").val("")
  // }
  //

  // Create 

  $("#createForm").on("submit", function(e) {
    e.preventDefault()

    $.ajax({
      url: "/user/transaction",
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
  function formatRupiah(angka, prefix) {
    var number_string = angka.toString(),
      split = number_string.split(','),
      sisa = split[0].length % 3,
      rupiah = split[0].substr(0, sisa),
      ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
      separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + '.' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '');
  }

  $('body').on("click", ".btn-edit", function() {
    var id = $(this).attr("id")
    $.ajax({
      url: "/user/transaction/" + id + "/edit",
      method: "GET",
      success: function(response) {
        $("#edit-modal").modal("show")
        // $("#id").val(response.ID)
        $("#TransCode").val(response.transaction.TransCode)
        $("#TransDate").val(response.transaction.TransDate)
        $("#CustName").val(response.transaction.CustName)
        $("#Member").val(response.transaction.Member.toUpperCase())
        $("#Subtotal").val(formatRupiah(response.transaction.Subtotal, 'Rp '))
        $("#Discount").val(formatRupiah(response.transaction.Discount, 'Rp '))
        $("#Total").val(formatRupiah(response.transaction.Total, 'Rp '))
        console.log(response)
        for (let i = 0; i < response.details.length; i++) {
          const item = response.details[i];
          $("#details").append(`
            <tr>
              <td>${item.CourseName}</td>
              <td>${item.InstructorName}</td>
              <td>${item.StartDate}</td>
              <td>${(item.Price != (item.Price - item.Discount) ? "<s>"+formatRupiah(item.Price, 'Rp ')+"</s>\n"+formatRupiah((item.Price - item.Discount), 'Rp ') : formatRupiah(item.Price, 'Rp '))}</td>
              <td>${formatRupiah(item.Discount, 'Rp ')}</td>
            </tr>
          `)
        }
      }
    })
  });

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