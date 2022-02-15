<?php

namespace App\Services;

use GuzzleHttp\Client;

class ElasticSearchService
{
    protected $url;
    protected $http;
    protected $headers;

    public function all($from = 0, $size = 200) {
        $es = $this->es;
        $params['index'] = $this->index;
        $params['type'] = $this->type;
        $params['size'] = $size;
        $params['from'] = $from;
        try {
            $results = $es->search($params);
            $hits = $results['hits'];
            return $hits;
        } catch (\Exception $ex) {
            \Log::critical($ex);
            $this->apiError("ES - Unable to get Entries", 400);
        }
    }

    public function getById($id)    {        
       $es = $this->es;        
       $params['index'] = $this->index;        
       $params['type'] = $this->type;        
       $params['id'] = $id;
      try {            
            $retDelete = $es->delete($params);            
            return array("id" => $retDelete['_id']);        
       } catch (\Exception $ex) {            
            \Log::critical($ex);            
            return  $this->apiError('ES - Unable to Delete Entry', 400);       
       }    
    }
    public function create($input, $id = null)    {    
        $es = $this->es;
        $params['index'] = $this->index;   
        $params['type'] = $this->type;     
         $params['body'] = $input;
        try {        
          $result = $es->index($params);
          return array("id" => $result['_id']);
        } catch (\Exception $ex) {
           \Log::critical($ex);         
           return $this->apiError('ES - Unable to Create Entry', 400);     
        }    
    }

    public function update($id, $input)    {     
        $es = $this->es;     
        $params['index'] = $this->index;    
         $params['type'] = $this->type;   
          $params['id'] = $id;    
         $params['body']['doc'] = $input;
             try {          
        $retUpdate = $es->update($params);        
         return array("id" => $retUpdate['_id']);       
        } catch (\Exception $ex) {         
        \Log::critical($ex);         
        return $this->apiError('ES - Unable to Update Entry', 400);       
        }   
    }

    public function deleteById($id)    {        
       $es = $this->es;        
       $params['index'] = $this->index;        
       $params['type'] = $this->type;        
       $params['id'] = $id;
      try {            
            $retDelete = $es->delete($params);            
            return array("id" => $retDelete['_id']);        
       } catch (\Exception $ex) {            
            \Log::critical($ex);            
            return  $this->apiError('ES - Unable to Delete Entry', 400);       
       }    
    }

}


