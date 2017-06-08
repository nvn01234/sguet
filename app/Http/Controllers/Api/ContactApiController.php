<?php

namespace App\Http\Controllers\Api;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;

class ContactApiController extends Controller
{
    /**
     * @param Collection $contacts
     * @return \Illuminate\Http\JsonResponse
     */
    private function mapToResponse($contacts)
    {
        $data = $contacts->map(function ($contact){
            /**
             * @var Contact $contact
             */
            return $contact->jstreeData();
        });
        return response()->json($data);
    }

    public function roots()
    {
        $roots = Contact::query()->whereNull('parent_id')->get();
        return $this->mapToResponse($roots);
    }

    public function children(Request $request)
    {
        /**
         * @var Contact $contact
         */
        $contact = Contact::findOrFail($request->get('id'));
        return $this->mapToResponse($contact->children);
    }

    public function data(Request $request)
    {
        /**
         * @var Contact $contact
         */
        $contact = Contact::findOrFail($request->get('id'));
        return response()->json($contact->jstreeData());
    }
}
