<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->all();

        $firstTel = implode(",", $request->only(['first-tel']));
        $secondTel = implode(",", $request->only(['second-tel']));
        $thirdTel = implode(",", $request->only(['third-tel']));
        $tel = $firstTel . $secondTel . $thirdTel;

        return view('confirm', ['contact' => $contact, 'tel' => $tel]);
    }

    public function store(Request $request)
    {
        if ($request->get('action') === 'modify') {
            return redirect()->route('rewrite')->withInput();
        }

        $contact = $request->only([
            'category_id',
            'first_name',
            'last_name',
            'gender',
            'email',
            'tel',
            'address',
            'building',
            'detail',
        ]);

        $genderType = implode(",", $request->only(['gender']));
        if ($genderType == "男性") {
            $contact['gender'] = 1;
        } elseif ($genderType == "女性") {
            $contact['gender'] = 2;
        } elseif ($genderType == "その他") {
            $contact['gender'] = 3;
        }

        $categoryType = implode(",", $request->only(['category_id']));
        if ($categoryType == "商品のお届けについて") {
            $contact['category_id'] = 1;
        } elseif ($categoryType == "商品の交換について") {
            $contact['category_id'] = 2;
        } elseif ($categoryType == "商品トラブル") {
            $contact['category_id'] = 3;
        } elseif ($categoryType == "ショップへのお問い合わせ") {
            $contact['category_id'] = 4;
        } elseif ($categoryType == "その他") {
            $contact['category_id'] = 5;
        }

        Contact::create($contact);
        return view('thanks');
    }

    public function admin()
    {
        $contacts = Contact::Paginate(10);

        for ($i = 0; $i < count($contacts); $i++) {
            $contact_gender = $contacts[$i]['gender'];
            if ($contact_gender == 1) {
                $contacts[$i]['gender'] = "男性";
            } elseif ($contact_gender == 2) {
                $contacts[$i]['gender'] = "女性";
            } elseif ($contact_gender == 3) {
                $contacts[$i]['gender'] = "その他";
            }
        }
        return view('admin', compact('contacts'));
    }
}
