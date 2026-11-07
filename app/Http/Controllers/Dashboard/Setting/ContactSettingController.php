<?php

namespace App\Http\Controllers\Dashboard\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Setting\UpdateContactSettingRequest;
use App\Services\Dashboard\Setting\ContactSettingService;

class ContactSettingController extends Controller
{
    protected $contactService;

    public function __construct(ContactSettingService $contactService)
    {
        $this->contactService = $contactService;
    }

    public function edit()
    {
        $setting = $this->contactService->getContactSetting();
        return view('dashboard.contact_settings.edit', compact('setting'));
    }

    public function update(UpdateContactSettingRequest $request)
    {
        $this->contactService->updateContactSetting($request->validated());

        return redirect()->route('admin.contact-settings.edit')->with('success', 'Contact settings updated successfully.');
    }
}
