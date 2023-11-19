<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function confirm(Request $request)
    {
        $lastName = implode(",", $request->only(['last-name']));
        $firstName = implode(",", $request->only(['first-name']));
        $fullName = $lastName . " " . $firstName;

        $firstTel = implode(",", $request->only(['first-tel']));
        $secondTel = implode(",", $request->only(['second-tel']));
        $thirdTel = implode(",", $request->only(['third-tel']));
        $tel = $firstTel . $secondTel . $thirdTel;

        $contact = $request->only(['gender', 'email', 'first-tel', 'second-tel', 'third-tel', 'address', 'building', 'category_id', 'detail']);
        return view('confirm', ['contact' => $contact, 'fullname' => $fullName, 'tell' => $tel]);

        // $gender = $request->gender;
        // $email = $request->email;
        // $address = $request->address;
        // $building = $request->building;
        // $category = $request->category_id;
        // $detail = $request->detail;
    }

    public function store(Request $request)
    {

        $genderName = implode(",", $request->only(['gender']));
        if ($genderName == "男性") {
            $gender = 1;
        } elseif ($genderName == "女性") {
            $gender = 2;
        } elseif ($genderName == "その他") {
            $gender = 3;
        }

        $categoryContent = implode(",", $request->only(['category_id']));
        if ($categoryContent == "商品のお届けについて") {
            $category_id = 1;
        } elseif ($categoryContent == "商品の交換について") {
            $category_id = 2;
        } elseif ($categoryContent == "商品トラブル") {
            $category_id = 3;
        } elseif ($categoryContent == "ショップへのお問い合わせ") {
            $category_id = 4;
        } elseif ($categoryContent == "その他") {
            $category_id = 5;
        }

        $request->session()->flush();

        $form = $request->all();
        $form["gender"] = $gender;
        $form["category_id"] = $category_id;

        return view('thanks');
    }
}
