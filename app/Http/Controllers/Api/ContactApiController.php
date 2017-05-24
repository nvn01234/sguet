<?php

namespace App\Http\Controllers\Api;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactApiController extends Controller
{
    private function toJstreeData($children, Request $request)
    {
        $result = [];
        foreach ($children as $child) {
            /**
             * @var Contact $child
             */
            $json = (object)$this->show($child->id, $request);
            if ($child->children->isNotEmpty()) $json->children = true;
            $result[] = $json;
        }
        return $result;
    }

    public function show($id, Request $request)
    {
        /**
         * @var Contact $contact
         */
        $contact = Contact::query()->findOrFail($id);
        $result = [
            'id' => $contact->id,
            'parent' => isset($contact->parent) ? $contact->parent->id : '#',
            'text' => str_limit($contact->name, 60),
            'data' => [
                'description' => $contact->description,
                'phone_cq' => $contact->phone_cq,
                'phone_nr' => $contact->phone_nr,
                'phone_dd' => $contact->phone_dd,
                'fax' => $contact->fax,
                'email' => $contact->email ? \Html::mailto($contact->email)->toHtml() : '',
            ],
            'state' => [
                'opened' => true
            ],
            'a_attr' => [
                'href' => 'javascript:',
                'data-container' => 'body',
                'data-original-title' => $contact->description ? "$contact->name ($contact->description)" : $contact->name,
                'class' => 'tooltips',
            ],
        ];
        return $result;
    }

    public function roots(Request $request)
    {
        $contacts = Contact::query()->whereNull('parent_id')->get();
        return $this->toJstreeData($contacts, $request);
    }

    public function children($id, Request $request)
    {
        /**
         * @var Contact $contact
         */
        $contact = Contact::query()->findOrFail($id);
        return $this->toJstreeData($contact->children, $request);
    }

    private function toSearchResult($contacts)
    {
        $all = Contact::pluck('id')->toArray();
        $opened = [];
        $result = [];

        foreach ($contacts as $contact) {
            /**
             * @var Contact $contact
             */
            $result[] = $contact->id;
            $opened = array_unique(array_merge($opened, $contact->getAncestors()->pluck('id')->toArray()));
        }

        $hidden = array_divide(array_diff($all, $opened, $result))[1];
        return response(compact('opened', 'result', 'hidden'), 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function search(Request $request)
    {
        $q = trim($request->get('q', ''));

        $contacts = Contact::query()
            ->where('name', 'LIKE', "%$q%")
            ->orWhere('description', 'LIKE', "%$q%")
            ->get();
        if ($request->has('debug')) {
            return response()->json($contacts);
        } else {
            return $this->toSearchResult($contacts);
        }
    }
}
