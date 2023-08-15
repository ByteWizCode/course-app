@extends('layout.backend.app',[
'title' => 'Index',
'pageTitle' => 'Course',
])
@section('content')
@include('layout.component.alert-dismissible')

<style>
  .activeClass {
    background: #0080001f !important;
  }
</style>

<h5>Hello, <strong>{{ Auth::user()->name }}</strong></h5>
<h5>Member Status: <strong class="__text">{{ strtoupper(Auth::user()->member) }}</strong></h5>
<br />
<p class="lead">Choose Your Course to Learn</p>
<hr class="my-4">
<!-- <p>Anda login sebagai {{ Auth::user()->role }}.</p> -->

<div class="jumbotron" style="padding: 0.5rem;">
  <div class="container my-3">
    <form id="submitcourse" name="submitcourse" method="POST" action="{{ route('user.submitcourse') }}">
      @csrf
      <div class="row">
        @foreach($courses as $course)
        <input style="display: none;" id="checkbox{{ $course->ID }}" type="checkbox" name="selectedCourse[]" value="{{ $course->ID }}" />
        <input type="hidden" name="courseId[]" value="{{ $course->ID }}" />
        <input type="hidden" name="price[]" value="{{ $course->Price }}" />
        <input type="hidden" name="priceLast[]" value="{{ $course->PriceLast }}" />
        <input type="hidden" name="discountPrice[]" value="{{ $course->PercentagePrice }}" />

        <div class="col-12 col-sm-6 col-md-4">
          <div class="card mt-4" id="courseId{{ $course->ID }}">
            <img class="card-img-top" src="{{ asset('images/course/'.$course->Image) }}">
            <div class="card-body">
              <h5 class="card-title text-center titleEqualHeight">{{ $course->CourseName }}</h5>
              <p class="card-text">
              <ul>
                @if ($course->Price != $course->PriceLast)
                <li>Price: <s>{{ $course->OutputPrice }}</s> {{ $course->OutputPriceLast }}</li>
                <li>Discount: Save {{ $course->DiscountPrice }}%!</li>
                @else
                <li>Price: {{ $course->OutputPrice }}</li>
                @endif
                <li>Days: {{ $course->Days }}</li>
                <li>Certificate: {{ $course->IsCertificate == 1 ? 'Yes' : 'No' }}</li>
              </ul>
              <div class="text-center">
                <div class="form-group">
                  <label>Select Instructor</label>
                  <select class="form-control" name="selectedInstructors[]">
                    @foreach($qualifications as $qualification)
                    @if ($qualification->TopicID == $course->ID)
                    <option value="{{ $qualification->InstructorID }}">{{ $qualification->InstructorName }}</option>
                    @endif
                    @endforeach
                  </select>
                </div>
              </div>
              <!-- <font style="text-align: center;">Some quick example text to build on the card title and make up the bulk of the card's content.</font> -->
              </p>
              <a class="btn btn-md btn-primary" id="active{{ $course->ID }}" style="cursor: pointer; width: 100%;" onclick="addClass('{{ $course->ID }}', '{{ $course->Price }}', '{{ $course->PercentagePrice }}')">Choose Course</a>
              <a class="btn btn-md btn-danger" id="remove{{ $course->ID }}" style="cursor: pointer; width: 100%; display: none;" onclick="removeClass('{{ $course->ID }}', '{{ $course->Price }}', '{{ $course->PercentagePrice }}')">Remove Course</a>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      <input type="hidden" id="subtotalFinal" name="subtotalFinal" />
      <input type="hidden" id="discountFinal" name="discountFinal" />
      <input type="hidden" id="totalFinal" name="totalFinal" />
    </form>
    <hr />
    <div class="container my-3">
      <div class="row">
        <div class="col-12 col-sm-12 col-md-12">
          <table class="table table-borderless">
            <tr>
              <td>
                <h5>Subtotal</h5>
              </td>
              <td>
                <h5 id="subtotal">-</h5>
              </td>
            </tr>
            <tr>
              <td>
                <h5 class="text-danger">Discount</h5>
              </td>
              <td>
                <h5 class="text-danger" id="discount">-</h5>
              </td>
            </tr>
            <tr>
              <td>
                <h5>Total</h5>
              </td>
              <td>
                <h5 id="total">-</h5>
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <a onclick='submitForm();' class="btn btn-md btn-success" style="width: 100%; cursor: pointer;">Place Order</a>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>

  <script>
    sessionStorage.setItem('subtotal', 0)
    sessionStorage.setItem('discount', 0)
    sessionStorage.setItem('total', 0)

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

    function addClass(idName, price, discountPrice) {
      // perbedaannya hanya disini
      document.getElementById("checkbox" + idName).checked = true;
      var element = document.getElementById('courseId' + idName);
      element.classList.add("activeClass");
      document.getElementById('remove' + idName).style.display = "block";
      document.getElementById('active' + idName).style.display = "none";
      // end

      let member = '{{ Auth::user()->member }}'
      let subtotal = sessionStorage.subtotal
      let total = 0
      let discount = sessionStorage.discount

      // perbedaannya hanya disini
      subtotal = parseInt(subtotal) + parseInt(price)
      discount = parseInt(discount) + parseInt(discountPrice)
      // end

      total = subtotal - discount

      sessionStorage.setItem('subtotal', subtotal)
      sessionStorage.setItem('discount', discount)
      sessionStorage.setItem('total', total)

      document.getElementById('subtotal').innerHTML = ""
      document.getElementById('discount').innerHTML = ""
      document.getElementById('total').innerHTML = ""

      document.getElementById('subtotal').innerHTML = formatRupiah(subtotal, 'Rp ')
      document.getElementById('discount').innerHTML = '-' + formatRupiah(discount, 'Rp ')
      document.getElementById('total').innerHTML = formatRupiah(total, 'Rp ')

      document.getElementById("subtotalFinal").value = subtotal;
      document.getElementById("discountFinal").value = discount;
      document.getElementById("totalFinal").value = total;
    }

    function removeClass(idName, price, discountPrice) {
      // perbedaannya hanya disini
      document.getElementById("checkbox" + idName).checked = false;
      var element = document.getElementById('courseId' + idName);
      element.classList.remove("activeClass");
      document.getElementById('remove' + idName).style.display = "none";
      document.getElementById('active' + idName).style.display = "block";
      // end

      let member = '{{ Auth::user()->member }}'
      let subtotal = sessionStorage.subtotal
      let total = 0
      let discount = sessionStorage.discount

      // perbedaannya hanya disini
      subtotal = parseInt(subtotal) - parseInt(price)
      discount = parseInt(discount) - parseInt(discountPrice)
      // end

      total = subtotal - discount

      sessionStorage.setItem('subtotal', subtotal)
      sessionStorage.setItem('discount', discount)
      sessionStorage.setItem('total', total)

      document.getElementById('subtotal').innerHTML = ""
      document.getElementById('discount').innerHTML = ""
      document.getElementById('total').innerHTML = ""

      document.getElementById('subtotal').innerHTML = formatRupiah(subtotal, 'Rp ')
      document.getElementById('discount').innerHTML = '-' + formatRupiah(discount, 'Rp ')
      document.getElementById('total').innerHTML = formatRupiah(total, 'Rp ')

      document.getElementById("subtotalFinal").value = subtotal;
      document.getElementById("discountFinal").value = discount;
      document.getElementById("totalFinal").value = total;
    }

    function submitForm() {
      if (sessionStorage.total && sessionStorage.total > 0) {
        document.getElementById("submitcourse").submit();
      } else {
        alert('Pilih Course terlebih dahulu')
      }
    }
  </script>
  @endsection