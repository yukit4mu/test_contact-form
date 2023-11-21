<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Contact;
use App\Models\Category;
use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CsvDownloadController extends Controller
{
    public function downloadCsv()
    {
        $contacts = Contact::all();
        $csvHeader = [
            'id',
            'category_id',
            'last_name',
            'first_name',
            'gender',
            'email',
            'tel',
            'detail',
            'address',
            'building',
            'created_at',
            'updated_at',
        ];

        $response = new StreamedResponse(function () use ($csvHeader, $contacts) {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, $csvHeader);


            foreach ($contacts as $contact) {

                $row = array_map('utf8_encode', $contact->toArray());
                fputcsv($handle, $row);
            }

            fclose($handle);
        }, Response::HTTP_OK, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="contacts.csv"',
        ]);

        return $response;
    }
}

