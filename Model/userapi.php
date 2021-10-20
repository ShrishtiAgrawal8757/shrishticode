<?php
namespace Exam\shrishti\Model;
error_reporting(0);

class adminapi implements \Exam\shrishti\Api\ExInterface
{
   

    public function getUser()
    {
        $responseArr = array("flag"=>false,"message"=>"");
        $getHeaders=apache_request_headers();
        $accessToken=$getHeaders['Authorization'];
        $json = file_get_contents('php://input');
        $decodedData = json_decode($json,1);
        $user_id = isset($decodedData['user_id'])?trim($decodedData['user_id']):"";
        $selectC = "select * from user ";
            $resC = $this->connection->fetchAll($selectC);
            if($resC>0)
            {
               
                $responseArr['flag'] = true;
                $responseArr['data'] = $resC;
                $responseArr['message'] = "successfully got user data";
               
               
                
            }
            
        
        else{
                
                $responseArr['message'] = "Failure to get user details";
        }
      
        exit;
    }

    private $connection;
    public function __construct()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance(); // Instance of object manager
        $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
        $this->connection = $resource->getConnection();
        
    }
  
}


?>
