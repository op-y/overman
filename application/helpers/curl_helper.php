<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Function to call API by cURL
 *
 * @access public
 * @param url
 * @param method
 * @param data
 * @param header
 * @return object
 */
if ( ! function_exists('curl_call')) {
	function curl_call($url, $method='POST', $data=null, $header=null)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        
        if ($header != null) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }

        if ($method == 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        } elseif($method == 'PUT') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        } else {
            curl_setopt($ch, CURLOPT_POST, false);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
	}
}

