<?php
namespace ToDoSoft\Traits;

use GuzzleHttp\Client;

trait Api {
    /**
     * Send a request to any service
     * @return string
     */
    public function performRequest( $method, $requestUrl, $formParams = [], $headers = [] ) {

        try {
            $client = new Client( [
                'base_uri' => $this->BASE_URL,
            ] );
    
            if ( isset( $this->_TOKEN ) ) {
                $headers['Authorization'] = "Bearer {$this->_TOKEN}";
            }
    
            $response = $client->request( $method, $requestUrl, ['form_params' => $formParams, 'headers' => $headers] );
    
            return $response->getBody()->getContents();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
        
    }

    public function performRequestFile( $method, $requestUrl, $multipart = [], $headers = [] ) {
        try {
            $client = new Client( [
                'base_uri' => $this->BASE_URL,
            ] );
    
            if ( isset( $this->_TOKEN ) ) {
                $headers['Authorization'] = "Bearer {$this->_TOKEN}";
            }
    
            $response = $client->request( $method, $requestUrl, ['multipart' => $this->formatMultipart($multipart), 'headers' => $headers] );
    
            return $response->getBody()->getContents();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
        
    }

    private function formatMultipart($data){
        $new_data = [];

        foreach($data as $key => $value){
            $new_data[] = [
                'name' => $key,
                'contents' => $value,
            ];
        }

        return $new_data;
    }
}
