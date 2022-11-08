<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Contact\{ IndexContact, ShowContact, StoreContact, UpdateContact, DestroyContact };
use App\Models\Contact;
use App\Traits\Controllers\Api\v1\HasControllerHelpers;

class ContactController extends Controller
{
    use HasControllerHelpers;

    /**
     * Display a listing of the user_contacts.
     *
     * @param  \App\Http\Requests\Api\v1\Contact\IndexContact  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexContact $request)
    {
        $fields = $request->validated();
        $user_contacts = Contact::select();

        return $this->filtered($user_contacts, $fields);
    }

    /**
     * Display the specified user_contact.
     *
     * @param  \App\Models\Contact  $user_contact
     * @param  \App\Http\Requests\Api\v1\Contact\ShowContact  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $user_contact, ShowContact $request)
    {
        return $user_contact;
    }

    /**
     * Store a newly created user_contact in storage.
     *
     * @param  \App\Http\Requests\Api\v1\Contact\StoreContact  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContact $request)
    {
        $fields = array_merge($request->validated(), [
            'user_id' => auth()->id(),
        ]);

        return Contact::create($fields)->fresh();
    }

    /**
     * Update the specified user_contact in storage.
     *
     * @param  \App\Models\Contact  $user_contact
     * @param  \App\Http\Requests\Api\v1\Contact\UpdateContact  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Contact $user_contact, UpdateContact $request)
    {
        $fields = $request->validated();

        $user_contact->fill($fields);
        $user_contact->save();

        return $user_contact;
    }

    /**
     * Remove the specified user_contact from storage.
     *
     * @param  \App\Models\Contact  $user_contact
     * @param  \App\Http\Requests\Api\v1\Contact\DestroyContact  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $user_contact, DestroyContact $request)
    {
        $user_contact->delete();
        return response()->json(null, 204);
    }
}
