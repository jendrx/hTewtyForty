<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 11/7/17
 * Time: 2:24 PM
 */

namespace App\Controller;


class ChartsController extends AppController
{

    public function getIndicatorData()
    {
        if($this->request->is('ajax'))
        {
            $params = $this->request->getQueryParams();

            $scenario   = $params['scenario'];
            $indicator  = $params['indicator'];
            $confidence = $params['confidence'];

            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL            => 'http://localhost:8000/indicatorData?scenario='.$params['scenario'].'&indicator='.$params['indicator'].'&confidence='.$params['confidence']
            ]);
            $response = json_decode(curl_exec($ch));
            curl_close($ch);
        }

        $this->set(compact('response'));
        $this->set('_serialize',['response']);

    }



}