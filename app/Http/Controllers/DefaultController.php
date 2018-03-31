<?php
namespace App\Http\Controllers;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Leafo\ScssPhp\Compiler;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class DefaultController extends Controller {

    public $repositories = [
      'nachtmodus' =>
          [
                  'uri' => 'https://github.com/custom-tweakers/nachtmodus.git',
              'stylesheets' => ['nachtmodus.scss']
          ]
    ];

    public function index() {
        return view('welcome');
    }

    public function stylesheet(Request $request) {
        //get nessecary GET parameters
        $darkMode = (bool)$request->input('darkMode', false);
        $onlyNight = (bool)$request->input('onlyNight', false);
        $latitude = (float)$request->input('latitude', 52.282338);
        $longitude = (float)$request->input('longitude', 5.638759);


        //TODO: shorter
        $sunrise = date_sunrise(time(),SUNFUNCS_RET_TIMESTAMP,$latitude,$longitude);
        $sunset = date_sunset(time(),SUNFUNCS_RET_TIMESTAMP,$latitude,$longitude);
        $time = time();
        $night = !((date('His',$sunrise)<date('His',$sunset))
            ?(date('His',$sunrise) < date('His',$time) && date('His',$sunset) > date('His',$time))
            :(date('His',$sunrise) < date('His',$time) && date('His',$sunset) < date('His',$time)));
        $dark = ($darkMode)?(($onlyNight)?$night:true):false;


        $hash = md5($dark);
        $uri = 'tweakers-css-'.$hash.'.css';
        if(!Storage::disk('local')->exists($uri)) {
            $scss = new Compiler;
            $scss->addImportPath('../git');
            $css = '';
            if($dark)
                $css .= $scss->compile('@import nachtmodus/nachtmodus');

            Storage::disk('local')->put($uri, $css);
        }
        return response(Storage::get($uri),200)->header('Content-Type', 'text/css');
    }

    public function update(Request $request) {
        $header = $request->header('X-Hub-Signature');
        if(strpos($header,'=') === false)
            throw new BadRequestHttpException('Please provide signature');
        list($algo, $signature) = explode('=',$header);
        if($algo != 'sha1') {
            throw new BadRequestHttpException('Alorithm must be sha1');
        }
        $payloadHash = hash_hmac($algo,$request->getContent(),env('UPDATE_SECRET'));

        if($payloadHash === $signature) {
            $result = array();
            foreach ($this->repositories as $name=>$repository) {
                exec('git -C "../git/'.$name.'" pull '. $repository['uri'], $result);
            }

            //remove all cached files
            $toDelete = Storage::allFiles('',false);
            foreach ($toDelete as $item)
                Storage::delete($item);

            return response('',204);
        } else
            throw new AccessDeniedHttpException('Invalid signature');
    }


}
