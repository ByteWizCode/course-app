<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;

use App\Models\Qualification;
use App\Models\Instructor;
use App\Models\Course;
use App\Models\Transaction;
use App\Models\DetailTransaction;

class UserController extends Controller
{
	public function index()
	{
		$qualifications = Qualification::join('instructors', 'instructors.ID', '=', 'qualifications.InstructorID')
			->join('courses', 'courses.ID', '=', 'qualifications.TopicID')
			->get(['qualifications.*', 'courses.CourseName', 'instructors.InstructorName']);

		$instructors = Instructor::select('*')->orderBy('ID', 'ASC');
		$courses = Course::select('*')->where('isActive', '1')->orderBy('ID', 'ASC');
		$imagelists = ['gambar1.png', 'gambar2.png', 'gambar3.png', 'gambar4.png', 'gambar5.png', 'gambar6.png', 'gambar7.png', 'gambar8.png'];

		$_courses = $courses->get();
		foreach ($_courses as &$_course) {
			$_course->Image = $imagelists[array_rand($imagelists)];
			$_course->OutputPrice = 'Rp ' . number_format($_course->Price, 0, '.', '.');
			$_course->PriceLast = $_course->Price;
			$_course->PercentagePrice = 0;
			$_course->DiscountPrice = 0;

			if (Auth::user()->member == 'silver') {
				$_course->PercentagePrice = $_course->Price / 100 * 5;
				$_course->PriceLast = $_course->Price - $_course->PercentagePrice;
				$_course->DiscountPrice = 5;
			} elseif (Auth::user()->member == 'gold') {
				$_course->PercentagePrice = $_course->Price / 100 * 10;
				$_course->PriceLast = $_course->Price - $_course->PercentagePrice;
				$_course->DiscountPrice = 10;
			} elseif (Auth::user()->member == 'platinum') {
				$_course->PercentagePrice = $_course->Price / 100 * 15;
				$_course->PriceLast = $_course->Price - $_course->PercentagePrice;
				$_course->DiscountPrice = 15;
			}

			$_course->OutputPriceLast = 'Rp ' . number_format($_course->PriceLast, 0, '.', '.');
		}

		return view('user.index', ['qualifications' => $qualifications, 'instructors' => $instructors->get(), 'courses' => $_courses]);
	}

	public function enrolled()
	{
		$qualifications = Transaction::join('detailtransactions', 'transactions.ID', '=', 'detailtransactions.TransID')
			->join('courses', 'courses.ID', '=', 'detailtransactions.CourseID')
			->join('instructors', 'instructors.ID', '=', 'detailtransactions.InstructorID')
			->where('transactions.CustName', Auth::user()->name)
			->get(['courses.CourseName', 'courses.Days', 'courses.IsCertificate', 'courses.IsActive', 'detailtransactions.Discount', 'detailtransactions.Price', 'detailtransactions.StartDate', 'instructors.InstructorName']);

		$instructors = Instructor::select('*')->orderBy('ID', 'ASC');
		$courses = Course::select('*')->where('isActive', '1')->orderBy('ID', 'ASC');
		$imagelists = ['gambar1.png', 'gambar2.png', 'gambar3.png', 'gambar4.png', 'gambar5.png', 'gambar6.png', 'gambar7.png', 'gambar8.png'];

		$_courses = $courses->get();
		foreach ($_courses as &$_course) {
			$_course->Image = $imagelists[array_rand($imagelists)];
			$_course->OutputPrice = 'Rp ' . number_format($_course->Price, 0, '.', '.');
			$_course->PriceLast = $_course->Price;
			$_course->PercentagePrice = 0;
			$_course->DiscountPrice = 0;

			if (Auth::user()->member == 'silver') {
				$_course->PercentagePrice = $_course->Price / 100 * 5;
				$_course->PriceLast = $_course->Price - $_course->PercentagePrice;
				$_course->DiscountPrice = 5;
			} elseif (Auth::user()->member == 'gold') {
				$_course->PercentagePrice = $_course->Price / 100 * 10;
				$_course->PriceLast = $_course->Price - $_course->PercentagePrice;
				$_course->DiscountPrice = 10;
			} elseif (Auth::user()->member == 'platinum') {
				$_course->PercentagePrice = $_course->Price / 100 * 15;
				$_course->PriceLast = $_course->Price - $_course->PercentagePrice;
				$_course->DiscountPrice = 15;
			}

			$_course->OutputPriceLast = 'Rp ' . number_format($_course->PriceLast, 0, '.', '.');
		}

		$_courses = $courses->get();
		foreach ($qualifications as &$_qualification) {
			$_qualification->Image = $imagelists[array_rand($imagelists)];
			$_qualification->OutputPrice = 'Rp ' . number_format($_course->Price, 0, '.', '.');
			$_qualification->PriceLast = $_course->Price;
			$_qualification->PercentagePrice = 0;
			$_qualification->DiscountPrice = 0;

			if (Auth::user()->member == 'silver') {
				$_qualification->PercentagePrice = $_qualification->Discount;
				$_qualification->PriceLast = $_qualification->Price - $_qualification->PercentagePrice;
				$_qualification->DiscountPrice = 5;
			} elseif (Auth::user()->member == 'gold') {
				$_qualification->PercentagePrice = $_qualification->Discount;
				$_qualification->PriceLast = $_qualification->Price - $_qualification->PercentagePrice;
				$_qualification->DiscountPrice = 10;
			} elseif (Auth::user()->member == 'platinum') {
				$_qualification->PercentagePrice = $_qualification->Discount;
				$_qualification->PriceLast = $_qualification->Price - $_qualification->PercentagePrice;
				$_qualification->DiscountPrice = 15;
			}

			$_qualification->OutputPriceLast = 'Rp ' . number_format($_qualification->PriceLast, 0, '.', '.');
		}

		return view('user.enrolled', ['qualifications' => $qualifications, 'instructors' => $instructors->get(), 'courses' => $_courses]);
	}

	public function generateRandomString($length = 8)
	{
		return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
	}

	public function submitcourse(Request $request, Transaction $transaction, DetailTransaction $detailTransaction)
	{
		$prepareData = [
			'TransCode' => $this->generateRandomString(),
			'TransDate' => date('Y-m-d'),
			'CustName' => Auth::user()->name,
			'Member' => Auth::user()->member,
			'Subtotal' => $request->subtotalFinal,
			'Discount' => $request->discountFinal,
			'Total' => $request->totalFinal
		];
		// dd($request->all());
		$transactionInsert = $transaction->insert($prepareData);
		if ($transactionInsert == true) {
			$transactionId = DB::getPdo()->lastInsertId();
			foreach ($request->courseId as $key => $courseId) {
				if (in_array($courseId, $request->selectedCourse)) {
					$_prepareData = [
						'TransID' => $transactionId,
						'CourseID' => $courseId,
						'InstructorID' => $request->selectedInstructors[$key],
						'StartDate' => date('Y-m-d'),
						'Price' => $request->price[$key],
						'Discount' => $request->discountPrice[$key],
					];
					$detailTransaction->insert($_prepareData);
				}
			}
			return back()->with('success', 'Order Berhasil Terimakasih!');
		} else {
			return back()->with('error', 'Order Gagal Silahkan Coba Kembali');
		}
	}
}
