<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of addquestion
 *
 * @author Miss
 */
include_once("adb.php");

class final_project extends adb {

    function final_project() {
        adb::adb();
    }

    /**
     * query all applicant in the table and store the dataset in $this->result	
     * @return if successful true else false
     */
    function get_all_meetings() {
        $query = "Select * from support_table inner join meeting_table_mw on support_table.sid = meeting_table_mw.sid";
        return $this->query($query);
    }

    function add_delegate($name, $username, $password, $email, $phone_number, $organisation, $code) {
        $query = "Insert into delegate_table_mw (name,username,password,email,phone_number,organisation,sms_code) values ('$name', '$username', '$password' , '$email', $phone_number, '$organisation', $code)";
//                        print $query;
        return $this->query($query);
    }

    function confirm_registration($code) {
        $query = "Update delegate_table_mw set registered = 'yes' where sms_code = $code";
        return $this->query($query);
    }

    function get_meeting_by_delegate_id($id) {
        $query = "Select * from delegate_meeting_table inner join meeting_table_mw on mid = mtid  where did = $id";
        return $this->query($query);
    }

//    function update_qr_code_by_ids($code, $did, $mid)
//    {
//        $query = "Update ";
//        return $this->query($query);
//    }  
    
    function login_delegate_data($username, $password) {
        $query = "Select * from delegate_table_mw where username= '$username'  and password = '$password'";
        return $this->query($query);
    }

    function login_delegate($username, $password) {
        $query = "Select  count(*) as c from delegate_table_mw where username= '$username'  and password = '$password'";
//                    print $query;
        $this->query($query);
        $row = $this->fetch();
        if ($row['c'] == 1) {
            return true;
        } else {
            return false;
        }

        return $this->query($query);
    }

    function add_delegate_meeting($did, $mid) {
        
        $query = "Insert into delegate_meeting_table (did,mid) values ($did, $mid)";
        return $this->query($query);  
    }

    /**
     * updates the record identified by id 
     */
//		function update_applicant($applicant_id,$firstname,$lastname,$othernames,$address,$residence,$relationahip_to_child,$workplace,$consent_id){
//			//write the SQL query and call $this->query()
//			$query="update applicant set firstname='$firstname',lastname='$lastname',othernames='$othernames',
//			address='$address',residence='$residence',relationahip_to_child='$relationahip_to_child',workplace='$workplace',consent_id='$consent_id',
//			last_modified=now()	where applicant_id=$applicant_id";
//			return $this->query($query);
//		}
//		/**
//		*query to delete a applicant 	
//		*@return if successful true else false
//		*/
//		function delete_applicant($applicant_id){
//			$query="Delete from applicant where applicant_id=$applicant_id";
//			return $this->query($query);
//		}
//		
//		function get_applicant_byID($applicant_id){
//			$query="Select * from applicant where applicant_id=$applicant_id";
//			return $this->query($query);
//		}
    //put your code here
}

// $obj = new category();
// 
// if($obj->get_all_categories())
// {
//     echo"cannot find categories";
// }
// 
//  echo"fetching";
//     $row = $obj->fetch();
//     while ($row)
//     {
//         echo $row['name'];
//     }
// else
// {  
//      
// }
// echo"fetching";
// 
?>