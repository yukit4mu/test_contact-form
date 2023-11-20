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

    public function confirm(ContactRequest $request) //ここから
    {
        $contact = $request->all();

        $frontTel = implode(",", $request->only(['front-tel']));
        $middleTel = implode(",", $request->only(['middle-tel']));
        $backTel = implode(",", $request->only(['back-tel']));
        $entireTel = $frontTel . $middleTel . $backTel;

        $lastName = implode(",", $request->only(['last_name']));
        $firstName = implode(",", $request->only(['first_name']));
        $fullName = $lastName . " " . $firstName;

        return view('confirm', ['contact' => $contact, 'entireTel' => $entireTel, 'fullName' => $fullName]);
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

        $genderType = implode(",", $request->only('gender'));
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
//一旦、fortify見る
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
        return view('admin', ['contact' => $contacts]);
    }

    public function search(Request $request)
    {
        $query = Contact::query();
        $contacts = $request->all();

        //admin.bladeに入力された値をリクエストからアクセスして取得
        $name_email_search = $request->name_email_search;
        $gender_search = $request->gender_search;
        $category_search = $request->category_search;
        $date_search = $request->date_search;

        //firstとlastで分ける限界が来た
        if (!empty($name_email_search)) {
            $query->where('fullname', 'like', '%' . $name_email_search . '%')->orWhere('email', 'like', '%' . $name_email_search . '%');
        }
        if (!empty($gender_search)) {
            $query->where('gender', $gender_search);
        }
        if (!empty($category_search)) {
            $query->where('category_id', $category_search);
        }
        if (!empty($date_search)) {
            $query->where('created_at', '%' . $date_search . '%');
        }

        for ($i = 0; $i < count($contacts); $i++) {
            $contact_gender = $contacts[$i]["gender"];
            $contact_category = $contacts[$i]["category_id"];
            if ($contact_gender == 1) {
                $contacts[$i]["gender"] = "男性";
            } elseif ($contact_gender == 2) {
                $contacts[$i]["gender"] = "女性";
            } elseif ($contact_gender == 3) {
                $contacts[$i]["gender"] = "その他";
            }
        }

        $contacts = $query->Paginate(10);
        return view('admin', ['contact' => $contacts]);
    }


    public function delete(Request $request)
    {
        $contact = Contact::findOrFail($request->id);
        $contact->delete();
        return redirect('/admin');
    }
}
