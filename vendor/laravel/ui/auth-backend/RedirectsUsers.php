<?php

namespace Illuminate\Foundation\Auth;

trait RedirectsUsers
{
    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }

        if (property_exists($this, 'redirectTo')) {
            $redirectTo = $this->redirectTo;

            // Check if the redirectTo property starts with "http://" and replace it with "https://"
            if (strpos($redirectTo, 'http://') === 0) {
                $redirectTo = 'https://' . substr($redirectTo, 7);
            }

            return $redirectTo;
        }

        return '/home'; // Default redirect path
    }
}