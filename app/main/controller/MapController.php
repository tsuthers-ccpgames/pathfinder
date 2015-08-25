<?php
/**
 * Created by PhpStorm.
 * User: exodus4d
 * Date: 08.02.15
 * Time: 21:18
 */

namespace Controller;

class MapController extends \Controller\AccessController {

    function __construct() {
        parent::__construct();
    }


    public function showMap($f3) {

        $f3->set('pageContent', false);

        // body element class
        $this->f3->set('bodyClass', 'pf-body');

        // set trust attribute to template
        $this->f3->set('trusted', (int)self::isIGBTrusted());

        // JS main file
        $this->f3->set('jsView', 'mappage');

         $this->setTemplate('templates/view/index.html');
    }

    /**
     * function is called on each error
     * @param $f3
     */
    public function showError($f3){

        // set HTTP status
        if(!empty($f3->get('ERROR.code'))){
            $f3->status($f3->get('ERROR.code'));
        }

        if($f3->get('AJAX')){
            header('Content-type: application/json');

            // error on ajax call
            $errorData = [
                'status' => $f3->get('ERROR.status'),
                'code' => $f3->get('ERROR.code'),
                'text' => $f3->get('ERROR.text')
            ];

            // append stack trace for greater debug level
            if( $f3->get('DEBUG') === 3){
                $errorData['trace'] = $f3->get('ERROR.trace');
            }

            echo json_encode($errorData);
        }else{
            echo $f3->get('ERROR.text');
        }

        die();
    }

} 