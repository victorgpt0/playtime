<?php
class owner{

    public function facilities($conn,$ObjGlobal){
       if(isset($_POST['facility'])){

        $f_errors=[];

        print "<div class='container' id='main-content'>";

        $facilityName =$_SESSION['facilityName'] = $conn->escape_values(ucwords($_POST['facilityName']));
        $facilityType = $_SESSION['facilityType']=$conn->escape_values($_POST['facilityType']);
        $facilityPrice =$_SESSION['facilityPrice']=$conn->escape_values($_POST['facilityPrice']);
        $description= $_SESSION['description']=$conn->escape_values($_POST['description']);
        $latitude = $_SESSION['latitude']=$conn->escape_values($_POST['latitude']);
        $longitude =$_SESSION['longitude']=$conn->escape_values($_POST['longitude']);
        $address = $_SESSION['address']=$conn->escape_values($_POST['address']);

        $status=$_SESSION['statusType']=$conn->escape_values($_POST['statusType']);
        //print $facilityName.$facilityType.$facilityPrice.$latitude.$longitude.$address;

        if($facilityType==='Other'){
            $other=$_SESSION['otherFacilityType']=$conn->escape_values(ucwords(strtolower($_POST['otherFacilityType'])));
            if(empty($other)){
                $f_errors['empty_input_err']='Fill all fields appropriately.';
            }
        }

        if(empty($facilityName) || empty($facilityType) || empty($facilityPrice) || empty($description) ||empty($status)){
            $f_errors['empty_input_err']='Fill all fields appropriately.';
        }
        
        if(empty($latitude) || empty($longitude) || empty($address)){
            $f_errors['empty_location_err']='Search for your Location on the Map and point at the marker on the map to set the location.';
        }
        if(!count($f_errors)){
            $key=['name','description','latitude','longitude','place_id','price_per_hour','userid','statusId','typeId'];
            $value=[$facilityName,$description,$latitude,$longitude,$address,$facilityPrice,$_SESSION['user']['u_id'],$status,$facilityType];
            $data=array_combine($key,$value);
            try{
            if($conn->insert('tbl_facilities',$data)===true){
                header("Location : facilities.php");
                error_log("Success inserting to DB",3,'errors/error.log');
            }else{
                error_log('Failure at owner.php insert()',3,'errors/error.log');
            }
        }catch(Exception $e){
            error_log($e->getMessage());
        }


        }else{
            $ObjGlobal->setMsg('f_error',$f_errors,'invalid');
        }

        

        
        print "</div>";
       }       
    }
    public function editFacility($conn, $ObjGlobal){
        if(isset($_POST['editFacility'])){

            $f_editerrors=[];
    
            print "<div class='container' id='main-content'>";
    
            $facilityEditName =$_SESSION['facilityEditName'] = $conn->escape_values(ucwords($_POST['facilityEditName']));
            $facilityEditType = $_SESSION['facilityEditType']=$conn->escape_values($_POST['facilityEditType']);
            $facilityEditPrice =$_SESSION['facilityEditPrice']=$conn->escape_values($_POST['facilityEditPrice']);
            $editDescription= $_SESSION['editDescription']=$conn->escape_values($_POST['editDescription']);
            // $latitude = $_SESSION['latitude']=$conn->escape_values($_POST['latitude']);
            // $longitude =$_SESSION['longitude']=$conn->escape_values($_POST['longitude']);
            // $address = $_SESSION['address']=$conn->escape_values($_POST['address']);
    
            $editStatus=$_SESSION['statusEditType']=$conn->escape_values($_POST['statusEditType']);
            //print $facilityEditName.' '.$facilityEditType.' '.$facilityEditPrice.' '.$editStatus;
            $facilityEditID=$_SESSION['facilityEditID']=$conn->escape_values($_POST['facilityEditID']);
     
            if($facilityEditType==='Other'){
                $other=$_SESSION['otherFacilityEditType']=$conn->escape_values(ucwords(strtolower($_POST['otherFacilityEditType'])));
                if(empty($other)){
                    $f_editerrors['empty_input_err']='Fill all fields appropriately.';
                }
            }
    
            if(empty($facilityEditName) || empty($facilityEditType) || empty($facilityEditPrice) || empty($editDescription) ||empty($editStatus)){
                $f_editerrors['empty_input_err']='Fill all fields appropriately.';
            }
        
            if(!count($f_editerrors)){
                
                try{
                    
                if($conn->update('tbl_facilities',[
                    'name'=>$facilityEditName,
                    'description'=>$editDescription,
                    'price_per_hour'=>$facilityEditPrice,
                    'statusId'=>$editStatus,
                    'typeId'=>$facilityEditType
                ],'facilityId='.$facilityEditID) === true){
                    error_log("Success updating to DB ",3,'errors/error.log');
                }else{
                    error_log('Failure at owner.php update()',3,'errors/error.log');
                }
            }catch(Exception $e){
                error_log($e->getMessage());
            }
    
    
            }else{
                $ObjGlobal->setMsg('f_editerror',$f_editerrors,'invalid');
            }
    
            
    
            
            print "</div>";
           }   
    }
}