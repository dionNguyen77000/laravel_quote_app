<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author;
use App\Quote;
use App\Authorlog;
use App\Events\QuoteCreated;
use Illuminate\Support\Facades\Event;

class QuoteController extends Controller
{
    public function getIndex($author = null)
    {
        $quotes = "";
        if(!is_null($author)){
            $quote_author = Author::whereName($author)->first();

            if($quote_author){
                $quotes = $quote_author->quotes()->orderBy('created_at', 'desc')->paginate(6);
                return view('index', ['quotes' => $quotes]);
            } else {
                echo "doesnot exist the user you input";
            }
        } else {
            $quotes = Quote::orderBy('created_at', 'desc')->paginate(6);
            return view('index', ['quotes' => $quotes]);
        }
        //return dd($quotes);

    }
    public function postQuote(Request $request){

        $this->validate($request,[
           'author' => 'required|max:60|alpha',
            'email' => 'required|email',
            'quote' => 'required|max:500'
        ]);
        $authorText = ucfirst($request['author']);
        $quoteText = $request['quote'];
        $email = $request['email'];

        $author = Author :: whereName($authorText)->first();
        if(!$author){
            $author = new Author();
            $author->name = $authorText;
            $author->email = $email;
            $author ->save();
        }
        $quote = new Quote();
        $quote-> quote = $quoteText;
        $author->quotes()->save($quote);
        
        Event::fire(new QuoteCreated($author)); //fire the event
        return redirect()->route('index')->with([
            'success' => 'Quote saved!'
        ]);
    }

    public function getDeleteQuote($quote_id){
        $quote = Quote::find($quote_id);
        $author_deleted = false;
        if(count($quote->author->quotes)===1){
            $quote->author->delete();
            $author_deleted = true;
        }
        $quote->delete();
        $msg = $author_deleted ? 'Quote and author deleted' : 'Quote deleted!' ;
        return redirect()->route('index')->with(['success'=>$msg]);
    }

    /**
     * @param $author_name
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getMailCallback($author_name)
    {
        $author_log= new Authorlog();
        $author_log->author = $author_name;
        $author_log->save();

        return view('email.callback', ['author' => $author_name]);
    }
}
