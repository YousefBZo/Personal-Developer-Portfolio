<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ContactRequest;
use App\Models\Contact;
use App\Service\Admin\ContactService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function __construct(
        protected ContactService $contactService
    ) {}

    public function index(): View
    {
        $contacts = $this->contactService->getAll();
        return view('admin.contacts.index', compact('contacts'));
    }

    public function store(ContactRequest $request): RedirectResponse
    {
        $this->contactService->store($request->validated());

        return redirect()
            ->route('admin.contacts.index')
            ->with('success', 'Contact created successfully.');
    }

    public function update(ContactRequest $request, Contact $contact): RedirectResponse
    {
        $this->contactService->update($contact, $request->validated());

        return redirect()
            ->route('admin.contacts.index')
            ->with('success', 'Contact updated successfully.');
    }

    public function destroy(Contact $contact): RedirectResponse
    {
        $this->contactService->delete($contact);

        return redirect()
            ->route('admin.contacts.index')
            ->with('success', 'Contact deleted successfully.');
    }
}

