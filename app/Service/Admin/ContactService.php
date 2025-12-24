<?php

namespace App\Service\Admin;

use App\Models\Contact;

class ContactService
{
    public function getAll()
    {
        return Contact::latest()->get();
    }

    public function find(int $id): ?Contact
    {
        return Contact::find($id);
    }

    public function store(array $data): Contact
    {
        return Contact::create($data);
    }

    public function update(Contact $contact, array $data): Contact
    {
        $contact->update($data);
        return $contact;
    }

    public function delete(Contact $contact): void
    {
        $contact->delete();
    }
}

