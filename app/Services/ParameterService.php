<?php

namespace App\Services;

use App\Models\Setting;

readonly class ParameterService
{
    public function getParameter(string $name): mixed
    {
        $data = Setting::where('name', $name)->first();
        if ($data) {
            return $data->meta;
        }
        return $data;
    }

    /**
     * @return string[]
     */
    public function getRequestFormEmails(): array 
    {
        $emailsRaw = $this->getParameter('request_form_emails');

        return explode(',', $emailsRaw);
    }

    /**
     * @return string[]
     */
    public function getContactFormEmails(): array
    {
        $emailsRaw = $this->getParameter('email');
        return $emailsRaw;
    }

    public function getEmailCredentials(): array
    {
        $result = $this->getParameter('email smtp');
        return $result;
    }
}
