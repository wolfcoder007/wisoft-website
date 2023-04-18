<?php

namespace Modules\Smtp\Http\Controllers\Api;

use Modules\Smtp\Emails\SendingEmail;
use Modules\Smtp\Emails\Subscribe;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Smtp\Entities\Provider;
use Modules\Smtp\Entities\Template;
use Modules\Smtp\Repositories\ProviderRepository;
use Modules\Smtp\Repositories\TemplateRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\Smtp\Emails\ContactRequestNotification;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;



class SendMailController extends AdminBaseController
{
    /**
     * @var ProviderRepository
     */
    private $provider;

    /**
     * @var TemplateRepository
     */
    private $template;


    public function __construct(ProviderRepository $provider, TemplateRepository $template)
    {
        parent::__construct();

        $this->provider = $provider;

        $this->template = $template;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {  
        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);

        if($validator->fails()){
            return new JsonResponse(['success' => false, 'message' => $validator->errors()], 422);
        } 

        $email = $request->all()['email'];

        $template_id = $request->all()['template'];

        $username = $request->all()['username'];


        $template_info = Template::find($template_id);

        $provider_id = $template_info->provider_id;
        $provider_info = Provider::find($provider_id);
        

        $email_from = $template_info->email_form;
        $email_to = $template_info->email_to;
        $subject = $template_info->subject;
        $body = $template_info->body;
        $header = $template_info->header;


        $config = array(
                    'driver'            => $provider_info->provider_name,
                    'host'              => $provider_info->smtp_host,
                    'port'              => $provider_info->smtp_port,
                    'encryption'        => $provider_info->email_encryption,
                    'username'          => $provider_info->user_name,
                    'password'          => $provider_info->password,
                    'from'              => [
                        'address'=>$provider_info->email,
                        'name'   => 'Wisoft'
                    ],
                    
                    'sendmail' => '/usr/sbin/sendmail -bs',
                    'pretend' => false,
        );

        if($provider_info->others != NULL){
            $others = $provider_info->others;
            $pairs = explode(", ", $others); 
            foreach ($pairs as $pair) {
            list($key, $value) = explode(":", $pair); // split each pair by colon
            $config[$key] = $value; // add the key-value pair to the result array
            }
        }

        //var_dump($config); die();
        Config::set('mail', $config);

            Mail::to($email_to)->send(new  SendingEmail($username, $body ,$subject, $email_from ));
            return new JsonResponse([
                'success' => true,
                'message' => "thanks for the subscribe, please check your  inbox"
            ], 200);

    }

    public function subscribe(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);

        if($validator->fails()){
            return new JsonResponse(['success' => false, 'message' => $validator->errors()], 422);
        } 

        $email = $request->all()['email'];

        
            Mail::to($email)->send(new Subscribe($email));
            return new JsonResponse([
                'success' => true,
                'message' => "thanks for the subscribe, please check your  inbox"
            ], 200);
        
    }

    
}
