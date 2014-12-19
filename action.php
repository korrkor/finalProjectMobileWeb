<?php

include("gen.php");

$cmd = get_datan("cmd");
switch ($cmd) {
    case 1:
        add_delegate();
        break;

    case 2:
        send_sms();
        break;


    case 3:
        verification();
        break;

    case 4:
        login_delegate();
        break;
    
    case 5:
        get_all_meetings();
        break;
    
    case 6:
        get_all_meetings_by_delegate_id();
        break;
    
    case 7:
        add_delegate_meeting();
        break;
    
    case 8:
        check_in_delegate();
        break;
    
    case 9:
        log_in_support();
        break;
    
    case 10:
        check_attendance_by_id();
        break;
    
    case 11:
        get_meetings();
        break;
    
     case 12:
        add_support_staff();
        break;
    
    case 13:
        get_all_delegates();
        break;
    

    default:
        echo "{";
        echo jsonn("result", 0) . ",";
        echo jsons("message", "unknown command");
        echo "}";
}

function get_all_delegates()
{
     include_once './final_project.php';
     $obj=new final_project();
     $obj->get_all_delegates();
     $row = $obj->fetch();
     $delegates= "";
     while($row)
    { 
//         echo "here";
        $delegates .= $row['name'] . "\n"  ;  
        $delegates .= $row['phone_number']   ;  
         $delegates .="\n\n ";"";  
//         $delegates .= $row['name'] . "\n";
         $row = $obj->fetch();  
    }
    
    print_r ($delegates); 
     
}

function add_support_staff()
{
    include_once './final_project.php';
    $username = get_data("username");
    $password = get_data("password");
    $name = get_data("name");
    $meeting_name = get_data("meeting_name");
    $description = get_data("description");
    $date_time = get_data("date"). " " .get_data("time");
    $number = get_datan("number");
    $obj = new final_project();
    if($obj->add_support_staff($username, $number, $password, $name))
    {
        $obj->return_last_support_staff();
        $row = $obj->fetch();   
        if($obj->add_meeting($row['Max(sid)'], $meeting_name, $description, $date_time))
        {
            echo "{";
        echo jsonn("result", 67) . ",";
        echo jsons("this is the code", "ghg");
        echo "}";
        return;
        }
           
    }      
    
}


function get_meetings()
{
    include_once './final_project.php';
    $obj= new final_project();
    $obj ->get_meetings();
    $row = $obj->fetch();
    $meetings= "";
    while($row)
    {
        $meetings .= $row['name'] . ";"  ;  
         $row = $obj->fetch();
    }
    
    print_r ($meetings);   
}

function check_attendance_by_id()
{
    include_once './final_project.php';
    $mtid = get_datan("mid");
    $obj = new final_project();
    if($obj ->get_attendance_by_meeting_id($mtid))
    {
        $row = $obj->fetch();
    print $row['c'];
    } else {
        echo "{";
        echo jsonn("result", 67) . ",";
        echo jsons("this is the code", "ghg");
        echo "}";
        return;
    }
    
}
function log_in_support()
{
    include_once './final_project.php';
    $obj = new final_project();
    $username = get_data("username");
    $password = get_data("password");
     
    if ($obj->log_in_support($username, $password)) { 
        $row = $obj->fetch();
        if($row['c'] == 1)  
        {
            echo "sid".$row['sid']; 
        }
        
        else
        {
            echo "epic fail1";
        }
          
    
    } else {
       
        echo "epic fail";  
    }
}

function check_in_delegate()
{
    include_once './final_project.php';
    $qr_code = get_datan("qr_code");
    $sid = get_datan("sid");
    $long_lat = get_datan("long_lat");
     $obj = new final_project();
     $obj->get_mid_from_sid($sid);
     $row = $obj ->fetch();
     
     $mid = $row['mtid'];
//     $obj ->get_delegate_by_sms($qr_code);
//     $row = $obj->fetch();
//     $did = $row['did'];  
    $did = get_datan("did");  
   
    $obj->check_in_delegate($did, $mid, $qr_code,long_lat);        
}

function add_delegate_meeting()     
{
    include_once './final_project.php';
    $mid = get_datan("mid");
    $did = get_datan("did");
    $obj = new final_project();
    
    if ($obj->add_delegate_meeting($did, $mid)) {   
        echo "{";
        echo jsonn("result", 1) . ",";
        echo jsons("this is the code", "ghg");
        echo "}";
        return;
    } else {
        echo "{";
        echo jsonn("result", 0) . ",";
        echo jsons("this is the code", "ghg");
        echo "}";
        return;
    }
    
}

function get_all_meetings_by_delegate_id()
{
    include_once './final_project.php';
     $obj = new final_project();
     $id = get_datan("id");
     if($obj->get_meeting_by_delegate_id($id))
     {
         $row = $obj->fetch();
         $my_meetings = array();
         
         while ($row) {   
        $row_array['id'] = $row["mtid"];  
        $row_array['name'] = $row["name"];
        $row_array['description'] = $row["description"];
//        $row_array['phone_number'] = $row["phone_number"];
        $row_array['date'] = $row["date"];  

        array_push($my_meetings, $row_array);  
//         print_r($row); 
        $row = $obj->fetch();      
    }
     print_r(json_encode($my_meetings));
     }
}

function get_all_meetings()
{
    include_once './final_project.php';
    $obj = new final_project();
    if($obj->get_all_meetings())
    {
        $row = $obj->fetch();
        $meetings = array();   

    while ($row) {   
        $row_array['id'] = $row["mtid"];
        $row_array['name'] = $row["name"];
        $row_array['description'] = $row["description"];
        $row_array['phone_number'] = $row["phone_number"];
        $row_array['date'] = $row["date"];  
    
        array_push($meetings, $row_array);  
//         print_r($row); 
        $row = $obj->fetch();     
    }
     print_r(json_encode($meetings)); 
    }   
    
}
function login_delegate() {
    include_once './final_project.php';
    $username = get_data("username");
    $password = get_data("password");

    $obj = new final_project();
    $obj2 = new final_project(); 
    if ($obj->login_delegate($username, $password)) {
        $row = $obj->fetch();
         $obj2->login_delegate_data($username, $password);
         $row2 = $obj2->fetch();
        echo "{";
        echo jsonn("result", 1) . ",";
        echo jsons("id", $row2['did']);  
        echo "}";
        return;
    } else {
        echo "{";  
        echo jsonn("result", 0) . ",";
        echo jsons("this is the code", "ghg");
        echo "}";
        return;
    }
}

function verification() {
    include_once './final_project.php';
    $code = get_datan("code");
    $obj = new final_project();

    if ($obj->confirm_registration($code)) {
        echo "{";
        echo jsonn("result", 1) . ",";
        echo jsons("this is the code", "ghg");
        echo "}";
        return;
    } else {
        echo "{";
        echo jsonn("result", 0) . ",";
        echo jsons("this is the code", "ghg");
        echo "}";
        return;
    }
}

function add_delegate() {
    include_once './final_project.php';
    $mid = 0;
    
    $name = get_data("name");
    $username = get_data("username");
    $email = get_data("email");
    $phone_number = get_datan("phone_number");
    $organisation = get_data("organisation");
    $password = get_data("password");
    $code = get_datan("code");
    
    

//    $code = rand(999, 9999);
    $obj = new final_project();
//    sendSms($phone_number,$code);

    if ($obj->add_delegate($name, $username, $password, $email, $phone_number, $organisation, $code)) {
        if(isset($_REQUEST['sid']))
    {
        $sid = $_REQUEST['sid'];
        $obj ->return_last_id();
        $row = $obj->fetch();  
        $did = $row['Max(did)'];
//        print "thsi is the did" . $did;
        $obj->get_mid_from_sid($sid);
        $ro= $obj->fetch();  
        
        $mid = $ro['mtid']; 
//        print "thsi is the mid" . $mid;
        $obj->add_delegate_meeting($did, $mid);      
    }   
    
        echo "{";
        echo jsonn("result", 1) . ",";
        echo jsons("this is the code", "ghg");
    
        echo "}";
        return;
    } else {
        echo "{";
        echo jsonn("result", 0) . ",";
        echo jsons("message", "no");
        echo "}";
        return;
    }
}

//odfbifrp   yralkzfn
//secret rktegnml    znbzlsho
function send_sms() {
    $number = get_datan("number");
    $code = get_datan("code");
    $url = "http://api.smsgh.com/v3/messages/send?" 
            . "From=kor"
            . "&To=%2B233$number" 
            . "&Content=Your+verification+code+is+$code+enter+this+code+to+complete+your+registratition"
            . "&ClientId=odfbifrp"
            . "&ClientSecret=rktegnml" 
            . "&RegisteredDelivery=true";    
    // Fire the request and wait for the response
    $response = file_get_contents($url); 
    var_dump($response);    
}  

function admin_login() {
    include_once './participant_class.php';
    $obj = new participant_class();  

    $user_name = get_data("user_name");
    $password = get_data("password");
    if ($obj->loginAdmin($user_name, $password)) {
        echo "{";
        echo jsonn("result", 1) . ",";
        echo jsons("message", "added");
        echo "}";
        return;
    } else {
        echo "{";
        echo jsonn("result", 0) . ",";
        echo jsons("message", "not added");
        echo "}";
        return;
    }
}

function get_participants() {
    include_once './participant_class.php';
    $obj = new participant_class();
    $obj->get_all_participant();
    $row = $obj->fetch();

    $participants = array();


    while ($row) {
        $row_array['name'] = $row["name"];
        $row_array['email'] = $row["email"];
        $row_array['number'] = $row["phone_number"];

        array_push($participants, $row_array);
        $row = $obj->fetch();
    }

//   return $location;
    print_r(json_encode($participants));
}

function add_participant() {
    include_once './participant_class.php';
    $obj = new participant_class();
    $name = get_data("name");
    $email = get_data("email");
    $number = get_datan("number");
//    $event = get_datan("event");
//    $certainty = get_datan("certainty");

    if ($obj->add_participant($name, $number, $email)) {
        echo "{";
        echo jsonn("result", 1) . ",";
        echo jsons("message", "added");
        echo "}";
    } else {
        echo "{";
        echo jsonn("result", 0) . ",";
        echo jsons("message", "did not add");
        echo "}";
    }
}

?>