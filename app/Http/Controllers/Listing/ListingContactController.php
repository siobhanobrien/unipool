<?php

namespace App\Http\Controllers\Listing;

use Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreListingContactFormRequest;
use App\Mail\ListingContactCreated;

class ListingContactController extends Controller
{
    public function __construct()
    {
    	return $this->middleware(['auth']);
    }

    public function store(StoreListingContactFormRequest $request)
    {


    	Mail::to('3ac0da2705-55ddf0@inbox.mailtrap.io')->queue(
    		new ListingContactCreated($request->user(), $request->message)



    		);





    }
}
