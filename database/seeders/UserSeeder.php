<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Hash;

class UserSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('users')->insert([
			[
				'name'      => 'Admin',
				'email'     => 'admin@gmail.com',
				'password'  => Hash::make('password'),
				'role'      => 'admin',
				'gender'    => 'Pria',
				'member'    => 'default'
			],
			[
				'name'      => 'Anggita',
				'email'     => 'anggita@gmail.com',
				'password'  => Hash::make('password'),
				'role'      => 'user',
				'gender'    => 'Wanita',
				'member'    => 'platinum'
			],
			[
				'name'      => 'Rini',
				'email'     => 'rini@gmail.com',
				'password'  => Hash::make('password'),
				'role'      => 'user',
				'gender'    => 'Wanita',
				'member'    => 'gold'
			],
			[
				'name'      => 'Yudi',
				'email'     => 'yudi@gmail.com',
				'password'  => Hash::make('password'),
				'role'      => 'user',
				'gender'    => 'Pria',
				'member'    => 'silver'
			],
			[
				'name'      => 'Bili',
				'email'     => 'bili@gmail.com',
				'password'  => Hash::make('password'),
				'role'      => 'user',
				'gender'    => 'Pria',
				'member'    => 'non member'
			],
		]);
		DB::table('courses')->insert([
			[
				'CourseName' => '15 days Mastering React Native',
				'Price' => 150000,
				'Days' => 15,
				'IsCertificate' => 1,
				'IsActive' => 1,
			],
			[
				'CourseName' => '30 days Mastering Flutter',
				'Price' => 150000,
				'Days' => 30,
				'IsCertificate' => 1,
				'IsActive' => 1,
			],
			[
				'CourseName' => 'Learn How to Customize CS-Cart & Magento',
				'Price' => 300000,
				'Days' => 60,
				'IsCertificate' => 1,
				'IsActive' => 1,
			],
			[
				'CourseName' => 'Java Springboot for Bank Company Study Case',
				'Price' => 125000,
				'Days' => 15,
				'IsCertificate' => 1,
				'IsActive' => 1,
			],
			[
				'CourseName' => 'Python for Beginner',
				'Price' => 150000,
				'Days' => 15,
				'IsCertificate' => 1,
				'IsActive' => 1,
			],
			[
				'CourseName' => 'Mastering SEO only 15 days',
				'Price' => 100000,
				'Days' => 15,
				'IsCertificate' => 1,
				'IsActive' => 0,
			],
			[
				'CourseName' => 'Design Graphics for Beginner',
				'Price' => 100000,
				'Days' => 15,
				'IsCertificate' => 0,
				'IsActive' => 0,
			],
		]);
		DB::table('instructors')->insert([
			[
				'InstructorName' => 'Maximilian Schwarzmuller',
				'Age' => 30,
				'Gender' => 'Male',
				'ExpYear' => 10,
				'ExpDesc' => 'React Native & Flutter Experts',
			],
			[
				'InstructorName' => 'Jose Portilla',
				'Age' => 33,
				'Gender' => 'Male',
				'ExpYear' => 7,
				'ExpDesc' => 'Flutter Expers',
			],
			[
				'InstructorName' => 'Yudhistira Salmanan',
				'Age' => 25,
				'Gender' => 'Male',
				'ExpYear' => 3,
				'ExpDesc' => 'CS-Cart & Magento Tutor',
			],
			[
				'InstructorName' => 'Mohammed Singh',
				'Age' => 38,
				'Gender' => 'Male',
				'ExpYear' => 11,
				'ExpDesc' => 'CS-Cart, Magent, Java & Python Specialist',
			],
			[
				'InstructorName' => 'Rina Indrawati',
				'Age' => 23,
				'Gender' => 'Female',
				'ExpYear' => 5,
				'ExpDesc' => 'SEO & Online Marketing Tutor',
			],
		]);
		DB::table('qualifications')->insert([
			[
				'TopicID' => 1,
				'InstructorID' => 1,
			],
			[
				'TopicID' => 2,
				'InstructorID' => 2,
			],
			[
				'TopicID' => 3,
				'InstructorID' => 3,
			],
			[
				'TopicID' => 4,
				'InstructorID' => 4,
			],
			[
				'TopicID' => 5,
				'InstructorID' => 4,
			],
			[
				'TopicID' => 6,
				'InstructorID' => 5,
			],
			[
				'TopicID' => 7,
				'InstructorID' => 5,
			],
			[
				'TopicID' => 2,
				'InstructorID' => 1,
			],
			[
				'TopicID' => 3,
				'InstructorID' => 4,
			],
		]);
	}
}
