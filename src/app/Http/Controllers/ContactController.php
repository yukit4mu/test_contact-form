<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->only([
            'last-name',
            'first-name',
            'gender',
            'email',
            'first-tel',
            'second-tel',
            'third-tel',
            'address',
            'building',
            'category_id',
            'detail'
        ]);
        return view('confirm', ['contact' => $contact]);
    }

    public function store(Request $request)
    {
        if ($request->get('action') === 'modify') {
            return redirect()->route('form.write')->withInput();
        }
        $form = $request->only([
            'last-name',
            'first-name',
            'gender',
            'email',
            'first-tel',
            'second-tel',
            'third-tel',
            'address',
            'building',
            'category_id',
            'detail'
        ]);
        Contact::create($form);
        return view('thanks');
    }

}
