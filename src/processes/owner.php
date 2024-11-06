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
                error_log('Success',3,'errors/error.log');
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
}