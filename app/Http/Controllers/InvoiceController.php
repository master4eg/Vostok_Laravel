<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Document;
use Barryvdh\DomPDF\Facade as PDF;

class InvoiceController extends Controller
{
    public function showDocument($id)
    {
        $user = $this->getUserInfo($id);
        $pdf = $this->generateDoc($user);
        return $pdf->stream();
    }

    private function getUserInfo(int $id)
    {
        $user = USER::where('id', $id)->first(['firstName', 'secondName', 'middleName', 'debt', 'stateFee']);
        if ($user === null) {
            exit(redirect()->route('users.index'));
        } else {
            $user = $user->only('firstName', 'secondName', 'middleName', 'debt', 'stateFee');
            return (array)$user;
        }
    }

    private function generateDoc(array $user)
    {
        $pdf = PDF::loadView('pdf.document', compact('user'));
        return $pdf;
    }

    public function downloadDocument(int $id)
    {
        $user = $this->getUserInfo($id);
        $pdf = $this->generateDoc($user);
        $docName = $id . '_' . uniqid() . '.pdf';
        return $pdf->download($docName);
    }

    public function saveDocument(int $id)
    {
        $user = $this->getUserInfo($id);
        $pdf = $this->generateDoc($user);
        $docName = $id . '_' . uniqid() . '.pdf';
        $path = storage_path($docName);

        $doc = new Document();
        $doc->document = $docName;
        $doc->userId = $id;
        $doc->save();

        $pdf->save($path);
        return redirect()->route('users.index');
    }
}
