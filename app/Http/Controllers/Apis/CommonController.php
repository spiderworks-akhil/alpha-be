<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Http\Resources\FrontendPage as ResourcesFrontendPage;
use App\Models\FrontendPage;
use App\Traits\App;
use App\Models\Setting;
use App\Services\MailSettings;
use App\Models\Lead;
use App\Http\Requests\ContactRequest;
use App\Http\Resources\CommonPageResource;
use App\Http\Resources\FaqCollection;
use App\Http\Resources\LeadCollection;
use App\Http\Resources\Lead as LeadResource;
use App\Models\Faq;
use App\Models\Page;
use DB;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    use App;
    public function menu($position){
        return response()->json(['data' => $this->getMenu($position)]);
    }

    public function settings(){
        $settings = $this->getSettings();
        return response()->json(['data' => $settings]);
    }

    public function page(string $slug){
        $page_settings = FrontendPage::with(['faq', 'og_image'])->where('slug', $slug)->where('status', 1)->first();
        if(!$page_settings)
            return response()->json(['error' => 'Page not Found!'], 404);
        return new ResourcesFrontendPage($page_settings);
    }

    public function company_page(string $slug){
        $page = Page::where('slug', $slug)->where('status', 1)->first();
        if(!$page)
            return response()->json(['error' => 'Page not Found!'], 404);

        return new CommonPageResource($page);
    }

    public function contact_save(ContactRequest $request){
        $request->validated();
        $contact = new Lead;
        $contact->fill($request->all());
        $contact->save();

        $notif_emails = Setting::where('code', 'contact_notification_email_ids')->first();

        if($notif_emails && trim($notif_emails->value_text) != '')
        {
            $mail = new MailSettings;
            $email_array = explode(',', $notif_emails->value_text);
            array_filter($email_array, function($value){ 
                return !is_null($value) && $value !== '';
            });
            $email_array = array_map('trim', $email_array);
            $mail->to($email_array)->send(new \App\Mail\Contact($contact));
        } 
        if($contact->email){
                $thank_mail = new MailSettings;
                $thank_mail->to($contact->email)->send(new \App\Mail\ContactThankyou($contact));
        }
        return response()->json(['success' => true]);
    }

    public function list_urls($page){
        $urls = [];
        if($page == "company"){
            $urls = DB::table('pages')->select('slug')->where('status', 1)->get();
        }
        elseif($page == "blog"){
            $urls = DB::table('blogs')->select('slug')->where('status', 1)->get();
        }
        return response()->json($urls);
    }

    public function faq(Request $request){

        $limit = ($request->limit)?$request->limit:12;
        $faqs = Faq::whereHasMorph('linkable', '*', function($query){
                $query->where('status', 1);
        });

        if($search = $request->search){
            $faqs->where(function($query) use($search){
                $query->whereRaw("MATCH (question) AGAINST ('{$search}')")->orWhereRaw("MATCH (answer) AGAINST ('{$search}')")->orWhere('question', 'LIKE', '%'.$search.'%')->orWhere('answer', 'LIKE', '%'.$search.'%');
            });
        }
        $faqs = $faqs->paginate($limit);
        return new FaqCollection($faqs);
        
    }

    public function leads(Request $request){

        $limit = ($request->limit)?$request->limit:12;
        $leads = Lead::where('status', 1);
        
        if($search = $request->search){
            $leads->where(function($query) use($search){
                $query->whereRaw("MATCH (name) AGAINST ('{$search}')")->orWhereRaw("MATCH (email) AGAINST ('{$search}')")->orWhere('phone_number', 'LIKE', '%'.$search.'%')->orWhere('created_at', 'LIKE', '%'.$search.'%');
            });
        }
        $leads = $leads->paginate($limit);

        return new LeadCollection($leads);
        
    }
    public function leads_view($id){

        $lead = Lead::where('status', 1)->find($id);
        
        if (!$lead)
            return response()->json(['error' => 'Page not Found!'], 404);

        return new LeadResource($lead);
        
    }
}
