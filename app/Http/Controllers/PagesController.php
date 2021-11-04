<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    // Contact section...
    public function getContact() {
      return view('pages.contact');
    }

    // Privacy Policy section
    public function getPrivacyPolicy() {
      return view('pages.privacypolicy');
    }

    // Terms and Conditions section
    public function getTermsAndConditions() {
      return view('pages.termsandconditions');
    }
}
